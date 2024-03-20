<?php

use App\Http\Controllers\ApiControllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiControllers\DhtController;
use App\Http\Controllers\ApiControllers\SoilMoistureController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
    Route::post('/register', 'store');
});

Route::prefix('sensor/dht')->name('api.dht.')->group(function () {
    Route::get('/', [DhtController::class, 'index'])->name('index');
    Route::post('/', [DhtController::class, 'store'])->name('store');
    Route::get('/{id}', [DhtController::class, 'show'])->name('show');
    Route::put('/{id}', [DhtController::class, 'update'])->name('update');
    Route::delete('/{id}', [DhtController::class, 'destroy'])->name('destroy');
});

Route::prefix('sensor/soil-moisture')->name('api.soil-moisture.')->group(function () {
    Route::get('/', [SoilMoistureController::class, 'index'])->name('index');
    Route::post('/', [SoilMoistureController::class, 'store'])->name('store');
    Route::get('/{id}', [SoilMoistureController::class, 'show'])->name('show');
    Route::put('/{id}', [SoilMoistureController::class, 'update'])->name('update');
    Route::delete('/{id}', [SoilMoistureController::class, 'destroy'])->name('destroy');
});


// Route::prefix('/kelas')->name('api.kelas.')->group(function () {
//     Route::get('/', [ApiKelasController::class, 'index'])->name('index');
//     Route::post('/', [ApiKelasController::class, 'store'])->name('store');
//     Route::get('/{kelas}', [ApiKelasController::class, 'show'])->name('show');
//     Route::put('/{kelas}', [ApiKelasController::class, 'update'])->name('update');
//     Route::delete('/{kelas}', [ApiKelasController::class, 'destroy'])->name('destroy');
// });
