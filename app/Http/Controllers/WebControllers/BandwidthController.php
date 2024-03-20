<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\Bandwidth;
use App\Http\Requests\StoreBandwidthRequest;
use App\Http\Requests\UpdateBandwidthRequest;

class BandwidthController extends Controller
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
    public function store(StoreBandwidthRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bandwidth $bandwidth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bandwidth $bandwidth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBandwidthRequest $request, Bandwidth $bandwidth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bandwidth $bandwidth)
    {
        //
    }
}
