<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LescoSeccion extends Model
{
    protected $table = 'lesco_secciones';

    protected $fillable = ['titulo', 'slug', 'descripcion', 'video_url', 'orden', 'activo'];

    protected $casts = ['activo' => 'boolean'];
}
