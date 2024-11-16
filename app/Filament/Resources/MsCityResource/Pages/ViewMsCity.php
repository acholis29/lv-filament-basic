<?php

namespace App\Filament\Resources\MsCityResource\Pages;

use App\Filament\Resources\MsCityResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMsCity extends ViewRecord
{
    protected static string $resource = MsCityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
