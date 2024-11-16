<?php

namespace App\Filament\Resources\MsStateResource\Pages;

use App\Filament\Resources\MsStateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsState extends EditRecord
{
    protected static string $resource = MsStateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
