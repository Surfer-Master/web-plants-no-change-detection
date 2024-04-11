<?php

namespace App\Http\Requests;

use App\Models\Plant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->plant);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $usedSoilMoistureOrders = Plant::whereHas(
            'node',
            fn ($query) => $query->where('id', $this->node)
        )
            ->where('id', '!=', $this->plant->id)
            ->pluck('soil_moisture_order')
            ->toArray();

        return [
            'node' => 'required|exists:nodes,id',
            'nama' => 'required',
            'lokasi' => 'required',
            'urutan_sensor' =>  [
                'required',
                Rule::in([1, 2, 3, 4]),
                Rule::notIn($usedSoilMoistureOrders),
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        $plantUsedSoilMoistureOrder = Plant::whereHas('node', function ($query) {
            $query->where('id', $this->node);
        })->where('soil_moisture_order', $this->urutan_sensor)->first();

        $errorMessage = ':Attribute sudah digunakan pada tanaman';
        if ($plantUsedSoilMoistureOrder) {
            $plantName = $plantUsedSoilMoistureOrder->name ?? '';
            if ($plantUsedSoilMoistureOrder->location) {
                $plantName .= ' (' . $plantUsedSoilMoistureOrder->location . ')';
            }
            $errorMessage .= ' ' . $plantName;
        }

        return [
            'urutan_sensor.not_in' => $errorMessage . '.',
        ];
    }
}
