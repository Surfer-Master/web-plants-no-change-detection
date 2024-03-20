<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\AirTemperature;
use App\Http\Requests\StoreAirTemperatureRequest;
use App\Http\Requests\UpdateAirTemperatureRequest;

class AirTemperatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAirTemperatureRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AirTemperature $airTemperature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AirTemperature $airTemperature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAirTemperatureRequest $request, AirTemperature $airTemperature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AirTemperature $airTemperature)
    {
        //
    }
}
