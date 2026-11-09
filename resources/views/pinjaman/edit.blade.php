@extends('layouts.app')

@section('title', 'Edit Pengajuan Pinjaman')

@section('content')
<div class="container-fluid">

    <div class="mb-3">
        <h3>Edit Pengajuan Pinjaman</h3>
        <p class="text-muted">
            Perbarui informasi pengajuan pinjaman anggota
        </p>
    </div>

    <div class="card card-warning card-outline">

        <div class="card-header">
            <h3 class="card-title">Form Edit Pinjaman</h3>
        </div>

        <form action="{{ route('pinjaman.update', $pinjaman->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="card-body">

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

                <div class="form-group">
                    <label for="anggota_id">Nama Anggota</label>

                    <select name="anggota_id"
                            id="anggota_id"
                            class="form-control @error('anggota_id') is-invalid @enderror"
                            required>

                        <option value="">-- Pilih Anggota --</option>

                        @foreach($anggotas as $anggota)
                            <option value="{{ $anggota->id }}"
                                @selected(old('anggota_id', $pinjaman->anggota_id) == $anggota->id)>
                                {{ $anggota->nomor_anggota }} -
                                {{ $anggota->nama }}
                            </option>
                        @endforeach

                    </select>

                    @error('anggota_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jumlah_pengajuan">Jumlah Pengajuan (Rp)</label>

                    <input type="number"
                           name="jumlah_pengajuan"
                           id="jumlah_pengajuan"
                           class="form-control @error('jumlah_pengajuan') is-invalid @enderror"
                           value="{{ old('jumlah_pengajuan', $pinjaman->jumlah_pengajuan) }}"
                           min="1"
                           step="1000"
                           required>

                    @error('jumlah_pengajuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="bunga_persen">Bunga (%)</label>

                    <input type="number"
                           name="bunga_persen"
                           id="bunga_persen"
                           class="form-control @error('bunga_persen') is-invalid @enderror"
                           value="{{ old('bunga_persen', $pinjaman->bunga_persen) }}"
                           min="0"
                           max="100"
                           step="0.01"
                           required>

                    @error('bunga_persen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tenor_bulan">Lama Pinjaman (Bulan)</label>

                    <input type="number"
                           name="tenor_bulan"
                           id="tenor_bulan"
                           class="form-control @error('tenor_bulan') is-invalid @enderror"
                           value="{{ old('tenor_bulan', $pinjaman->tenor_bulan) }}"
                           min="1"
                           max="120"
                           required>

                    @error('tenor_bulan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tujuan">Tujuan Pinjaman</label>

                    <textarea name="tujuan"
                              id="tujuan"
                              rows="4"
                              class="form-control @error('tujuan') is-invalid @enderror"
                              required>{{ old('tujuan', $pinjaman->tujuan) }}</textarea>

                    @error('tujuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Perbarui Data
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
