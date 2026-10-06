<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\EventoResource\Pages;
use App\Filament\Resources\EventoResource\RelationManagers\ImagenesRelationManager;
use App\Models\Comite;
use App\Models\Evento;
use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
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

class EventoResource extends Resource
{
    protected static ?string $model = Evento::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Inicio;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Eventos';

    protected static ?string $modelLabel = 'evento';

    protected static ?string $pluralModelLabel = 'Eventos';

    protected static ?int $navigationSort = 3;

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
                ->unique(Evento::class, 'slug', ignoreRecord: true)
                ->maxLength(255),
            TextInput::make('lugar')
                ->label('Lugar')
                ->required()
                ->maxLength(255),
            DateTimePicker::make('inicia_en')
                ->label('Inicia el')
                ->required(),
            DateTimePicker::make('termina_en')
                ->label('Termina el')
                ->nullable(),
            Select::make('comite_id')
                ->label('Comité organizador')
                ->options(Comite::pluck('nombre', 'id'))
                ->nullable()
                ->searchable(),
            RichEditor::make('descripcion')
                ->label('Descripción')
                ->required()
                ->columnSpanFull(),
            FileUpload::make('imagen')
                ->label('Imagen (opcional)')
                ->image()
                ->imageEditor()
                ->disk('public')
                ->directory('eventos')
                ->nullable()
                ->columnSpanFull(),
            TextInput::make('video_url')
                ->label('URL de YouTube (opcional)')
                ->url()
                ->nullable()
                ->maxLength(500),
            TextInput::make('form_url')
                ->label('URL de formulario de inscripción (opcional)')
                ->url()
                ->nullable()
                ->maxLength(500),
            Toggle::make('activo')
                ->label('Activo')
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
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->limit(40),
                TextColumn::make('inicia_en')
                    ->label('Inicia')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('lugar')
                    ->label('Lugar')
                    ->limit(30),
                TextColumn::make('comite.nombre')
                    ->label('Comité')
                    ->default('—'),
                ToggleColumn::make('activo')
                    ->label('Activo'),
            ])
            ->defaultSort('inicia_en', 'asc')
            ->filters([
                TernaryFilter::make('activo')
                    ->label('Estado')
                    ->trueLabel('Solo activos')
                    ->falseLabel('Solo inactivos'),
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
            'index' => Pages\ListEventos::route('/'),
            'create' => Pages\CreateEvento::route('/create'),
            'edit' => Pages\EditEvento::route('/{record}/edit'),
        ];
    }
}
