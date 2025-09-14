<?php

namespace App\Filament\Resources\MsLanguageResource\Pages;

use App\Filament\Resources\MsLanguageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsLanguages extends ListRecords
{
    protected static string $resource = MsLanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
