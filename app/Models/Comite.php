<?php

namespace App\Models;

use Database\Factories\ComiteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comite extends Model
{
    /** @use HasFactory<ComiteFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'slug', 'logo', 'descripcion', 'orden', 'activo'];

    protected $casts = ['activo' => 'boolean'];

    public function miembros(): HasMany
    {
        return $this->hasMany(ComiteMiembro::class);
    }

    public function eventos(): HasMany
    {
        return $this->hasMany(Evento::class);
    }
}
