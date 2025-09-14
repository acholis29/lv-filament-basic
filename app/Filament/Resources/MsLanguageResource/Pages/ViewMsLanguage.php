<?php

namespace App\Filament\Resources\MsLanguageResource\Pages;

use App\Filament\Resources\MsLanguageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMsLanguage extends ViewRecord
{
    protected static string $resource = MsLanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
