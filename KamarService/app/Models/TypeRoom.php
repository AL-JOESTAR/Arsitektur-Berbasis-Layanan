<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeRoom extends Model
{
    protected $fillable = [
        'name',
        'price'
    ];

    public function kamars()
{
    return $this->hasMany(Kamar::class);
}

public function facilities()
{
    return $this->belongsToMany(
        Facility::class,
        'room_type_facility'
    );
}
}
