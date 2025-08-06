<?php

namespace App\Filament\Resources\MsHotelsResource\Pages;

use App\Filament\Resources\MsHotelsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsHotels extends ListRecords
{
    protected static string $resource = MsHotelsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
