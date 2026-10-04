<?php

namespace App\Filament\Resources\AsociadoResource\RelationManagers;

use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PagosRelationManager extends RelationManager
{
    protected static string $relationship = 'pagos';

    protected static ?string $title = 'Pagos de cuota';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('plan')
                ->label('Plan')
                ->options([
                    'mensual' => 'Mensual (₡5.000)',
                    'trimestral' => 'Trimestral (₡15.000)',
                    'anual' => 'Anual (₡60.000)',
                ])
                ->required()
                ->live()
                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                    $montos = ['mensual' => 5000, 'trimestral' => 15000, 'anual' => 60000];
                    $set('monto', $montos[$state] ?? 0);

                    $desde = $get('cubre_desde');
                    if ($desde && $state) {
                        $fecha = Carbon::parse($desde);
                        $hasta = match ($state) {
                            'mensual' => $fecha->addMonth()->subDay(),
                            'trimestral' => $fecha->addMonths(3)->subDay(),
                            'anual' => $fecha->addYear()->subDay(),
                            default => null,
                        };
                        $set('cubre_hasta', $hasta?->toDateString());
                    }
                }),
            TextInput::make('monto')
                ->label('Monto (₡)')
                ->numeric()
                ->required()
                ->prefix('₡'),
            DatePicker::make('cubre_desde')
                ->label('Cubre desde')
                ->required()
                ->live()
                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                    $plan = $get('plan');
                    if ($state && $plan) {
                        $fecha = Carbon::parse($state);
                        $hasta = match ($plan) {
                            'mensual' => $fecha->addMonth()->subDay(),
                            'trimestral' => $fecha->addMonths(3)->subDay(),
                            'anual' => $fecha->addYear()->subDay(),
                            default => null,
                        };
                        $set('cubre_hasta', $hasta?->toDateString());
                    }
                }),
            DatePicker::make('cubre_hasta')
                ->label('Cubre hasta')
                ->required(),
            DatePicker::make('pagado_en')
                ->label('Fecha de pago')
                ->required()
                ->default(today()),
            FileUpload::make('comprobante')
                ->label('Comprobante (opcional)')
                ->directory('pagos/comprobantes')
                ->nullable()
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('plan')
                    ->label('Plan')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'mensual' => 'info',
                        'trimestral' => 'warning',
                        'anual' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('monto')
                    ->label('Monto')
                    ->money('CRC'),
                TextColumn::make('pagado_en')
                    ->label('Pagado el')
                    ->date('d/m/Y'),
                TextColumn::make('cubre_desde')
                    ->label('Desde')
                    ->date('d/m/Y'),
                TextColumn::make('cubre_hasta')
                    ->label('Hasta')
                    ->date('d/m/Y'),
            ])
            ->defaultSort('pagado_en', 'desc')
            ->headerActions([
                Actions\CreateAction::make()
                    ->label('Registrar pago')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['registrado_por'] = auth()->id();

                        return $data;
                    }),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([]);
    }
}
