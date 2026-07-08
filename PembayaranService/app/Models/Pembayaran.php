<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';

    protected $fillable = [
        'penyewaan_id',
        'tanggal_bayar',
        'jenis_pembayaran',
        'periode',
        'nominal',
        'status_bayar',
        'jatuh_tempo'
    ];
}
