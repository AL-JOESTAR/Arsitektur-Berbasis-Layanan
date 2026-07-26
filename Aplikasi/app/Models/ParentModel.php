<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ParentModel extends Authenticatable
{
    protected $table = 'parents';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
    ];

    protected $hidden = [
        'password',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'parent_id');
    }
}
