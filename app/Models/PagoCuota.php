<?php

namespace App\Models;

use Database\Factories\PagoCuotaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PagoCuota extends Model
{
    /** @use HasFactory<PagoCuotaFactory> */
    use HasFactory;

    protected $table = 'pagos_cuota';

    protected $fillable = [
        'asociado_id', 'plan', 'monto',
        'cubre_desde', 'cubre_hasta', 'pagado_en',
        'comprobante', 'registrado_por',
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'cubre_desde' => 'date',
        'cubre_hasta' => 'date',
        'pagado_en' => 'date',
    ];

    public function asociado(): BelongsTo
    {
        return $this->belongsTo(Asociado::class);
    }

    public function registrador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }
}
