<?php

namespace App\Filament\Resources\AjusteResource\Pages;

use App\Filament\Resources\AjusteResource;
use Filament\Resources\Pages\ListRecords;

class ListAjustes extends ListRecords
{
    protected static string $resource = AjusteResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
