@extends('layouts.app')

@section('title', 'Detail Pinjaman')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <div>
            <h3>Detail Pinjaman</h3>
            <p class="text-muted">
                Informasi lengkap pengajuan pinjaman anggota
            </p>
        </div>

        <a href="{{ route('pinjaman.index') }}"
           class="btn btn-secondary align-self-start">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card card-primary card-outline">

        <div class="card-header">
            <h3 class="card-title">Informasi Pengajuan Pinjaman</h3>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">
                    <h5 class="text-primary mb-3">Data Anggota</h5>

                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Nomor Anggota</th>
                            <td>{{ $pinjaman->anggota->nomor_anggota }}</td>
                        </tr>
                        <tr>
                            <th>Nama Anggota</th>
                            <td>{{ $pinjaman->anggota->nama }}</td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>{{ $pinjaman->anggota->nik }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h5 class="text-primary mb-3">Informasi Pinjaman</h5>

                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Jumlah Pengajuan</th>
                            <td>
                                Rp {{ number_format($pinjaman->jumlah_pengajuan, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Jumlah Disetujui</th>
                            <td>
                                @if($pinjaman->jumlah_disetujui !== null)
                                    Rp {{ number_format($pinjaman->jumlah_disetujui, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Bunga</th>
                            <td>{{ $pinjaman->bunga_persen }}%</td>
                        </tr>
                        <tr>
                            <th>Tenor</th>
                            <td>{{ $pinjaman->tenor_bulan }} Bulan</td>
                        </tr>
                    </table>
                </div>

            </div>

            <hr>

            <h5 class="text-primary mb-3">Tujuan Pinjaman</h5>

            <div class="border rounded p-3 mb-4">
                {{ $pinjaman->tujuan }}
            </div>

            <h5 class="text-primary mb-3">Status dan Proses Pinjaman</h5>

            <table class="table table-bordered">
                <tr>
                    <th width="25%">Status</th>
                    <td>
                        @php
                            $colors = [
                                'diajukan' => 'warning',
                                'disetujui' => 'info',
                                'ditolak' => 'danger',
                                'dicairkan' => 'primary',
                                'lunas' => 'success',
                                'dibatalkan' => 'secondary',
                            ];
                        @endphp

                        <span class="badge badge-{{ $colors[$pinjaman->status] ?? 'secondary' }}">
                            {{ ucfirst($pinjaman->status) }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Disetujui Oleh</th>
                    <td>{{ $pinjaman->pengurus->name ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Tanggal Persetujuan</th>
                    <td>{{ $pinjaman->approved_at?->format('d-m-Y H:i') ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Catatan Persetujuan</th>
                    <td>{{ $pinjaman->catatan_persetujuan ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Tanggal Pencairan</th>
                    <td>{{ $pinjaman->disbursed_at?->format('d-m-Y H:i') ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Tanggal Pelunasan</th>
                    <td>{{ $pinjaman->lunas_at?->format('d-m-Y H:i') ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>{{ $pinjaman->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                </tr>
            </table>

        </div>

        <div class="card-footer">
            <a href="{{ route('pinjaman.index') }}"
               class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>

    </div>

</div>
@endsection
