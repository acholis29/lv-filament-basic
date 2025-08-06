<?php

namespace App\Filament\Resources\MsHotelsResource\Pages;

use App\Filament\Resources\MsHotelsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsHotels extends EditRecord
{
    protected static string $resource = MsHotelsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
