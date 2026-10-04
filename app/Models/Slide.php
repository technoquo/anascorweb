<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['titulo', 'imagen', 'alt', 'enlace', 'orden', 'activo'];

    protected $casts = ['activo' => 'boolean'];
}
