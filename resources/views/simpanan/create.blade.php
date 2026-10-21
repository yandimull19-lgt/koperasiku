@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Tambah Simpanan</h3>
    <div class="card border-0 shadow-sm mt-3">
        <div class="card-body">
            <form action="{{ route('simpanan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Pilih Anggota</label>
                    <select name="anggota_id" class="form-select" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($anggota as $item)
                            <option value="{{ $item->id }}">{{ $item->no_anggota }} - {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Simpanan</label>
                    <select name="jenis" class="form-select" required>
                        <option value="pokok">Pokok</option>
                        <option value="wajib">Wajib</option>
                        <option value="sukarela">Sukarela</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nominal (Rp)</label>
                    <input type="number" name="nominal" class="form-control" placeholder="Contoh: 50000" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Transaksi</label>
                    <input type="datetime-local" name="tanggal_transaksi" class="form-control" value="{{ date('Y-m-d\TH:i') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                <a href="{{ route('simpanan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection