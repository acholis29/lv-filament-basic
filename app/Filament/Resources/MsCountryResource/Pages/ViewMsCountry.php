<?php

namespace App\Filament\Resources\MsCountryResource\Pages;

use App\Filament\Resources\MsCountryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMsCountry extends ViewRecord
{
    protected static string $resource = MsCountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
