<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ajuste extends Model
{
    protected $fillable = ['clave', 'valor'];

    public static function get(string $clave, string $default = ''): string
    {
        return (string) static::where('clave', $clave)->value('valor') ?: $default;
    }

    public static function logoUrl(string $clave): string
    {
        $valor = static::get($clave);

        if ($valor) {
            return Storage::disk('public')->url($valor);
        }

        return asset('logo/anascor.png');
    }
}
