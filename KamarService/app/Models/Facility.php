<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ['name'];

    public function typeRooms()
{
    return $this->belongsToMany(
        TypeRoom::class,
        'room_type_facility'
    );
}
}
