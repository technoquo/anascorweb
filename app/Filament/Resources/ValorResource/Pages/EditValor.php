<?php

namespace App\Filament\Resources\ValorResource\Pages;

use App\Filament\Resources\ValorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditValor extends EditRecord
{
    protected static string $resource = ValorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
