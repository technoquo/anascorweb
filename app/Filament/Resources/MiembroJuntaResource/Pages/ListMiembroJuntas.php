<?php

namespace App\Filament\Resources\MiembroJuntaResource\Pages;

use App\Filament\Resources\MiembroJuntaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMiembroJuntas extends ListRecords
{
    protected static string $resource = MiembroJuntaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
