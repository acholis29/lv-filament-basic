<?php

namespace App\Filament\Resources\MsreligionResource\Pages;

use App\Filament\Resources\MsreligionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsreligions extends ListRecords
{
    protected static string $resource = MsreligionResource::class;

    protected function getHeaderActions(): array
    {
        return [
          //  Actions\CreateAction::make(),
        ];
    }
}
