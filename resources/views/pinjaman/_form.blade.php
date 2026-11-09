<div class="form-group">
    <label for="anggota_id">Nama Anggota</label>

    <select name="anggota_id"
            id="anggota_id"
            class="form-control @error('anggota_id') is-invalid @enderror"
            required>

        <option value="">-- Pilih Anggota --</option>

        @foreach($anggotas as $anggota)
            <option value="{{ $anggota->id }}"
                @selected(old('anggota_id', $pinjaman->anggota_id ?? '') == $anggota->id)>
                {{ $anggota->nomor_anggota }} - {{ $anggota->nama }}
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
           class="form-control"
           value="{{ old('jumlah_pengajuan', $pinjaman->jumlah_pengajuan ?? '') }}"
           min="1"
           step="1000"
           required>
</div>

<div class="form-group">
    <label for="bunga_persen">Bunga (%)</label>

    <input type="number"
           name="bunga_persen"
           id="bunga_persen"
           class="form-control"
           value="{{ old('bunga_persen', $pinjaman->bunga_persen ?? 0) }}"
           min="0"
           step="0.01"
           required>
</div>

<div class="form-group">
    <label for="tenor_bulan">Lama Pinjaman (Bulan)</label>

    <input type="number"
           name="tenor_bulan"
           id="tenor_bulan"
           class="form-control"
           value="{{ old('tenor_bulan', $pinjaman->tenor_bulan ?? '') }}"
           min="1"
           required>
</div>

<div class="form-group">
    <label for="tujuan">Tujuan Pinjaman</label>

    <textarea name="tujuan"
              id="tujuan"
              rows="4"
              class="form-control"
              required>{{ old('tujuan', $pinjaman->tujuan ?? '') }}</textarea>
</div>
