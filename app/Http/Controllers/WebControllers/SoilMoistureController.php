<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\SoilMoisture;
use App\Http\Requests\StoreSoilMoistureRequest;
use App\Http\Requests\UpdateSoilMoistureRequest;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSoilMoistureRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SoilMoisture $soilMoisture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SoilMoisture $soilMoisture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSoilMoistureRequest $request, SoilMoisture $soilMoisture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SoilMoisture $soilMoisture)
    {
        //
    }
}
