<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expresidente extends Model
{
    protected $fillable = ['nombre', 'foto', 'anio_inicio', 'anio_fin', 'orden'];
}
