<?php

namespace App\Filament\Resources\MsActivitiesResource\Pages;

use App\Filament\Resources\MsActivitiesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsActivities extends ListRecords
{
    protected static string $resource = MsActivitiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
