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

Route::get('/booking', function() {
    return view('booking');
})->name("booking");

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthManager::class, 'login'])->name("login");
    Route::get('/register', [AuthManager::class, 'register'])->name("register");
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AuthManager::class, 'admin'])->middleware('userAccess:admin');
});


Route::post('/login', [AuthManager::class, 'authenticate']);
Route::post('/logout', [AuthManager::class, 'logout']);
Route::post('/register', [AuthManager::class, 'store']);