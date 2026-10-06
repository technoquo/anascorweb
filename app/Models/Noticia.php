<?php

namespace App\Models;

use Database\Factories\NoticiaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function imagenes(): HasMany
    {
        return $this->hasMany(NoticiaImagen::class)->orderBy('orden');
    }
}
