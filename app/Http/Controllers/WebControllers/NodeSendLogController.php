<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\NodeSendLog;
use App\Http\Requests\StoreNodeSendLogRequest;
use App\Http\Requests\UpdateNodeSendLogRequest;

class NodeSendLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $nodeSendLogs = NodeSendLog::with([
            'node',
            'bandwidth',
            'airTemperature',
            'humidity',
            'soilMoistures' => ['plant']
        ])->get();

        // $previousNodeSendLogs = NodeSendLog::where('node_id', $request->node)
        //     ->latest('created_at')
        //     ->take(10)
        //     ->get();
        // $previousNodeSendLogs = $previousNodeSendLogs->sortBy('id');
        // $previousNodeSendLogs->last()->delay = $request->delay;
        // $delays = $previousNodeSendLogs->pluck('delay')->toArray();

        // $totalVariasiDelay = 0;
        // // $meanDelay = array_sum($delays) / count($delays);

        // for ($i = 0; $i < count($delays); $i++) {
        //     $totalVariasiDelay += abs($delays[$i] - $delays[$i - 1]);
        //     // $totalVariasiDelay += $delays[$i] - $meanDelay;
        // }

        // // $result = (float) number_format($result, 2);
        // $previousNodeSendLogs->last()->jitter = number_format($totalVariasiDelay / (count($delays) - 1), 4);

        // $previousNodeSendLogs->last()->save();

        return view('node-send-logs.index', [
            'title' => 'Log Pengiriman Node',
            'nodeSendLogs' => $nodeSendLogs,
        ]);
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
    public function store(StoreNodeSendLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(NodeSendLog $nodeSendLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NodeSendLog $nodeSendLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNodeSendLogRequest $request, NodeSendLog $nodeSendLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NodeSendLog $nodeSendLog)
    {
        //
    }
}
