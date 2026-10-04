<?php

namespace App\Filament\Resources\MiembroJuntaResource\Pages;

use App\Filament\Resources\MiembroJuntaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMiembroJunta extends EditRecord
{
    protected static string $resource = MiembroJuntaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
