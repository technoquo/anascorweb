<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\NoticiaResource\Pages;
use App\Filament\Resources\NoticiaResource\RelationManagers\ImagenesRelationManager;
use App\Models\Noticia;
use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class NoticiaResource extends Resource
{
    protected static ?string $model = Noticia::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Inicio;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Noticias';

    protected static ?string $modelLabel = 'noticia';

    protected static ?string $pluralModelLabel = 'Noticias';

    protected static ?int $navigationSort = 2;

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
                ->unique(Noticia::class, 'slug', ignoreRecord: true)
                ->maxLength(255),
            DateTimePicker::make('publicado_en')
                ->label('Publicado el')
                ->required()
                ->default(now()),
            Textarea::make('resumen')
                ->label('Resumen')
                ->required()
                ->rows(3)
                ->columnSpanFull(),
            RichEditor::make('contenido')
                ->label('Contenido')
                ->required()
                ->columnSpanFull(),
            FileUpload::make('imagen')
                ->label('Imagen principal')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('noticias')
                ->required(),
            TextInput::make('alt')
                ->label('Texto alternativo de imagen')
                ->required()
                ->maxLength(255),
            TextInput::make('video_url')
                ->label('URL de YouTube (opcional)')
                ->url()
                ->nullable()
                ->maxLength(500),
            Toggle::make('activo')
                ->label('Publicado')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->disk('public')
                    ->square(),
                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('publicado_en')
                    ->label('Publicado')
                    ->dateTime('d/m/Y')
                    ->sortable(),
                ToggleColumn::make('activo')
                    ->label('Publicado'),
            ])
            ->defaultSort('publicado_en', 'desc')
            ->filters([
                TernaryFilter::make('activo')
                    ->label('Estado')
                    ->trueLabel('Solo publicadas')
                    ->falseLabel('Solo ocultas'),
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
            ImagenesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNoticias::route('/'),
            'create' => Pages\CreateNoticia::route('/create'),
            'edit' => Pages\EditNoticia::route('/{record}/edit'),
        ];
    }
}
