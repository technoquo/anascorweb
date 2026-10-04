<?php

namespace App\Filament\Exports;

use App\Models\Asociado;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class AsociadoExporter extends Exporter
{
    protected static ?string $model = Asociado::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('nombre_completo')->label('Nombre completo'),
            ExportColumn::make('cedula')->label('Cédula'),
            ExportColumn::make('fecha_nacimiento')->label('Fecha de nacimiento'),
            ExportColumn::make('provincia.nombre')->label('Provincia'),
            ExportColumn::make('canton.nombre')->label('Cantón'),
            ExportColumn::make('ciudad')->label('Ciudad'),
            ExportColumn::make('correo')->label('Correo electrónico'),
            ExportColumn::make('telefono')->label('Teléfono'),
            ExportColumn::make('fecha_afiliacion')->label('Fecha de afiliación'),
            ExportColumn::make('plan_cuota')->label('Plan de cuota'),
            ExportColumn::make('pagado_hasta')->label('Pagado hasta'),
            ExportColumn::make('moroso')
                ->label('Moroso')
                ->formatStateUsing(fn ($state) => $state ? 'Sí' : 'No'),
            ExportColumn::make('activo')
                ->label('Activo')
                ->formatStateUsing(fn ($state) => $state ? 'Sí' : 'No'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $count = number_format($export->successful_rows);

        return "La exportación de {$count} ".str('asociado')->plural($export->successful_rows).' se completó.';
    }
}
