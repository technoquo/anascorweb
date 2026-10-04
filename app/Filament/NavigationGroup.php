<?php

namespace App\Filament;

use Filament\Support\Contracts\HasLabel;

enum NavigationGroup: string implements HasLabel
{
    case Inicio = 'inicio';
    case Anascor = 'anascor';
    case Lesco = 'lesco';
    case GaleriaComites = 'galeria_comites';
    case Asociados = 'asociados';
    case Configuracion = 'configuracion';

    public function getLabel(): string
    {
        return match ($this) {
            self::Inicio => 'Inicio',
            self::Anascor => 'ANASCOR',
            self::Lesco => 'LESCO',
            self::GaleriaComites => 'Galería y comités',
            self::Asociados => 'Asociados',
            self::Configuracion => 'Configuración',
        };
    }
}
