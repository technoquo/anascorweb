<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComiteMiembro extends Model
{
    protected $fillable = ['comite_id', 'nombre', 'cargo', 'descripcion', 'foto', 'orden'];

    public function comite(): BelongsTo
    {
        return $this->belongsTo(Comite::class);
    }
}
