<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\PaginaResource\Pages;
use App\Models\Pagina;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaginaResource extends Resource
{
    protected static ?string $model = Pagina::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Anascor;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Páginas';

    protected static ?string $modelLabel = 'página';

    protected static ?string $pluralModelLabel = 'Páginas';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['Administrador', 'Editor']) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('clave')
                ->label('Clave interna')
                ->disabled()
                ->dehydrated(false)
                ->columnSpanFull(),
            TextInput::make('titulo')
                ->label('Título')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            RichEditor::make('contenido')
                ->label('Contenido')
                ->required()
                ->columnSpanFull(),
            FileUpload::make('imagen')
                ->label('Imagen (opcional)')
                ->image()
                ->imageEditor()
                ->directory('paginas')
                ->nullable(),
            TextInput::make('alt')
                ->label('Texto alternativo de imagen')
                ->maxLength(255)
                ->nullable(),
            TextInput::make('video_url')
                ->label('URL de YouTube (opcional)')
                ->url()
                ->nullable()
                ->maxLength(500)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('clave')
                    ->label('Clave')
                    ->searchable(),
                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable(),
            ])
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaginas::route('/'),
            'edit' => Pages\EditPagina::route('/{record}/edit'),
        ];
    }
}
