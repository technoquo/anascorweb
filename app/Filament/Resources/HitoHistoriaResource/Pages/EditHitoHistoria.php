<?php

namespace App\Filament\Resources\HitoHistoriaResource\Pages;

use App\Filament\Resources\HitoHistoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHitoHistoria extends EditRecord
{
    protected static string $resource = HitoHistoriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
