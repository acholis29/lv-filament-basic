<?php

namespace App\Filament\Resources\MsbranchResource\Pages;

use App\Filament\Resources\MsbranchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsbranch extends EditRecord
{
    protected static string $resource = MsbranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->icon('heroicon-o-trash'),
        ];
    }
}
