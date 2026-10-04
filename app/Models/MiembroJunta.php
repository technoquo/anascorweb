<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MiembroJunta extends Model
{
    protected $table = 'miembros_junta';

    protected $fillable = ['nombre', 'puesto', 'foto', 'periodo', 'orden', 'activo'];

    protected $casts = ['activo' => 'boolean'];
}
