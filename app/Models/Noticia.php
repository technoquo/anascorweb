<?php

namespace App\Models;

use Database\Factories\NoticiaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    /** @use HasFactory<NoticiaFactory> */
    use HasFactory;

    protected $fillable = [
        'titulo', 'slug', 'resumen', 'contenido',
        'imagen', 'alt', 'video_url', 'publicado_en', 'activo',
    ];

    protected $casts = [
        'publicado_en' => 'datetime',
        'activo' => 'boolean',
    ];
}
