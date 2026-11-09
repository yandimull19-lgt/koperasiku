<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Pinjaman;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'nomor_anggota',
        'nama',
        'nik',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'tanggal_bergabung',
        'status',
    ];

    public function pinjaman(): HasMany
    {
        return $this->hasMany(Pinjaman::class);
    }
}
