<?php

namespace App\Filament\Resources\AjusteResource\Pages;

use App\Filament\Resources\AjusteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAjuste extends EditRecord
{
    protected static string $resource = AjusteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
