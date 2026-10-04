<?php

namespace App\Models;

use Database\Factories\ProvinciaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provincia extends Model
{
    /** @use HasFactory<ProvinciaFactory> */
    use HasFactory;

    protected $fillable = ['nombre'];

    public function cantones(): HasMany
    {
        return $this->hasMany(Canton::class);
    }

    public function asociados(): HasMany
    {
        return $this->hasMany(Asociado::class);
    }
}
