<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\AcademiaResource\Pages;
use App\Models\Academia;
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

class AcademiaResource extends Resource
{
    protected static ?string $model = Academia::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Anascor;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Academias LESCO';

    protected static ?string $modelLabel = 'academia';

    protected static ?string $pluralModelLabel = 'Academias LESCO';

    protected static ?int $navigationSort = 6;

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
            FileUpload::make('imagen')
                ->label('Logo o imagen')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('academias')
                ->required(),
            TextInput::make('orden')
                ->label('Orden')
                ->numeric()
                ->default(0),
            Toggle::make('status')
                ->label('Activa')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagen')
                    ->label('Logo')
                    ->square(),
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('url')
                    ->label('Sitio web')
                    ->url(fn ($record) => $record->url)
                    ->openUrlInNewTab()
                    ->limit(40),
                TextColumn::make('orden')
                    ->label('Orden')
                    ->sortable(),
                ToggleColumn::make('status')
                    ->label('Activa'),
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
            'index' => Pages\ListAcademias::route('/'),
            'create' => Pages\CreateAcademia::route('/create'),
            'edit' => Pages\EditAcademia::route('/{record}/edit'),
        ];
    }
}
