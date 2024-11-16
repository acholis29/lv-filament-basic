<?php

namespace App\Filament\Resources\MsbranchResource\Pages;

use App\Filament\Resources\MsbranchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsbranches extends ListRecords
{
    protected static string $resource = MsbranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
