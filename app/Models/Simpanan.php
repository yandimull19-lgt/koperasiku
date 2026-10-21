<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Simpanan extends Model
{
    use HasFactory;

    protected $table = 'simpanan';

    protected $fillable = [
        'anggota_id',
        'jenis',
        'nominal',
        'tanggal_transaksi',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_transaksi' => 'datetime',
            'nominal' => 'decimal:2',
        ];
    }

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}