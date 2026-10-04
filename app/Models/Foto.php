<?php

namespace App\Models;

use Database\Factories\FotoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Foto extends Model
{
    /** @use HasFactory<FotoFactory> */
    use HasFactory;

    protected $fillable = ['album_id', 'imagen', 'alt', 'orden'];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
