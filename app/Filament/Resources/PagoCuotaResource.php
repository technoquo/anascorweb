<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\PagoCuotaResource\Pages;
use App\Models\Asociado;
use App\Models\PagoCuota;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PagoCuotaResource extends Resource
{
    protected static ?string $model = PagoCuota::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Asociados;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Pagos de cuota';

    protected static ?string $modelLabel = 'pago de cuota';

    protected static ?string $pluralModelLabel = 'Pagos de cuota';

    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Administrador', 'Tesorería']) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('asociado_id')
                ->label('Asociado')
                ->options(Asociado::orderBy('nombre_completo')->pluck('nombre_completo', 'id'))
                ->searchable()
                ->required(),
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('asociado.nombre_completo')
                    ->label('Asociado')
                    ->searchable()
                    ->sortable(),
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
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('cubre_hasta')
                    ->label('Cubre hasta')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('registrador.name')
                    ->label('Registrado por')
                    ->default('—'),
            ])
            ->defaultSort('pagado_en', 'desc')
            ->filters([
                SelectFilter::make('plan')
                    ->label('Plan')
                    ->options([
                        'mensual' => 'Mensual',
                        'trimestral' => 'Trimestral',
                        'anual' => 'Anual',
                    ]),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPagoCuotas::route('/'),
            'create' => Pages\CreatePagoCuota::route('/create'),
            'edit' => Pages\EditPagoCuota::route('/{record}/edit'),
        ];
    }
}
