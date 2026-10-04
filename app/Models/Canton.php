<?php

namespace App\Models;

use Database\Factories\CantonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Canton extends Model
{
    /** @use HasFactory<CantonFactory> */
    use HasFactory;

    protected $table = 'cantones';

    protected $fillable = ['provincia_id', 'nombre'];

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }

    public function asociados(): HasMany
    {
        return $this->hasMany(Asociado::class);
    }
}
