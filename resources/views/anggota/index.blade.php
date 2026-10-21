
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1>Data Anggota</h1>
        <p class="text-muted">Daftar anggota KoperasiKu</p>
    </div>

    <a href="{{ route('anggota.create') }}" class="btn btn-primary">
        + Tambah Anggota
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Anggota</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Jenis Kelamin</th>
                        <th>No. HP</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($anggotas as $anggota)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $anggota->nomor_anggota }}</td>
                            <td>{{ $anggota->nama }}</td>
                            <td>{{ $anggota->nik }}</td>
                            <td>{{ $anggota->jenis_kelamin }}</td>
                            <td>{{ $anggota->no_hp }}</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $anggota->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                Belum ada data anggota.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
