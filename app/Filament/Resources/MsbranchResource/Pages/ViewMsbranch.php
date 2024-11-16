<?php

namespace App\Filament\Resources\MsbranchResource\Pages;

use App\Filament\Resources\MsbranchResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMsbranch extends ViewRecord
{
    protected static string $resource = MsbranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
