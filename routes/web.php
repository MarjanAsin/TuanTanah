<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KontakController;

/*
|--------------------------------------------------------------------------
| ROUTE PELANGGAN (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [PelangganController::class, 'beranda'])
    ->name('pelanggan.beranda');

Route::get('/properti', [PelangganController::class, 'properti'])
    ->name('pelanggan.properti');

Route::get('/properti/{id}', [PelangganController::class, 'detail'])
    ->name('pelanggan.detail');

Route::get('/kontak', [PelangganController::class, 'kontak'])
    ->name('pelanggan.kontak');

Route::post('/kontak/kirim', [KontakController::class, 'kirim'])
    ->name('kontak.kirim');


/*
|--------------------------------------------------------------------------
| ROUTE AUTH (GUEST ONLY)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/masuk', [AuthController::class, 'showLogin'])
        ->name('masuk');

    Route::post('/masuk', [AuthController::class, 'login']);

    Route::get('/daftar', [AuthController::class, 'showRegister'])
        ->name('daftar');

    Route::post('/daftar', [AuthController::class, 'register']);
});


/*
|--------------------------------------------------------------------------
| ROUTE LOGOUT (AUTH ONLY)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});


Route::middleware(['auth'])->group(function () {

    Route::get('/admin', function () {
        return view('admin.beranda');
    })->name('admin.beranda');

    Route::get('/pemilik', function () {
        return view('pemilik.beranda');
    })->name('pemilik.beranda');
});

