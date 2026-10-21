<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\UserController;

// Redirect halaman utama ke daftar anggota
Route::get('/', function () {
    return redirect()->route('anggota.index');
})->middleware('auth');

// Route yang hanya bisa diakses setelah Login
Route::middleware('auth')->group(function () {
    Route::resource('anggota', AnggotaController::class);
    Route::resource('simpanan', SimpananController::class);
});

// Route khusus yang HANYA bisa diakses oleh ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';