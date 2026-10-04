<?php

namespace App\Filament\Widgets;

use App\Models\Asociado;
use App\Models\Evento;
use App\Models\MensajeContacto;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Asociados activos', Asociado::where('activo', true)->count())
                ->icon('heroicon-o-users')
                ->color('success'),
            Stat::make('Asociados morosos', Asociado::where('moroso', true)->count())
                ->icon('heroicon-o-exclamation-triangle')
                ->color('danger'),
            Stat::make('Próximos eventos', Evento::where('inicia_en', '>=', now())->where('activo', true)->count())
                ->icon('heroicon-o-calendar-days')
                ->color('info'),
            Stat::make('Mensajes sin leer', MensajeContacto::where('leido', false)->count())
                ->icon('heroicon-o-envelope')
                ->color('warning'),
        ];
    }
}
