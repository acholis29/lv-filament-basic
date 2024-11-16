<?php

namespace App\Filament\Resources\MsCountryResource\Pages;

use App\Filament\Resources\MsCountryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsCountries extends ListRecords
{
    protected static string $resource = MsCountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
          //  Actions\CreateAction::make()->slideOver(),
        ];
    }

     protected function getHeaderWidgets(): array
    {
        return [
            MsCountryResource\Widgets\CountyOverview::class,
        ];
    }
}
