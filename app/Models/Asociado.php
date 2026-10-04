<?php

namespace App\Models;

use Database\Factories\AsociadoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Asociado extends Authenticatable
{
    /** @use HasFactory<AsociadoFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre_completo', 'foto', 'cedula', 'fecha_nacimiento',
        'provincia_id', 'canton_id', 'ciudad', 'direccion',
        'correo', 'telefono', 'password',
        'fecha_afiliacion', 'fecha_inicio', 'fecha_fin',
        'plan_cuota', 'pagado_hasta', 'moroso', 'activo',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_afiliacion' => 'date',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'pagado_hasta' => 'date',
        'moroso' => 'boolean',
        'activo' => 'boolean',
        'password' => 'hashed',
    ];

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }

    public function canton(): BelongsTo
    {
        return $this->belongsTo(Canton::class);
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(PagoCuota::class);
    }
}
