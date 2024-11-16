<?php

namespace App\Filament\Resources\MsStateResource\Pages;

use App\Filament\Resources\MsStateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsStates extends ListRecords
{
    protected static string $resource = MsStateResource::class;

    protected function getHeaderActions(): array
    {
        return [
         //   Actions\CreateAction::make(),
        ];
    }
}
