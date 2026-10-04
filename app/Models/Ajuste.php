<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    protected $fillable = ['clave', 'valor'];

    public static function get(string $clave, string $default = ''): string
    {
        return (string) static::where('clave', $clave)->value('valor') ?: $default;
    }
}
