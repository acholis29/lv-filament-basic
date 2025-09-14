<?php

namespace App\Filament\Resources\MsActivitiesResource\Pages;

use App\Filament\Resources\MsActivitiesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsActivities extends EditRecord
{
    protected static string $resource = MsActivitiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
