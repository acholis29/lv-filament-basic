<?php

namespace App\Filament\Resources\MsActivitiesResource\Pages;

use App\Filament\Resources\MsActivitiesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMsActivities extends ViewRecord
{
    protected static string $resource = MsActivitiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
