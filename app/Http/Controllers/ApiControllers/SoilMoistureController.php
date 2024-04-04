<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\Bandwidth;
use App\Models\NodeSendLog;
use App\Models\Plant;
use App\Models\SoilMoisture;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SoilMoistureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'node' => 'required|exists:nodes,id',
                'soil_moistures' => 'required|array',
                'soil_moistures.*.id' => 'required|numeric',
                'soil_moistures.*.moisture' => 'required|numeric',
                'sensor_read_count' => 'nullable|numeric',
                'data_send_count' => 'nullable|numeric',
                'delay' => 'nullable|numeric',
                'payload_size' => 'nullable|numeric',
            ]);

            $previousNodeSendLogs = NodeSendLog::where('node_id', $request->node)
                ->latest('created_at')
                ->take(2)
                ->get();

            $firstPreviousNodeSendLog = $previousNodeSendLogs->first();
            if ($previousNodeSendLogs->count() == 2) {
                $secondPreviousNodeSendLog = $previousNodeSendLogs->last();
            } else {
                $secondPreviousNodeSendLog = null;
            }
            if ($firstPreviousNodeSendLog) {
                $firstPreviousNodeSendLog->delay = $request->delay;
                $firstPreviousNodeSendLog->jitter = $secondPreviousNodeSendLog ? abs($request->delay - $secondPreviousNodeSendLog->delay) : null;
                $firstPreviousNodeSendLog->payload_size = $request->payload_size;
                $firstPreviousNodeSendLog->save();
            }

            $bandwidth = Bandwidth::where('active', 1)->first();

            $nodeSendLog = new NodeSendLog();
            $nodeSendLog->node_id = $request->node;
            $nodeSendLog->bandwidth_id = $bandwidth->id ?? null;
            // $nodeSendLog->send_time = null;
            // $nodeSendLog->receipt_time = null;
            // $nodeSendLog->delay = null;
            // $nodeSendLog->jitter = null;
            $nodeSendLog->sensor_read_count = $request->sensor_read_count;
            $nodeSendLog->data_send_count = $request->data_send_count;
            $nodeSendLog->payload_size = $request->payload_size;
            $nodeSendLog->save();

            foreach ($request->soil_moistures as $key => $moisture) {
                $plant = Plant::where('node_id', $request->node)->where('soil_moisture_order', $moisture['id'])->first();
                if ($plant) {
                    $soilMoisture = new SoilMoisture();
                    $soilMoisture->plant_id = $plant->id;
                    $soilMoisture->moisture = $moisture['moisture'];

                    $soilMoisture->nodeSendLog()->associate($nodeSendLog);
                    $soilMoisture->save();
                }
            }

            return response()->json([
                'message' => 'success',
            ], 201);
        } catch (ValidationException $e) {
            info('ValidationException INFO : ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage(), 'errors' => $e->errors()], 422);
        } catch (QueryException $e) {
            info('QueryException INFO : ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan database.'], 500);
        } catch (HttpException $e) {
            info('HttpException INFO : ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], $e->getStatusCode());
        } catch (HttpResponseException $e) {
            info('HttpResponseException INFO : ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan dalam respons.'], 500);
        } catch (Exception $e) {
            info('Exception INFO : ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi Kesalahan Server.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
