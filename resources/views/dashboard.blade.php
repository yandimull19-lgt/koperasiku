
@extends('layouts.app')

@section('title', 'Dashboard KoperasiKu')

@section('content')

<style>
    .info-box {
        padding: 20px;
        color: white;
        border-radius: 5px;
        margin-bottom: 20px;
        min-height: 165px;
    }

    .anggota-box {
        background: #17a2b8;
    }

    .simpanan-box {
        background: #28a745;
    }

    .info-box h2 {
        font-weight: bold;
    }

    .info-box a {
        color: white;
        text-decoration: none;
        display: block;
        margin-top: 15px;
        border-top: 1px solid rgba(255,255,255,.2);
        padding-top: 10px;
    }

    .welcome {
        background: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        margin-top: 10px;
    }
</style>

<h3 class="mb-4">Dashboard Koperasi</h3>

<div class="row">

    <div class="col-md-4">
        <div class="info-box anggota-box">
            <h2>Anggota</h2>
            <p>Data Anggota Koperasi</p>

            <a href="{{ route('anggota.index') }}">
                Lihat Data
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="info-box simpanan-box">
            <h2>Simpanan</h2>
            <p>Transaksi Simpanan Anggota</p>

            <a href="{{ route('simpanan.index') }}">
                Lihat Simpanan
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

<div class="welcome">
    <h5>Selamat Datang</h5>
    <hr>

    Selamat datang,
    <strong>{{ Auth::user()->name }}</strong>,
    di aplikasi KoperasiKu.
</div>

@endsection
