<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    protected $guarded = [];

    public function logs()
    {
        return $this->hasMany(DoorLog::class);
    }
}
