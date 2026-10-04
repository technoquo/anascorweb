<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\HitoHistoriaResource\Pages;
use App\Models\HitoHistoria;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HitoHistoriaResource extends Resource
{
    protected static ?string $model = HitoHistoria::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Anascor;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationLabel = 'Historia';

    protected static ?string $modelLabel = 'hito histórico';

    protected static ?string $pluralModelLabel = 'Historia';

    protected static ?int $navigationSort = 4;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Administrador', 'Editor']) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('anio')
                ->label('Año')
                ->required()
                ->numeric()
                ->minValue(1900)
                ->maxValue(2100),
            TextInput::make('titulo')
                ->label('Título')
                ->required()
                ->maxLength(255),
            Textarea::make('descripcion')
                ->label('Descripción')
                ->required()
                ->rows(4)
                ->columnSpanFull(),
            FileUpload::make('imagen')
                ->label('Imagen (opcional)')
                ->image()
                ->imageEditor()
                ->directory('historia')
                ->nullable(),
            TextInput::make('alt')
                ->label('Texto alternativo de imagen')
                ->maxLength(255)
                ->nullable(),
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
                TextColumn::make('anio')
                    ->label('Año')
                    ->sortable(),
                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->limit(50),
                ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->square(),
                TextColumn::make('orden')
                    ->label('Orden')
                    ->sortable(),
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
            'index' => Pages\ListHitoHistorias::route('/'),
            'create' => Pages\CreateHitoHistoria::route('/create'),
            'edit' => Pages\EditHitoHistoria::route('/{record}/edit'),
        ];
    }
}
