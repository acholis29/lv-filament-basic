<?php

namespace App\Filament\Resources\MsActivitiescategorysResource\Pages;

use App\Filament\Resources\MsActivitiescategorysResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsActivitiescategorys extends EditRecord
{
    protected static string $resource = MsActivitiescategorysResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
