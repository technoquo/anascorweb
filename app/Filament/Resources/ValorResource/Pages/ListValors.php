<?php

namespace App\Filament\Resources\ValorResource\Pages;

use App\Filament\Resources\ValorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListValors extends ListRecords
{
    protected static string $resource = ValorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
