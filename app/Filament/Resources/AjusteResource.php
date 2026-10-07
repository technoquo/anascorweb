<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\AjusteResource\Pages;
use App\Models\Ajuste;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AjusteResource extends Resource
{
    protected static ?string $model = Ajuste::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Configuracion;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Ajustes del sitio';

    protected static ?string $modelLabel = 'ajuste';

    protected static ?string $pluralModelLabel = 'Ajustes del sitio';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Administrador') ?? false;
    }

    protected static array $clavesLogo = ['logo_header', 'logo_footer'];

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('clave')
                ->label('Clave interna')
                ->disabled()
                ->dehydrated(false)
                ->columnSpanFull(),
            FileUpload::make('valor')
                ->label('Logo')
                ->image()
                ->disk('public')
                ->directory('ajustes/logos')
                ->imagePreviewHeight('80')
                ->columnSpanFull()
                ->visible(fn (?Ajuste $record): bool => in_array($record?->clave, self::$clavesLogo))
                ->dehydrated(fn (?Ajuste $record): bool => in_array($record?->clave, self::$clavesLogo)),
            Textarea::make('valor')
                ->label('Valor')
                ->rows(3)
                ->columnSpanFull()
                ->visible(fn (?Ajuste $record): bool => ! in_array($record?->clave, self::$clavesLogo))
                ->dehydrated(fn (?Ajuste $record): bool => ! in_array($record?->clave, self::$clavesLogo)),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('clave')
                    ->label('Clave')
                    ->searchable(),
                TextColumn::make('valor')
                    ->label('Valor')
                    ->limit(60)
                    ->formatStateUsing(fn (string $state, Ajuste $record): string => in_array($record->clave, self::$clavesLogo)
                        ? ($state ? '(imagen subida)' : '(sin imagen)')
                        : $state
                    ),
            ])
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAjustes::route('/'),
            'edit' => Pages\EditAjuste::route('/{record}/edit'),
        ];
    }
}
