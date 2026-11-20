@extends('layouts.app')

@section('title', 'Laporan Pinjaman')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-1">Laporan Pinjaman</h3>
            <p class="text-muted mb-0">
                Rekap pencairan dan pembayaran pinjaman koperasi.
            </p>
        </div>
        <a href="{{ route('laporan.pinjaman.pdf', request()->query()) }}"
           class="btn btn-danger"
           target="_blank">
            <i class="bi bi-file-earmark-pdf me-1"></i> Cetak PDF
        </a>
    </div>

    {{-- Filter --}}
    <div class="card border-top border-primary border-3 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Tanggal Mulai Pencairan</label>
                    <input type="date"
                           name="tanggal_mulai"
                           class="form-control"
                           value="{{ request('tanggal_mulai') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Akhir Pencairan</label>
                    <input type="date"
                           name="tanggal_akhir"
                           class="form-control"
                           value="{{ request('tanggal_akhir') }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search me-1"></i> Tampilkan
                    </button>
                    <a href="{{ route('laporan.pinjaman') }}"
                       class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Ringkasan --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card text-bg-primary shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">
                            Rp {{ number_format($rekap['total_pinjaman'], 0, ',', '.') }}
                        </h4>
                        <p class="mb-0">Total Pencairan</p>
                    </div>
                    <i class="bi bi-cash-coin fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">
                            Rp {{ number_format($rekap['total_dibayar'], 0, ',', '.') }}
                        </h4>
                        <p class="mb-0">Total Pembayaran Diterima</p>
                    </div>
                    <i class="bi bi-wallet2 fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-danger shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">
                            Rp {{ number_format($rekap['sisa_piutang'], 0, ',', '.') }}
                        </h4>
                        <p class="mb-0">Sisa Piutang</p>
                    </div>
                    <i class="bi bi-exclamation-circle fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Komposisi tagihan --}}
    <div class="card border-top border-info border-3 shadow-sm mb-4">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Komposisi Pinjaman</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <tr>
                    <th width="35%">Total Pokok Pinjaman</th>
                    <td>
                        Rp {{ number_format($rekap['total_pokok'], 2, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <th>Total Bunga Terjadwal</th>
                    <td>
                        Rp {{ number_format($rekap['total_bunga'], 2, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <th>Total Tagihan Terjadwal</th>
                    <td>
                        <strong>Rp {{ number_format($rekap['total_pokok'] + $rekap['total_bunga'], 2, ',', '.') }}</strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Daftar pinjaman --}}
    <div class="card border-top border-primary border-3 shadow-sm mb-4">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Daftar Pinjaman Dicairkan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Anggota</th>
                            <th>Tanggal Cair</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Total Tagihan</th>
                            <th>Sudah Dibayar</th>
                            <th>Sisa</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pinjamans as $index => $pinjaman)
                            @php
                                $tagihan = $pinjaman->angsurans->sum('total_tagihan');
                                $dibayar = $pinjaman->angsurans->sum('total_dibayar');
                            @endphp
                            <tr>
                                <td>{{ $pinjamans->firstItem() + $index }}</td>
                                <td>{{ $pinjaman->anggota->nama }}</td>
                                <td>
                                    {{ $pinjaman->disbursed_at?->format('d-m-Y') }}
                                </td>
                                <td>
                                    Rp {{ number_format($pinjaman->jumlah_disetujui, 0, ',', '.') }}
                                </td>
                                <td>
                                    Rp {{ number_format($tagihan, 0, ',', '.') }}
                                </td>
                                <td>
                                    Rp {{ number_format($dibayar, 0, ',', '.') }}
                                </td>
                                <td>
                                    Rp {{ number_format($tagihan - $dibayar, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if($pinjaman->status === 'lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-primary">Dicairkan</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('laporan.kartu', $pinjaman->id) }}"
                                       class="btn btn-danger btn-sm"
                                       target="_blank"
                                       title="Cetak Kartu Angsuran">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">
                                    Tidak ada data pinjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $pinjamans->links() }}
        </div>
    </div>

    {{-- Daftar tunggakan --}}
    <div class="card border-top border-danger border-3 shadow-sm">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0 text-danger">
                Daftar Angsuran Menunggak
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Anggota</th>
                            <th>Angsuran Ke</th>
                            <th>Jatuh Tempo</th>
                            <th>Total Tagihan</th>
                            <th>Sudah Dibayar</th>
                            <th>Sisa Tunggakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tunggakan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->pinjaman->anggota->nama }}</td>
                                <td>{{ $item->angsuran_ke }}</td>
                                <td>
                                    {{ $item->jatuh_tempo->format('d-m-Y') }}
                                </td>
                                <td>
                                    Rp {{ number_format($item->total_tagihan, 0, ',', '.') }}
                                </td>
                                <td>
                                    Rp {{ number_format($item->total_dibayar, 0, ',', '.') }}
                                </td>
                                <td class="text-danger">
                                    <strong>
                                        Rp {{ number_format($item->sisa_tagihan, 0, ',', '.') }}
                                    </strong>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Tidak ada tunggakan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection