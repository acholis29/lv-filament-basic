<?php

namespace App\Filament\Resources\MsmaritalResource\Pages;

use App\Filament\Resources\MsmaritalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsmarital extends EditRecord
{
    protected static string $resource = MsmaritalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
