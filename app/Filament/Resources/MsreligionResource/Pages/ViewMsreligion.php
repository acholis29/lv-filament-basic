<?php

namespace App\Filament\Resources\MsreligionResource\Pages;

use App\Filament\Resources\MsreligionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMsreligion extends ViewRecord
{
    protected static string $resource = MsreligionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
