<?php

namespace App\Filament\Resources\MsActivitiescategorysResource\Pages;

use App\Filament\Resources\MsActivitiescategorysResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMsActivitiescategorys extends ViewRecord
{
    protected static string $resource = MsActivitiescategorysResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
