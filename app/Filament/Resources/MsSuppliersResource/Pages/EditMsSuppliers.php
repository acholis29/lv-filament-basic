<?php

namespace App\Filament\Resources\MsSuppliersResource\Pages;

use App\Filament\Resources\MsSuppliersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsSuppliers extends EditRecord
{
    protected static string $resource = MsSuppliersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
