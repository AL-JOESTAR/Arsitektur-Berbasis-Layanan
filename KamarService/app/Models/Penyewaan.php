<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $fillable = [
        'penyewa_id','kamar_id','start', 'end','status_sewa'
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
}
