<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\NodeSendLog;
use App\Http\Requests\StoreNodeSendLogRequest;
use App\Http\Requests\UpdateNodeSendLogRequest;
use App\Models\Node;

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
        $nodes = Node::withcount(['nodeSendLogs'])->with(['latestNodeSendLog'])->get();

        // number_format(12000, 2, ',', '.')
        foreach ($nodes as $key => $node) {
            $node->packet_loss_count = $node->latestNodeSendLog ? $node->latestNodeSendLog->data_send_count - $node->node_send_logs_count : null;
            $node->packet_loss = $node->latestNodeSendLog ? number_format((($node->latestNodeSendLog->data_send_count - $node->node_send_logs_count) / $node->latestNodeSendLog->data_send_count) * 100, 2) : null;

            $delays = $node->nodeSendLogs->pluck('delay')->toArray();
            $node->delay = count($delays) > 0 ? number_format(array_sum($delays) / count($delays), 2) : null;

            $jitters = $node->nodeSendLogs->pluck('jitter')->toArray();
            $node->jitter = count($delays) > 1 ? number_format(array_sum($jitters) / (count($jitters) - 1), 2) : null;
        }

        $nodeSendLogs = NodeSendLog::with([
            'node',
            'airTemperature',
            'humidity',
            'soilMoistures' => ['plant']
        ])->paginate(100);

        // $previousNodeSendLogs = NodeSendLog::where('node_id', $request->node)
        //     ->latest('created_at')
        //     ->take(10)
        //     ->get();
        // $previousNodeSendLogs = $previousNodeSendLogs->sortBy('id');
        // $previousNodeSendLogs->last()->delay = $request->delay;
        //
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
}
