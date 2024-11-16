<?php

namespace App\Filament\Resources\MsCityResource\Pages;

use App\Filament\Resources\MsCityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsCities extends ListRecords
{
    protected static string $resource = MsCityResource::class;

    protected function getHeaderActions(): array
    {
        return [
         //   Actions\CreateAction::make(),
        ];
    }
}
