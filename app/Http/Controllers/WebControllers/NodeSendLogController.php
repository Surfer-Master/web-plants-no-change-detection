<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\NodeSendLog;
use App\Http\Requests\StoreNodeSendLogRequest;
use App\Http\Requests\UpdateNodeSendLogRequest;
use App\Models\Node;
use Illuminate\Http\Request;

class NodeSendLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nodes = Node::withcount(['nodeSendLogs'])
            ->with(['oldestNodeSendLog', 'latestNodeSendLog'])
            ->withAvg('nodeSendLogs', 'delay')
            ->withAvg('nodeSendLogs', 'jitter')
            ->get();

        foreach ($nodes as $key => $node) {
            $packetLossCount = $node->node_send_logs_count ? (($node->latestNodeSendLog->data_send_count ?? 0) - ($node->oldestNodeSendLog->data_send_count ?? 0) - ($node->node_send_logs_count ?? 0) + 1) : 0;
            $packetLoss = $node->latestNodeSendLog && $node->latestNodeSendLog->data_send_count ? (($packetLossCount / $node->latestNodeSendLog->data_send_count) * 100) : null;

            $node->packet_loss_count = $packetLossCount;
            $node->packet_loss = $packetLoss;
        }

        $nodeSendLogs = NodeSendLog::with([
            'node',
            'airTemperature',
            'humidity',
            'soilMoistures' => ['plant']
        ])->paginate(100);

        return view('node-send-logs.index', [
            'title' => 'Smart Farming | Log Pengiriman',
            'nodes' => $nodes,
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

    public function find(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date_format:Y-m-d\TH:i',
            'tanggal_akhir' => 'required|date_format:Y-m-d\TH:i',
        ]);

        $startDateTime = $request->tanggal_awal;
        $endDateTime = $request->tanggal_akhir;

        $nodes = Node::withCount(['nodeSendLogs' => function ($query) use ($startDateTime, $endDateTime) {
            $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
        }])
            ->withAvg(['nodeSendLogs' => function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
            }], 'delay')
            ->withAvg(['nodeSendLogs' => function ($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
            }], 'jitter')
            ->get();

        foreach ($nodes as $key => $node) {
            $node->oldestNodeSendLog = $node->nodeSendLogs()->whereBetween('created_at', [$startDateTime, $endDateTime])->take(1)->get();
            $node->latestNodeSendLog = $node->nodeSendLogs()->whereBetween('created_at', [$startDateTime, $endDateTime])->latest()->take(1)->get();
            $packetLossCount = $node->node_send_logs_count ? (($node->latestNodeSendLog->data_send_count ?? 0) - ($node->oldestNodeSendLog->data_send_count ?? 0) - ($node->node_send_logs_count ?? 0) + 1)  : 0;
            $packetLoss = $node->latestNodeSendLog && $node->latestNodeSendLog->data_send_count ? (($packetLossCount / $node->latestNodeSendLog->data_send_count) * 100) : null;

            $node->packet_loss_count = $packetLossCount;
            $node->packet_loss = $packetLoss;
        }

        $nodeSendLogs = NodeSendLog::with([
            'node',
            'airTemperature',
            'humidity',
            'soilMoistures' => ['plant']
        ])->whereBetween('created_at', [$startDateTime, $endDateTime])
            ->paginate(100);

        return view('node-send-logs.index', [
            'title' => 'Smart Farming | Log Pengiriman',
            'nodes' => $nodes,
            'nodeSendLogs' => $nodeSendLogs,
            'startDateTime' => $startDateTime,
            'startDateTime'  => $endDateTime
        ]);
    }
}
