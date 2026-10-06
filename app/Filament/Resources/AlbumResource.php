<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\AlbumResource\Pages;
use App\Filament\Resources\AlbumResource\RelationManagers\FotosRelationManager;
use App\Models\Album;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class AlbumResource extends Resource
{
    protected static ?string $model = Album::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::GaleriaComites;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Álbumes';

    protected static ?string $modelLabel = 'álbum';

    protected static ?string $pluralModelLabel = 'Álbumes';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Administrador', 'Editor']) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('titulo')
                ->label('Título')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null
                )
                ->columnSpanFull(),
            TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->unique(Album::class, 'slug', ignoreRecord: true)
                ->maxLength(255),
            TextInput::make('anio')
                ->label('Año')
                ->required()
                ->numeric()
                ->minValue(1970)
                ->maxValue(2100),
            FileUpload::make('portada')
                ->label('Imagen de portada')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('galeria/portadas')
                ->required()
                ->columnSpanFull(),
            Textarea::make('descripcion')
                ->label('Descripción (opcional)')
                ->rows(3)
                ->nullable()
                ->columnSpanFull(),
            Toggle::make('activo')
                ->label('Activo')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('portada')
                    ->label('Portada')
                    ->square(),
                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('anio')
                    ->label('Año')
                    ->sortable(),
                TextColumn::make('fotos_count')
                    ->label('Fotos')
                    ->counts('fotos'),
                ToggleColumn::make('activo')
                    ->label('Activo'),
            ])
            ->defaultSort('anio', 'desc')
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
            FotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAlbums::route('/'),
            'create' => Pages\CreateAlbum::route('/create'),
            'edit' => Pages\EditAlbum::route('/{record}/edit'),
        ];
    }
}
