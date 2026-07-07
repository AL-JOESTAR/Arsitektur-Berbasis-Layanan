<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = ['judul', 'pengarang', 'tanngal_publikasi'];
}
