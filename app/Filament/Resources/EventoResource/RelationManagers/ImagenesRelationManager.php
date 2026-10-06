<?php

namespace App\Filament\Resources\EventoResource\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImagenesRelationManager extends RelationManager
{
    protected static string $relationship = 'imagenes';

    protected static ?string $title = 'Galería de imágenes';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('imagen')
                ->label('Imagen')
                ->image()
                ->imageEditor()
                ->directory('eventos/galeria')
                ->required()
                ->columnSpanFull(),
            TextInput::make('alt')
                ->label('Texto alternativo')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),
            TextInput::make('orden')
                ->label('Orden')
                ->numeric()
                ->default(0),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('alt')
            ->columns([
                ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->square(),
                TextColumn::make('alt')
                    ->label('Alt')
                    ->limit(50),
                TextColumn::make('orden')
                    ->label('Orden')
                    ->sortable(),
            ])
            ->reorderable('orden')
            ->defaultSort('orden')
            ->headerActions([
                Actions\CreateAction::make(),
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
}
