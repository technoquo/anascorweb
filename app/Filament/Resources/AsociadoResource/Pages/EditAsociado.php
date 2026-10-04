<?php

namespace App\Filament\Resources\AsociadoResource\Pages;

use App\Filament\Resources\AsociadoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsociado extends EditRecord
{
    protected static string $resource = AsociadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
