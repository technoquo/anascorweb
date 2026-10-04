<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\SlideResource\Pages;
use App\Models\Slide;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SlideResource extends Resource
{
    protected static ?string $model = Slide::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Inicio;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Carrusel';

    protected static ?string $modelLabel = 'slide';

    protected static ?string $pluralModelLabel = 'Carrusel';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Administrador', 'Editor']) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('imagen')
                ->label('Imagen')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('slides')
                ->required()
                ->columnSpanFull(),
            TextInput::make('alt')
                ->label('Texto alternativo')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            TextInput::make('titulo')
                ->label('Título (opcional)')
                ->maxLength(255),
            TextInput::make('enlace')
                ->label('Enlace (opcional)')
                ->url()
                ->maxLength(500),
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
                ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->square(),
                TextColumn::make('titulo')
                    ->label('Título')
                    ->default('(Sin título)')
                    ->searchable(),
                TextColumn::make('orden')
                    ->label('Orden')
                    ->sortable(),
                ToggleColumn::make('activo')
                    ->label('Activo'),
            ])
            ->reorderable('orden')
            ->defaultSort('orden')
            ->filters([])
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
            'index' => Pages\ListSlides::route('/'),
            'create' => Pages\CreateSlide::route('/create'),
            'edit' => Pages\EditSlide::route('/{record}/edit'),
        ];
    }
}
