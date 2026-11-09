@extends('layouts.app')

@section('title', 'Tambah Pengajuan Pinjaman')

@section('content')
<div class="container-fluid">

    <div class="mb-3">
        <h3>Tambah Pengajuan Pinjaman</h3>
        <p class="text-muted">
            Formulir pengajuan pinjaman anggota koperasi
        </p>
    </div>

    <div class="card card-primary card-outline">

        <div class="card-header">
            <h3 class="card-title">Form Pengajuan Pinjaman</h3>
        </div>

        <form action="{{ route('pinjaman.store') }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- Pesan validasi --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Periksa kembali data yang dimasukkan.</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Pilih anggota --}}
                <div class="form-group">
                    <label for="anggota_id">Nama Anggota</label>

                    <select name="anggota_id"
                            id="anggota_id"
                            class="form-control @error('anggota_id') is-invalid @enderror"
                            required>

                        <option value="">-- Pilih Anggota --</option>

                        @forelse($anggota as $item)
                            <option value="{{ $item->id }}"
                                {{ old('anggota_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nomor_anggota }} - {{ $item->nama }}
                            </option>
                        @empty
                            <option value="" disabled>
                                Belum ada anggota aktif
                            </option>
                        @endforelse

                    </select>

                    @error('anggota_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jumlah pengajuan --}}
                <div class="form-group">
                    <label for="jumlah_pengajuan">Jumlah Pengajuan (Rp)</label>

                    <input type="number"
                           name="jumlah_pengajuan"
                           id="jumlah_pengajuan"
                           class="form-control @error('jumlah_pengajuan') is-invalid @enderror"
                           value="{{ old('jumlah_pengajuan') }}"
                           min="1"
                           step="1000"
                           placeholder="Masukkan jumlah pinjaman"
                           required>

                    @error('jumlah_pengajuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Bunga --}}
                <div class="form-group">
                    <label for="bunga_persen">Bunga (%)</label>

                    <input type="number"
                           name="bunga_persen"
                           id="bunga_persen"
                           class="form-control @error('bunga_persen') is-invalid @enderror"
                           value="{{ old('bunga_persen', 0) }}"
                           min="0"
                           max="100"
                           step="0.01"
                           placeholder="Contoh: 2.5"
                           required>

                    @error('bunga_persen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tenor --}}
                <div class="form-group">
                    <label for="tenor_bulan">Lama Pinjaman (Bulan)</label>

                    <input type="number"
                           name="tenor_bulan"
                           id="tenor_bulan"
                           class="form-control @error('tenor_bulan') is-invalid @enderror"
                           value="{{ old('tenor_bulan') }}"
                           min="1"
                           max="120"
                           placeholder="Contoh: 12"
                           required>

                    @error('tenor_bulan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tujuan pinjaman --}}
                <div class="form-group">
                    <label for="tujuan">Tujuan Pinjaman</label>

                    <textarea name="tujuan"
                              id="tujuan"
                              rows="4"
                              class="form-control @error('tujuan') is-invalid @enderror"
                              placeholder="Jelaskan tujuan pengajuan pinjaman"
                              required>{{ old('tujuan') }}</textarea>

                    @error('tujuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- Tombol --}}
            <div class="card-footer">

                <button type="submit"
                        class="btn btn-primary"
                        {{ $anggota->isEmpty() ? 'disabled' : '' }}>
                    <i class="fas fa-save"></i> Simpan Pengajuan
                </button>

                <a href="{{ route('pinjaman.index') }}"
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

            </div>

        </form>

    </div>

</div>
@endsection
