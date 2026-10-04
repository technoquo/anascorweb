<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HitoHistoria extends Model
{
    protected $table = 'hitos_historia';

    protected $fillable = ['anio', 'titulo', 'descripcion', 'imagen', 'alt', 'orden'];
}
