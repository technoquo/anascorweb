<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\MensajeContactoResource\Pages;
use App\Models\MensajeContacto;
use Filament\Actions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class MensajeContactoResource extends Resource
{
    protected static ?string $model = MensajeContacto::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Configuracion;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-envelope-open';

    protected static ?string $navigationLabel = 'Mensajes de contacto';

    protected static ?string $modelLabel = 'mensaje';

    protected static ?string $pluralModelLabel = 'Mensajes de contacto';

    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Administrador') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nombre')
                ->label('Nombre')
                ->disabled()
                ->columnSpanFull(),
            TextInput::make('correo')
                ->label('Correo')
                ->disabled(),
            TextInput::make('asunto')
                ->label('Asunto')
                ->disabled(),
            Textarea::make('mensaje')
                ->label('Mensaje')
                ->disabled()
                ->rows(6)
                ->columnSpanFull(),
            Toggle::make('leido')
                ->label('Leído'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable(),
                TextColumn::make('correo')
                    ->label('Correo')
                    ->searchable(),
                TextColumn::make('asunto')
                    ->label('Asunto')
                    ->limit(40),
                IconColumn::make('leido')
                    ->label('Leído')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning'),
                TextColumn::make('created_at')
                    ->label('Recibido')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                TernaryFilter::make('leido')
                    ->label('Estado')
                    ->trueLabel('Solo leídos')
                    ->falseLabel('Solo sin leer'),
            ])
            ->actions([
                Actions\ViewAction::make(),
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
            'index' => Pages\ListMensajeContactos::route('/'),
            'view' => Pages\ViewMensajeContacto::route('/{record}'),
        ];
    }
}
