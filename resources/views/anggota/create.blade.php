
@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
<div class="mb-4">
    <h1>Tambah Anggota</h1>
    <p class="text-muted">Isi formulir untuk menambahkan anggota koperasi.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('anggota.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nomor Anggota</label>
                <input type="text" name="nomor_anggota"
                    class="form-control" value="{{ old('nomor_anggota') }}" required>
                @error('nomor_anggota')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama"
                    class="form-control" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text" name="nik"
                    class="form-control" value="{{ old('nik') }}" required>
                @error('nik')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input type="text" name="no_hp"
                    class="form-control" value="{{ old('no_hp') }}" required>
                @error('no_hp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Bergabung</label>
                <input type="date" name="tanggal_bergabung"
                    class="form-control" value="{{ old('tanggal_bergabung') }}" required>
                @error('tanggal_bergabung')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan Anggota
            </button>

            <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
