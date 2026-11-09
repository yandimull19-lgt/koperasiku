<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\AngsuranController;

// Halaman utama menuju dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware('auth');

// Semua halaman setelah login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Data Anggota
    Route::resource('anggota', AnggotaController::class);

    // Data Simpanan
    Route::resource('simpanan', SimpananController::class);

    // Data Pinjaman
    Route::resource('pinjaman', PinjamanController::class);

    // Proses persetujuan pinjaman
    Route::post(
        '/pinjaman/{pinjaman}/approve',
        [PinjamanController::class, 'approve']
    )->name('pinjaman.approve');

    // Proses penolakan pinjaman
    Route::post(
        '/pinjaman/{pinjaman}/reject',
        [PinjamanController::class, 'reject']
    )->name('pinjaman.reject');

    // Proses pencairan pinjaman
    Route::post(
        '/pinjaman/{pinjaman}/disburse',
        [PinjamanController::class, 'disburse']
    )->name('pinjaman.disburse');

    // Catatan: Route pelunasan manual (pinjaman.paid) dihapus karena 
    // pelunasan pinjaman kini otomatis saat seluruh angsuran lunas.

    // Proses pembatalan pinjaman
    Route::post(
        '/pinjaman/{pinjaman}/cancel',
        [PinjamanController::class, 'cancel']
    )->name('pinjaman.cancel');

    // Manajemen Angsuran
    Route::get('/angsuran', [AngsuranController::class, 'index'])->name('angsuran.index');
    Route::get('/angsuran/{angsuran}', [AngsuranController::class, 'show'])->name('angsuran.show');
    Route::post('/angsuran/{angsuran}/bayar', [AngsuranController::class, 'pay'])->name('angsuran.pay');

});

// Khusus Admin
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Manajemen User
    Route::resource('users', UserController::class);

});

// Route autentikasi
require __DIR__.'/auth.php';