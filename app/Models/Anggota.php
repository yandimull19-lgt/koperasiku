<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
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
}
