<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\LescoSeccionResource\Pages;
use App\Models\LescoSeccion;
use Filament\Actions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class LescoSeccionResource extends Resource
{
    protected static ?string $model = LescoSeccion::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Lesco;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-hand-raised';

    protected static ?string $navigationLabel = 'Secciones LESCO';

    protected static ?string $modelLabel = 'sección LESCO';

    protected static ?string $pluralModelLabel = 'Secciones LESCO';

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
                ->unique(LescoSeccion::class, 'slug', ignoreRecord: true)
                ->maxLength(255),
            TextInput::make('orden')
                ->label('Orden')
                ->numeric()
                ->default(0),
            RichEditor::make('descripcion')
                ->label('Descripción')
                ->required()
                ->columnSpanFull(),
            TextInput::make('video_url')
                ->label('URL de YouTube (opcional)')
                ->url()
                ->nullable()
                ->maxLength(500)
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
                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable(),
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
            'index' => Pages\ListLescoSeccions::route('/'),
            'create' => Pages\CreateLescoSeccion::route('/create'),
            'edit' => Pages\EditLescoSeccion::route('/{record}/edit'),
        ];
    }
}
