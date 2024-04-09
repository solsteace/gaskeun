<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PesananController;

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

Route::get('/pengguna', [PenggunaController::class, "show"]);
Route::get('/pengguna/{id}', [PenggunaController::class, "showById"]);
Route::post('/pengguna', [PenggunaController::class, "create"]);
Route::post('/pengguna/{id}', [PenggunaController::class, "edit"]);
Route::delete('/pengguna/{id}', [PenggunaController::class, "destroy"]);

Route::get('/pembayaran', [PembayaranController::class, "show"]);
Route::get('/pembayaran/{id}', [PembayaranController::class, "showById"]);
Route::post('/pembayaran', [PembayaranController::class, "create"]);
Route::post('/pembayaran/{id}', [PembayaranController::class, "edit"]);
Route::delete('/pembayaran/{id}', [PembayaranController::class, "destroy"]);

Route::get('/mobil', [MobilController::class, "show"]);
Route::get('/mobil/{id}', [MobilController::class, "showById"]);
Route::post('/mobil', [MobilController::class, "create"]);
Route::post('/mobil/{id}', [MobilController::class, "edit"]);
Route::delete('/mobil/{id}', [MobilController::class, "destroy"]);

Route::get('/pesanan', [PesananController::class, "show"]);
Route::get('/pesanan/{id}', [PesananController::class, "showById"]);
Route::post('/pesanan', [PesananController::class, "create"]);
Route::post('/pesanan/{id}', [PesananController::class, "edit"]);
Route::delete('/pesanan/{id}', [PesananController::class, "destroy"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
