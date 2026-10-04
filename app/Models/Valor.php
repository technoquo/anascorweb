<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valor extends Model
{
    protected $table = 'valores';

    protected $fillable = ['nombre', 'descripcion', 'icono', 'orden', 'activo'];

    protected $casts = ['activo' => 'boolean'];
}
