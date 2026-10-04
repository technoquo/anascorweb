<?php

namespace App\Filament\Resources\ComiteResource\Pages;

use App\Filament\Resources\ComiteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComites extends ListRecords
{
    protected static string $resource = ComiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
