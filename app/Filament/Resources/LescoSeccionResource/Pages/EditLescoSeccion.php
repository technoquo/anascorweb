<?php

namespace App\Filament\Resources\LescoSeccionResource\Pages;

use App\Filament\Resources\LescoSeccionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLescoSeccion extends EditRecord
{
    protected static string $resource = LescoSeccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
