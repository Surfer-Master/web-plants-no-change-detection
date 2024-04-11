<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;
use App\Models\Node;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Plant::class);

        $user = auth()->user();

        $plants = Plant::with(['node'])->get();
        $nodes = Node::where('connected_sensor', 'soil-moisture')->get();

        return view('plants.index', [
            'title' => 'Smart Farming | Tanaman',
            'plants' => $plants,
            'nodes' => $nodes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Plant::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlantRequest $request)
    {
        try {
            $plant = new Plant();
            $plant->node_id = $request->node;
            $plant->name = $request->nama;
            $plant->location = $request->lokasi;
            $plant->soil_moisture_order = $request->urutan_sensor;
            $plant->save();

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
    public function show(Plant $plant)
    {
        $this->authorize('view', $plant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plant $plant)
    {
        $this->authorize('update', $plant);

        try {
            return response()->json(
                [
                    'node' => $plant->node_id,
                    'nama' => $plant->name,
                    'lokasi' => $plant->location,
                    'urutan_sensor' => $plant->soil_moisture_order,
                ]
            );
        } catch (Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat mengambil data.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlantRequest $request, Plant $plant)
    {
        try {
            $plant->node_id = $request->node;
            $plant->name = $request->nama;
            $plant->location = $request->lokasi;
            $plant->soil_moisture_order = $request->urutan_sensor;
            $plant->save();

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
    public function destroy(Plant $plant)
    {
        $this->authorize('delete', $plant);

        try {
            $plant->delete();

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

    public function restore(Plant $plant)
    {
        $this->authorize('restore', $plant);
    }

    public function forceDelete(Plant $plant)
    {
        $this->authorize('forceDelete', $plant);
    }
}
