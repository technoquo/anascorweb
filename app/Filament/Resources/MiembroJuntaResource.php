<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\MiembroJuntaResource\Pages;
use App\Models\MiembroJunta;
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

class MiembroJuntaResource extends Resource
{
    protected static ?string $model = MiembroJunta::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Anascor;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Junta directiva';

    protected static ?string $modelLabel = 'miembro de junta';

    protected static ?string $pluralModelLabel = 'Junta directiva';

    protected static ?int $navigationSort = 2;

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
            TextInput::make('puesto')
                ->label('Puesto')
                ->required()
                ->maxLength(255),
            FileUpload::make('foto')
                ->label('Fotografía')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('junta')
                ->required(),
            TextInput::make('periodo')
                ->label('Período')
                ->required()
                ->maxLength(50)
                ->placeholder('2024-2026'),
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
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular(),
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('puesto')
                    ->label('Puesto'),
                TextColumn::make('periodo')
                    ->label('Período'),
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
            'index' => Pages\ListMiembroJuntas::route('/'),
            'create' => Pages\CreateMiembroJunta::route('/create'),
            'edit' => Pages\EditMiembroJunta::route('/{record}/edit'),
        ];
    }
}
