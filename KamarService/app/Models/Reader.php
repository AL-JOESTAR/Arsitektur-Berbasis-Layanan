<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
     protected $fillable = [
        'reader_name',
        'reader_type'
    ];

    public function logs()
    {
        return $this->hasMany(DoorLog::class);
    }
}
