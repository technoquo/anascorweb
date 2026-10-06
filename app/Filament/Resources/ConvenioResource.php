<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\ConvenioResource\Pages;
use App\Models\Convenio;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class ConvenioResource extends Resource
{
    protected static ?string $model = Convenio::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Anascor;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-document-check';

    protected static ?string $navigationLabel = 'Convenios';

    protected static ?string $modelLabel = 'convenio';

    protected static ?string $pluralModelLabel = 'Convenios';

    protected static ?int $navigationSort = 7;

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
                ->maxLength(255),
            TextInput::make('url')
                ->label('Sitio web')
                ->url()
                ->required()
                ->maxLength(500),
            Textarea::make('descripcion')
                ->label('Descripción')
                ->required()
                ->rows(4)
                ->columnSpanFull(),
            FileUpload::make('imagen')
                ->label('Logo o imagen')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('convenios')
                ->required(),
            TextInput::make('orden')
                ->label('Orden')
                ->numeric()
                ->default(0),
            Toggle::make('status')
                ->label('Activo')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagen')
                    ->label('Logo')
                    ->disk('public')
                    ->square(),
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(50),
                TextColumn::make('orden')
                    ->label('Orden')
                    ->sortable(),
                ToggleColumn::make('status')
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
            'index' => Pages\ListConvenios::route('/'),
            'create' => Pages\CreateConvenio::route('/create'),
            'edit' => Pages\EditConvenio::route('/{record}/edit'),
        ];
    }
}
