<?php

namespace App\Filament\Resources\PagoCuotaResource\Pages;

use App\Filament\Resources\PagoCuotaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPagoCuotas extends ListRecords
{
    protected static string $resource = PagoCuotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
