<?php

namespace App\Filament\Resources\MsmaritalResource\Pages;

use App\Filament\Resources\MsmaritalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsmaritals extends ListRecords
{
    protected static string $resource = MsmaritalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
