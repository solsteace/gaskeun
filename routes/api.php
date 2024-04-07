<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// PENGGUNA ====================
Route::get('/pengguna', [PenggunaController::class, "show"]);
Route::get('/pengguna/{id}', [PenggunaController::class, "showById"]);
Route::post('/pengguna', [PenggunaController::class, "create"]);
Route::put('/pengguna/{id}', [PenggunaController::class, "edit"]);
Route::delete('/pengguna/{id}', [PenggunaController::class, "destroy"]);

// MOBIL ====================

// PEMBAYARAN ====================

// PESANAN ====================

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
