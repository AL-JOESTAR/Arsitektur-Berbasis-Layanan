<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    protected $table = 'parents';

     protected $fillable = [
        'nama',
        'email',
        'no_hp'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'parent_id');
    }
}
