<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoorLog extends Model
{
    
    protected $guarded = [];

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
