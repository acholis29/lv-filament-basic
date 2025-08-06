<?php

namespace App\Filament\Resources\MsSuppliersResource\Pages;

use App\Filament\Resources\MsSuppliersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMsSuppliers extends ListRecords
{
    protected static string $resource = MsSuppliersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //  Actions\CreateAction::make(),
        ];
    }
}
