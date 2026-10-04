<?php

namespace App\Filament\Resources\LescoSeccionResource\Pages;

use App\Filament\Resources\LescoSeccionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLescoSeccions extends ListRecords
{
    protected static string $resource = LescoSeccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
