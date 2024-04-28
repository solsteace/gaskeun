<?php

use App\Http\Controllers\MobilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\SiteController;
use App\Http\Middleware;

use App\Models\Mobil;

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



Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthManager::class, 'login'])->name("login");
    Route::get('/register', [AuthManager::class, 'register'])->name("register");
});

Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [SiteController::class, "booking"])->name('booking');
    Route::get('/createBooking', [SiteController::class, "createBooking"])->name('createBooking');
    Route::get('/history', [SiteController::class, "showMyBookings"])->name('history');

    Route::get('/admin', [AuthManager::class, 'admin'])->name("admin")->middleware('userAccess:admin');
    Route::get('/admin/pesanan', [AuthManager::class, 'pesanan'])->name("pesanan")->middleware('userAccess:admin');
    Route::put('/admin/pesanan/{id}', [AuthManager::class, 'konfirmasiPesanan'])->middleware('userAccess:admin');
    Route::put('/admin/pesanan/selesai/{id}', [AuthManager::class, 'selesaikanPesanan'])->middleware('userAccess:admin');
    Route::delete('/admin/pesanan/{id}', [AuthManager::class, 'deletePesanan'])->middleware('userAccess:admin');

    Route::get('/admin/mobil', [AuthManager::class, 'mobil'])->name("mobil")->middleware('userAccess:admin');
    Route::delete('/admin/mobil/{id}', [AuthManager::class, 'deleteMobil'])->middleware('userAccess:admin');
    
    Route::get('/admin/mobil/add-mobil', [AuthManager::class, 'addMobil'])->name("addMobil")->middleware('userAccess:admin');
    Route::post('/admin/mobil/add-mobil', [AuthManager::class, 'createMobil'])->middleware('userAccess:admin');

    Route::get('/admin/mobil/edit-mobil/{id}', [AuthManager::class, 'editMobil'])->name("editMobil")->middleware('userAccess:admin');
    Route::put('/admin/mobil/edit-mobil/{id}', [AuthManager::class, 'edit'])->middleware('userAccess:admin');


});

/*
Route::get('/admin', [AuthManager::class, 'admin'])->name("admin");
Route::get('/admin/pesanan', [AuthManager::class, 'pesanan'])->name("pesanan");
Route::get('/admin/mobil', [AuthManager::class, 'mobil'])->name("mobil");
Route::get('/admin/mobil/add-mobil', [AuthManager::class, 'addMobil'])->name("addMobil");
Route::get('/admin/mobil/edit-mobil', [AuthManager::class, 'editMobil'])->name("editMobil");
*/

Route::get('/cars', [SiteController::class, "cars"])->name('cars');
Route::post('/login', [AuthManager::class, 'authenticate']);
Route::post('/logout', [AuthManager::class, 'logout']);
Route::post('/register', [AuthManager::class, 'store']);