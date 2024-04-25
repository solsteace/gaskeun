<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/filter', function () {
    return view('filterCar');
})->name('filterCar');

Route::get('/inputDetail', function () {
    return view('inputDetail');
})->name('inputDetail');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthManager::class, 'login'])->name("login");
    Route::get('/register', [AuthManager::class, 'register'])->name("register");
});

Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [AuthManager::class, 'booking'])->name("booking");

    Route::get('/admin', [AuthManager::class, 'admin'])->name("admin")->middleware('userAccess:admin');
    Route::get('/admin/pesanan', [AuthManager::class, 'pesanan'])->name("pesanan")->middleware('userAccess:admin');
    Route::get('/admin/mobil', [AuthManager::class, 'mobil'])->name("mobil")->middleware('userAccess:admin');
    Route::delete('/admin/mobil/{id}', [AuthManager::class, 'deleteMobil'])->middleware('userAccess:admin');
    Route::get('/admin/mobil/add-mobil', [AuthManager::class, 'addMobil'])->name("addMobil")->middleware('userAccess:admin');
    Route::post('/admin/mobil/add-mobil', [AuthManager::class, 'createMobil'])->middleware('userAccess:admin');

    Route::get('/admin/mobil/edit-mobil', [AuthManager::class, 'editMobil'])->name("editMobil")->middleware('userAccess:admin');


});

/*
Route::get('/admin', [AuthManager::class, 'admin'])->name("admin");
Route::get('/admin/pesanan', [AuthManager::class, 'pesanan'])->name("pesanan");
Route::get('/admin/mobil', [AuthManager::class, 'mobil'])->name("mobil");
Route::get('/admin/mobil/add-mobil', [AuthManager::class, 'addMobil'])->name("addMobil");
Route::get('/admin/mobil/edit-mobil', [AuthManager::class, 'editMobil'])->name("editMobil");
*/

Route::post('/login', [AuthManager::class, 'authenticate']);
Route::post('/logout', [AuthManager::class, 'logout']);
Route::post('/register', [AuthManager::class, 'store']);