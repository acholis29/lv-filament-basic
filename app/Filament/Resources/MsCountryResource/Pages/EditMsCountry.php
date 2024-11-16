<?php

namespace App\Filament\Resources\MsCountryResource\Pages;

use App\Filament\Resources\MsCountryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsCountry extends EditRecord
{
    protected static string $resource = MsCountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\ViewAction::make(),
            Actions\DeleteAction::make()->icon('heroicon-o-trash'),
        ];
    }
}
