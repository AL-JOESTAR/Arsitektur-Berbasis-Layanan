<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = [
        'Nomor_Kamar', 'type_room_id', 'status_kamar'
    ];

    public function typeRoom()
{
    return $this->belongsTo(TypeRoom::class, 'type_room_id');
}

public function penyewaans()
{
    return $this->hasMany(Penyewaan::class);
}
}
