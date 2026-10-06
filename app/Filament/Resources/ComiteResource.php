<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\ComiteResource\Pages;
use App\Filament\Resources\ComiteResource\RelationManagers\MiembrosRelationManager;
use App\Models\Comite;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
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

class ComiteResource extends Resource
{
    protected static ?string $model = Comite::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::GaleriaComites;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Comités';

    protected static ?string $modelLabel = 'comité';

    protected static ?string $pluralModelLabel = 'Comités';

    protected static ?int $navigationSort = 2;

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
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null
                )
                ->columnSpanFull(),
            TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->unique(Comite::class, 'slug', ignoreRecord: true)
                ->maxLength(255),
            TextInput::make('orden')
                ->label('Orden')
                ->numeric()
                ->default(0),
            FileUpload::make('logo')
                ->label('Logo')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('comites')
                ->required()
                ->columnSpanFull(),
            RichEditor::make('descripcion')
                ->label('Descripción')
                ->required()
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
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->square(),
                TextColumn::make('nombre')
                    ->label('Nombre')
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

    public static function getRelations(): array
    {
        return [
            MiembrosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComites::route('/'),
            'create' => Pages\CreateComite::route('/create'),
            'edit' => Pages\EditComite::route('/{record}/edit'),
        ];
    }
}
