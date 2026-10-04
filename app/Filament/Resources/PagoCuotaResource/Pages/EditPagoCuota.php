<?php

namespace App\Filament\Resources\PagoCuotaResource\Pages;

use App\Filament\Resources\PagoCuotaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPagoCuota extends EditRecord
{
    protected static string $resource = PagoCuotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
