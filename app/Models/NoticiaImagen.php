<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NoticiaImagen extends Model
{
    protected $table = 'noticia_imagenes';

    protected $fillable = ['noticia_id', 'imagen', 'alt', 'orden'];

    public function noticia(): BelongsTo
    {
        return $this->belongsTo(Noticia::class);
    }
}
