<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\AsociadoResource\Pages;
use App\Filament\Resources\AsociadoResource\RelationManagers\PagosRelationManager;
use App\Models\Asociado;
use App\Models\Canton;
use App\Models\Provincia;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class AsociadoResource extends Resource
{
    protected static ?string $model = Asociado::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Asociados;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationLabel = 'Personas asociadas';

    protected static ?string $modelLabel = 'asociado';

    protected static ?string $pluralModelLabel = 'Personas asociadas';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Administrador', 'Tesorería']) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('foto')
                ->label('Foto del asociado')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('asociados/fotos')
                ->avatar()
                ->nullable()
                ->columnSpanFull(),
            TextInput::make('nombre_completo')
                ->label('Nombre completo')
                ->required()
                ->maxLength(255),
            TextInput::make('cedula')
                ->label('Cédula')
                ->required()
                ->unique(Asociado::class, 'cedula', ignoreRecord: true)
                ->maxLength(20),
            DatePicker::make('fecha_nacimiento')
                ->label('Fecha de nacimiento')
                ->required(),
            Select::make('provincia_id')
                ->label('Provincia')
                ->options(Provincia::pluck('nombre', 'id'))
                ->required()
                ->live()
                ->afterStateUpdated(fn (Set $set) => $set('canton_id', null)),
            Select::make('canton_id')
                ->label('Cantón')
                ->options(fn (Get $get) => Canton::where('provincia_id', $get('provincia_id'))->pluck('nombre', 'id'))
                ->required()
                ->searchable(),
            TextInput::make('ciudad')
                ->label('Ciudad')
                ->required()
                ->maxLength(100),
            TextInput::make('direccion')
                ->label('Dirección')
                ->required()
                ->maxLength(500),
            TextInput::make('correo')
                ->label('Correo electrónico')
                ->email()
                ->unique(Asociado::class, 'correo', ignoreRecord: true)
                ->nullable()
                ->maxLength(255),
            TextInput::make('telefono')
                ->label('Teléfono')
                ->tel()
                ->nullable()
                ->maxLength(20),
            TextInput::make('password')
                ->label('Contraseña')
                ->password()
                ->revealable()
                ->required(fn (string $operation): bool => $operation === 'create')
                ->dehydrated(fn ($state) => filled($state))
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->helperText('Dejar en blanco para conservar la contraseña actual (solo en edición).'),
            DatePicker::make('fecha_afiliacion')
                ->label('Fecha de afiliación')
                ->required(),
            DatePicker::make('fecha_inicio')
                ->label('Fecha de inicio como asociado')
                ->required(),
            DatePicker::make('fecha_fin')
                ->label('Fecha de fin (vacío si sigue activo)')
                ->nullable(),
            Select::make('plan_cuota')
                ->label('Plan de cuota')
                ->options([
                    'mensual' => 'Mensual (₡5.000)',
                    'trimestral' => 'Trimestral (₡15.000)',
                    'anual' => 'Anual (₡60.000)',
                ])
                ->required(),
            DatePicker::make('pagado_hasta')
                ->label('Pagado hasta')
                ->nullable(),
            Toggle::make('activo')
                ->label('Activo')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(asset('img/avatar-default.svg')),
                TextColumn::make('nombre_completo')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('cedula')
                    ->label('Cédula')
                    ->searchable(),
                TextColumn::make('plan_cuota')
                    ->label('Plan')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'mensual' => 'info',
                        'trimestral' => 'warning',
                        'anual' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('pagado_hasta')
                    ->label('Pagado hasta')
                    ->date('d/m/Y')
                    ->sortable(),
                IconColumn::make('moroso')
                    ->label('Moroso')
                    ->boolean()
                    ->trueIcon('heroicon-o-exclamation-circle')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('danger')
                    ->falseColor('success'),
                IconColumn::make('activo')
                    ->label('Activo')
                    ->boolean(),
            ])
            ->defaultSort('nombre_completo')
            ->filters([
                TernaryFilter::make('moroso')
                    ->label('Morosidad')
                    ->trueLabel('Solo morosos')
                    ->falseLabel('Solo al día'),
                TernaryFilter::make('activo')
                    ->label('Estado')
                    ->trueLabel('Solo activos')
                    ->falseLabel('Solo inactivos'),
                SelectFilter::make('provincia_id')
                    ->label('Provincia')
                    ->relationship('provincia', 'nombre'),
                SelectFilter::make('plan_cuota')
                    ->label('Plan de cuota')
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

    public static function getRelations(): array
    {
        return [
            PagosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAsociados::route('/'),
            'create' => Pages\CreateAsociado::route('/create'),
            'edit' => Pages\EditAsociado::route('/{record}/edit'),
        ];
    }
}
