<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\Humidity;
use App\Http\Requests\StoreHumidityRequest;
use App\Http\Requests\UpdateHumidityRequest;

class HumidityController extends Controller
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
    public function store(StoreHumidityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Humidity $humidity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Humidity $humidity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHumidityRequest $request, Humidity $humidity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Humidity $humidity)
    {
        //
    }
}
