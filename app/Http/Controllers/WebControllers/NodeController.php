<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Http\Requests\StoreNodeRequest;
use App\Http\Requests\UpdateNodeRequest;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Node::class);

        $nodes = Node::get();

        return view('nodes.index', [
            'title' => 'Smart Farming | Node',
            'nodes' => $nodes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Node::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNodeRequest $request)
    {
        try {
            $node = new Node();
            $node->name = $request->nama;
            $node->connected_sensor = $request->sensor;
            $node->save();

            return response()->json([
                'title' => 'Berhasil',
                'status' => 'success',
                'message' => 'Data Berhasil Ditambah.',
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'title' => 'Error!',
                'status' => 'error',
                'message' => 'Terjadi kesalahan database.'
            ], 500);
        } catch (HttpException $e) {
            return response()->json([
                'title' => 'Error!',
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getStatusCode());
        } catch (HttpResponseException $e) {
            return response()->json([
                'title' => 'Error!',
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam respons.'
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'title' => 'Error!',
                'status' => 'error',
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Node $node)
    {
        $this->authorize('view', $node);

        $node->load([
            'plants',
            'oldestNodeSendLog',
            'latestNodeSendLog'
        ])->loadCount('nodeSendLogs')
            ->loadAvg('nodeSendLogs', 'delay')
            ->loadAvg('nodeSendLogs', 'jitter');

        $node->packet_loss_count =  $node->node_send_logs_count ? (($node->latestNodeSendLog->data_send_count ?? 0) - ($node->oldestNodeSendLog->data_send_count ?? 0) - ($node->node_send_logs_count ?? 0) + 1) : 0;

        $node->packet_loss = $node->latestNodeSendLog && $node->latestNodeSendLog->data_send_count ? (($node->packet_loss_count / $node->latestNodeSendLog->data_send_count) * 100) : null;

        $nodeSendLogs = $node->nodeSendLogs()->with([
            'node',
            'airTemperature',
            'humidity',
            'soilMoistures' => ['plant']
        ])->paginate(100);

        $data = $node->nodeSendLogs()->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:") as interval_start, CONCAT(FLOOR(MINUTE(created_at) / 30) * 30, ":00") as interval_minute, AVG(delay) as average_delay, AVG(jitter) as average_jitter, (MAX(data_send_count) - MIN(data_send_count)) + 1 as data_send_count, ((MAX(data_send_count) - MIN(data_send_count)) + 1) - COUNT(*) as packet_loss_count')
            ->groupBy('interval_start', 'interval_minute')
            ->orderBy('interval_start', 'asc')
            ->orderBy('interval_minute', 'asc')
            ->get();

        $dataSendChartData = [];
        $packetLossChartData = [];
        $delayChartData = [];
        $jitterChartData = [];

        foreach ($data as $record) {
            $dataSendChartData[] = [
                'x' => $record->interval_start . $record->interval_minute,
                'y' => $record->data_send_count,
            ];
            $packetLossChartData[] = [
                'x' => $record->interval_start . $record->interval_minute,
                'y' => $record->packet_loss_count,
            ];
            $delayChartData[] = [
                'x' => $record->interval_start . $record->interval_minute,
                'y' => $record->average_delay,
            ];
            $jitterChartData[] = [
                'x' => $record->interval_start . $record->interval_minute,
                'y' => $record->average_jitter,
            ];
        }


        return view('nodes.show', [
            'title' => 'Smart Farming | Node - ' . $node->name,
            'node' => $node,
            'nodeSendLogs' => $nodeSendLogs,
            'dataSendChartData' => json_encode($dataSendChartData),
            'packetLossChartData' => json_encode($packetLossChartData),
            'delayChartData' => json_encode($delayChartData),
            'jitterChartData' => json_encode($jitterChartData),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Node $node)
    {
        $this->authorize('update', $node);

        try {
            return response()->json(
                [
                    'nama' => $node->name,
                    'sensor' => $node->connected_sensor,
                ]
            );
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengambil data.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNodeRequest $request, Node $node)
    {
        try {
            $node->name = $request->nama;
            $node->connected_sensor = $request->sensor;
            $node->save();

            return response()->json([
                'title' => 'Berhasil',
                'status' => 'success',
                'message' => 'Data Berhasil Diupdate.',
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'title' => 'Error!',
                'status' => 'error',
                'message' => 'Terjadi kesalahan database.'
            ], 500);
        } catch (HttpException $e) {
            return response()->json([
                'title' => 'Error!',
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getStatusCode());
        } catch (HttpResponseException $e) {
            return response()->json([
                'title' => 'Error!',
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam respons.'
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'title' => 'Error!',
                'status' => 'error',
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Node $node)
    {
        $this->authorize('delete', $node);

        try {
            $node->nodeSendLogs()->delete();
            $node->delete();

            return response()->json([
                'title' => 'Deleted!',
                'status' => 'success',
                'message' => 'Berhasil Dihapus.',
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'title' => 'Error!',
                'status' => 'error',
                'message' => 'Terjadi kesalahan database.'
            ], 500);
        } catch (HttpException $e) {
            return response()->json([
                'title' => 'Error!',
                'status' => 'error',
                'message' => $e->getMessage()
            ], $e->getStatusCode());
        } catch (HttpResponseException $e) {
            return response()->json([
                'title' => 'Error!',
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam respons.'
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'title' => 'Error!',
                'status' => 'error',
                'message' => 'Terjadi kesalahan server.'
            ], 500);
        }
    }

    public function restore(Node $node)
    {
        $this->authorize('restore', $node);
    }

    public function forceDelete(Node $node)
    {
        $this->authorize('forceDelete', $node);
    }
}
