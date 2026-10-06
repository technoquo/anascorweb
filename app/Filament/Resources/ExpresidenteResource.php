<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\ExpresidenteResource\Pages;
use App\Models\Expresidente;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ExpresidenteResource extends Resource
{
    protected static ?string $model = Expresidente::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Anascor;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationLabel = 'Ex-presidentes';

    protected static ?string $modelLabel = 'ex-presidente';

    protected static ?string $pluralModelLabel = 'Ex-presidentes';

    protected static ?int $navigationSort = 5;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Administrador', 'Editor']) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nombre')
                ->label('Nombre completo')
                ->required()
                ->maxLength(255),
            FileUpload::make('foto')
                ->label('Fotografía')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('expresidentes')
                ->nullable(),
            TextInput::make('anio_inicio')
                ->label('Año de inicio')
                ->required()
                ->numeric()
                ->minValue(1970)
                ->maxValue(2100),
            TextInput::make('anio_fin')
                ->label('Año de fin (vacío si sigue activo)')
                ->numeric()
                ->nullable()
                ->minValue(1970)
                ->maxValue(2100),
            TextInput::make('orden')
                ->label('Orden')
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('anio_inicio')
                    ->label('Inicio'),
                TextColumn::make('anio_fin')
                    ->label('Fin')
                    ->default('—'),
                TextColumn::make('orden')
                    ->label('Orden')
                    ->sortable(),
            ])
            ->reorderable('orden')
            ->defaultSort('orden', 'desc')
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
            'index' => Pages\ListExpresidentes::route('/'),
            'create' => Pages\CreateExpresidente::route('/create'),
            'edit' => Pages\EditExpresidente::route('/{record}/edit'),
        ];
    }
}
