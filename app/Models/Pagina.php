<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    protected $fillable = ['clave', 'titulo', 'contenido', 'imagen', 'alt', 'video_url'];
}
