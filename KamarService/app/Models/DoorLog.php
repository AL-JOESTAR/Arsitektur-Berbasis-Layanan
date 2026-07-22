<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoorLog extends Model
{
     protected $fillable = [

        'reader_id',

        'user_id',

        'scan_time',

        'access_result',

        'reason'

    ];

    protected $casts = [

        'scan_time' => 'datetime',

    ];

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }

}
