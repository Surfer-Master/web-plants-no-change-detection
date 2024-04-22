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
        // https://demos.creative-tim.com/argon-dashboard-pro-tailwind/pages/pages/charts.html
        // https://demos.creative-tim.com/soft-ui-dashboard-pro-tailwind/pages/pages/charts.html
        // https://soft-ui-dashboard-pro-tall.creative-tim.com/pages/charts
        // https://demos.creative-tim.com/material-tailwind-dashboard-react/?AFFILIATE=52980#/dashboard/home
        // https://preview.themeforest.net/item/yeti-admin-tailwind-css/full_screen_preview/29702349?clickid=2bnWKly9rxyPTl7Ul03Hr17qUkHR8x2xPUK50g0&iradid=275988&iradtype=ONLINE_TRACKING_LINK&irgwc=1&irmptype=mediapartner&irpid=369282&mp_value1=&utm_campaign=af_impact_radius_369282&utm_medium=affiliate&utm_source=impact_radius

        $user = auth()->user();
        $nodes = Node::withcount(['nodeSendLogs'])
            ->with(['latestNodeSendLog'])
            ->withAvg('nodeSendLogs', 'delay')
            ->withAvg('nodeSendLogs', 'jitter')
            ->get();

        foreach ($nodes as $key => $node) {
            $node->packet_loss_count = $node->latestNodeSendLog && $node->latestNodeSendLog->data_send_count ? $node->latestNodeSendLog->data_send_count - $node->node_send_logs_count : null;
            $node->packet_loss = $node->latestNodeSendLog && $node->latestNodeSendLog->data_send_count ? number_format((($node->latestNodeSendLog->data_send_count - $node->node_send_logs_count) / $node->latestNodeSendLog->data_send_count) * 100, 2) : null;
        }

        $nodeSendLogs = NodeSendLog::with([
            'node',
            'airTemperature',
            'humidity',
            'soilMoistures' => ['plant']
        ])->paginate(100);


        // $startDateTime = today();
        // $endDateTime = now();

        // $nodes = Node::withCount(['nodeSendLogs' => function ($query) use ($startDateTime, $endDateTime) {
        //     $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
        // }])
        //     ->with(['latestNodeSendLog' => function ($query) use ($startDateTime, $endDateTime) {
        //         $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
        //     }])
        //     ->withAvg(['nodeSendLogs' => function ($query) use ($startDateTime, $endDateTime) {
        //         $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
        //     }], 'delay')
        //     ->withAvg(['nodeSendLogs' => function ($query) use ($startDateTime, $endDateTime) {
        //         $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
        //     }], 'jitter')
        //     ->get();

        // foreach ($nodes as $key => $node) {
        //     $node->packet_loss_count = $node->latestNodeSendLog && $node->latestNodeSendLog->data_send_count ? $node->latestNodeSendLog->data_send_count - $node->node_send_logs_count : null;
        //     $node->packet_loss = $node->latestNodeSendLog && $node->latestNodeSendLog->data_send_count ? number_format((($node->latestNodeSendLog->data_send_count - $node->node_send_logs_count) / $node->latestNodeSendLog->data_send_count) * 100, 2) : null;
        // }

        // $nodeSendLogs = NodeSendLog::with([
        //     'node',
        //     'airTemperature',
        //     'humidity',
        //     'soilMoistures' => ['plant']
        // ])->whereBetween('created_at', [$startDateTime, $endDateTime])
        //     ->paginate(100);

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
            ->with(['latestNodeSendLog' => function ($query) use ($startDateTime, $endDateTime) {
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
            $node->packet_loss_count = $node->latestNodeSendLog && $node->latestNodeSendLog->data_send_count ? $node->latestNodeSendLog->data_send_count - $node->node_send_logs_count : null;
            $node->packet_loss = $node->latestNodeSendLog && $node->latestNodeSendLog->data_send_count ? number_format((($node->latestNodeSendLog->data_send_count - $node->node_send_logs_count) / $node->latestNodeSendLog->data_send_count) * 100, 2) : null;
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
        ]);
    }
}
