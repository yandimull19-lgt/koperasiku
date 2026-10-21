@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Simpanan</h3>
        <a href="{{ route('simpanan.create') }}" class="btn btn-primary">+ Tambah Simpanan</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Jenis Simpanan</th>
                        <th>Nominal</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($simpanan as $key => $item)
                    <tr>
                        <td>{{ $simpanan->firstItem() + $key }}</td>
                        <td>{{ $item->anggota->nama ?? '-' }}</td>
                        <td><span class="badge bg-info text-dark">{{ ucfirst($item->jenis) }}</span></td>
                        <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                        <td>{{ $item->tanggal_transaksi ? \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d-m-Y H:i') : '-' }}</td>
                        <td><span class="badge bg-success">{{ ucfirst($item->status) }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-3">Belum ada data simpanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $simpanan->links() }}
        </div>
    </div>
</div>
@endsection