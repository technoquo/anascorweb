<?php

namespace App\Filament\Resources;

use App\Filament\NavigationGroup;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\UnitEnum|null $navigationGroup = NavigationGroup::Configuracion;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationLabel = 'Usuarios y roles';

    protected static ?string $modelLabel = 'usuario';

    protected static ?string $pluralModelLabel = 'Usuarios y roles';

    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('Administrador') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')
                ->label('Nombre')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->label('Correo electrónico')
                ->email()
                ->required()
                ->unique(User::class, 'email', ignoreRecord: true)
                ->maxLength(255),
            TextInput::make('password')
                ->label('Contraseña')
                ->password()
                ->revealable()
                ->required(fn (string $operation): bool => $operation === 'create')
                ->dehydrated(fn ($state) => filled($state))
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->helperText('Dejar en blanco para conservar la contraseña actual (solo en edición).'),
            Select::make('roles')
                ->label('Rol')
                ->options(Role::pluck('name', 'name'))
                ->relationship('roles', 'name')
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Correo')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Rol')
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->date('d/m/Y')
                    ->sortable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
