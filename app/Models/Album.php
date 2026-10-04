<?php

namespace App\Models;

use Database\Factories\AlbumFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    /** @use HasFactory<AlbumFactory> */
    use HasFactory;

    protected $table = 'albumes';

    protected $fillable = ['titulo', 'slug', 'anio', 'portada', 'descripcion', 'activo'];

    protected $casts = ['activo' => 'boolean'];

    public function fotos(): HasMany
    {
        return $this->hasMany(Foto::class);
    }
}
