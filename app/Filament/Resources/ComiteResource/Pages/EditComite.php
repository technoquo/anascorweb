<?php

namespace App\Filament\Resources\ComiteResource\Pages;

use App\Filament\Resources\ComiteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComite extends EditRecord
{
    protected static string $resource = ComiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
