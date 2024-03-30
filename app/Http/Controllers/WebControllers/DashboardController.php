<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use App\Models\AirTemperature;
use App\Models\Humidity;
use App\Models\Node;
use App\Models\NodeSendLog;
use App\Models\Plant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $plants = Plant::with(['latestSoilMoisture'])->get();

        $humidity = Humidity::latest()->first();
        $airTemperature = AirTemperature::latest()->first();
        $nodesCount = Node::all()->count();
        $nodeSendLogsCount = NodeSendLog::all()->count();
        $usersCount = User::all()->count();

        $storageSize = DB::table('information_schema.tables')
            ->selectRaw('round(SUM(data_length + index_length)/ 1024 / 1024, 2) as total_size_MB')
            ->where('table_schema', '=', env('DB_DATABASE'))
            ->first();

        // Cara Mendapatkan Ukuran tabel Pada database
        //     SELECT
        //     table_name AS `Table`,
        //     round(((data_length + index_length) / 1024 / 1024), 2) `Size in MB`
        // FROM information_schema.TABLES
        // WHERE table_schema = "$DB_NAME"
        //     AND table_name = "$TABLE_NAME";

        //         SELECT
        //      table_schema as `Database`,
        //      table_name AS `Table`,
        //      round(((data_length + index_length) / 1024 / 1024), 2) `Size in MB`
        // FROM information_schema.TABLES
        // ORDER BY (data_length + index_length) DESC;

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'nodesCount' => $nodesCount,
            'plants' => $plants,
            'nodeSendLogsCount' => $nodeSendLogsCount,
            'usersCount' => $usersCount,
            'airTemperature' => $airTemperature,
            'humidity' => $humidity,
            'storageSize' => $storageSize,
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
