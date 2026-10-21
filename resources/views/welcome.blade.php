
@extends('layouts.app')

@section('title', 'Dashboard KoperasiKu')

@section('content')
    <div class="mb-4">
        <h1 class="fw-bold">Dashboard KoperasiKu</h1>
        <p class="text-muted">
            Sistem Informasi Koperasi Simpan Pinjam
        </p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Anggota</h5>
                    <p class="stat-number mb-0">0</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Simpanan</h5>
                    <p class="stat-number mb-0">Rp0</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Pinjaman</h5>
                    <p class="stat-number mb-0">Rp0</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5>Selamat Datang</h5>
            <p class="mb-0">
                Selamat datang di aplikasi KoperasiKu.
                Aplikasi ini digunakan untuk membantu pengelolaan
                data anggota, simpanan, dan pinjaman koperasi.
            </p>
        </div>
    </div>
@endsection
