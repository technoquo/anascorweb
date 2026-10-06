<?php

namespace App\Filament\Resources\ComiteResource\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MiembrosRelationManager extends RelationManager
{
    protected static string $relationship = 'miembros';

    protected static ?string $title = 'Personas del comité';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nombre')
                ->label('Nombre')
                ->required()
                ->maxLength(255),
            TextInput::make('cargo')
                ->label('Cargo')
                ->required()
                ->maxLength(255),
            FileUpload::make('foto')
                ->label('Fotografía (opcional)')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('comites/miembros')
                ->nullable(),
            TextInput::make('orden')
                ->label('Orden')
                ->numeric()
                ->default(0),
            Textarea::make('descripcion')
                ->label('Descripción (opcional)')
                ->rows(3)
                ->nullable()
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('cargo')
                    ->label('Cargo'),
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
