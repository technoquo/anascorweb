<?php

namespace App\Filament\Resources\ExpresidenteResource\Pages;

use App\Filament\Resources\ExpresidenteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExpresidente extends EditRecord
{
    protected static string $resource = ExpresidenteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
