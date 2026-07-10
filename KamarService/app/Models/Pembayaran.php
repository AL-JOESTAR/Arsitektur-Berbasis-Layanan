<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'penyewaan_id',
        'tanggal_bayar',
        'jenis_pembayaran',
        'periode',
        'nominal',
        'status_bayar',
        'jatuh_tempo'
    ];

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'penyewaan_id');
    }

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'penyewaan_id');
    }
}
