<?php

namespace App\Filament\Resources\MsreligionResource\Pages;

use App\Filament\Resources\MsreligionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsreligion extends EditRecord
{
    protected static string $resource = MsreligionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\ViewAction::make(),
            Actions\DeleteAction::make()->icon('heroicon-o-trash'),
        ];
    }
}
