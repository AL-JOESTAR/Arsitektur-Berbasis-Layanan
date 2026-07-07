<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = [
        'Nomor_Kamar', 'TypeRoom_id', 'status_kamar'
    ];

    public function typeRoom()
{
    return $this->belongsTo(TypeRoom::class);
}

public function penyewaans()
{
    return $this->hasMany(Penyewaan::class);
}
}
