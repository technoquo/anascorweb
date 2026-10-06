<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventoImagen extends Model
{
    protected $table = 'evento_imagenes';

    protected $fillable = ['evento_id', 'imagen', 'alt', 'orden'];

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }
}
