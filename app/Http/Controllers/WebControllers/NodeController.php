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

        $user = auth()->user();

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
