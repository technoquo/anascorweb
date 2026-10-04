<?php

namespace App\Models;

use Database\Factories\EventoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evento extends Model
{
    /** @use HasFactory<EventoFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre', 'slug', 'descripcion', 'imagen',
        'lugar', 'inicia_en', 'termina_en', 'comite_id', 'activo',
    ];

    protected $casts = [
        'inicia_en' => 'datetime',
        'termina_en' => 'datetime',
        'activo' => 'boolean',
    ];

    public function comite(): BelongsTo
    {
        return $this->belongsTo(Comite::class);
    }
}
