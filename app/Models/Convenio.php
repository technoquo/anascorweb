<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'imagen', 'url', 'status', 'orden'];
}
