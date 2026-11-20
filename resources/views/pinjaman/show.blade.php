@extends('layouts.app')

@section('title', 'Detail Pinjaman')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-1">Detail Pinjaman</h3>
            <p class="text-muted mb-0">
                Informasi lengkap pengajuan pinjaman anggota
            </p>
        </div>

        <a href="{{ route('pinjaman.index') }}"
           class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card border-top border-primary border-3 shadow-sm">

        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Informasi Pengajuan Pinjaman</h5>
        </div>

        <div class="card-body">

            <div class="row g-3">

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

            <div class="border rounded p-3 mb-4 bg-light">
                {{ $pinjaman->tujuan }}
            </div>

            <h5 class="text-primary mb-3">Status dan Proses Pinjaman</h5>

            <table class="table table-bordered mb-0">
                <tr>
                    <th width="25%">Status</th>
                    <td>
                        @php
                            $colors = [
                                'diajukan' => 'warning text-dark',
                                'disetujui' => 'info text-dark',
                                'ditolak' => 'danger',
                                'dicairkan' => 'primary',
                                'lunas' => 'success',
                                'dibatalkan' => 'secondary',
                            ];
                        @endphp

                        <span class="badge bg-{{ $colors[$pinjaman->status] ?? 'secondary' }}">
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

        <div class="card-footer bg-white d-flex gap-2">
            <a href="{{ route('pinjaman.index') }}"
               class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>

            @if(in_array($pinjaman->status, ['dicairkan', 'lunas']))
                <a href="{{ route('laporan.kartu', $pinjaman->id) }}"
                   class="btn btn-danger"
                   target="_blank">
                    <i class="bi bi-file-earmark-pdf me-1"></i>
                    Cetak Kartu Angsuran
                </a>
            @endif
        </div>

    </div>

</div>
@endsection