<?php

namespace App\Filament\Resources\MsCityResource\Pages;

use App\Filament\Resources\MsCityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsCity extends EditRecord
{
    protected static string $resource = MsCityResource::class;

    protected function getHeaderActions(): array
    {
        return [
           // Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
