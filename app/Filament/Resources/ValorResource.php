<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\ValorResource\Pages;
use App\Models\Valor;
use Filament\Actions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ValorResource extends Resource
{
    protected static ?string $model = Valor::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Anascor;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Valores';

    protected static ?string $modelLabel = 'valor';

    protected static ?string $pluralModelLabel = 'Valores';

    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Administrador', 'Editor']) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nombre')
                ->label('Nombre')
                ->required()
                ->maxLength(100),
            TextInput::make('icono')
                ->label('Ícono Heroicon (opcional)')
                ->maxLength(100)
                ->placeholder('heroicon-o-heart')
                ->nullable(),
            Textarea::make('descripcion')
                ->label('Descripción (opcional)')
                ->rows(3)
                ->nullable()
                ->columnSpanFull(),
            TextInput::make('orden')
                ->label('Orden')
                ->numeric()
                ->default(0),
            Toggle::make('activo')
                ->label('Activo')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('icono')
                    ->label('Ícono')
                    ->default('—'),
                TextColumn::make('orden')
                    ->label('Orden')
                    ->sortable(),
                ToggleColumn::make('activo')
                    ->label('Activo'),
            ])
            ->reorderable('orden')
            ->defaultSort('orden')
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
            'index' => Pages\ListValors::route('/'),
            'create' => Pages\CreateValor::route('/create'),
            'edit' => Pages\EditValor::route('/{record}/edit'),
        ];
    }
}
