<?php

namespace App\Filament\Resources\SubdepartmentResource\Pages;

use App\Filament\Resources\SubdepartmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubdepartment extends EditRecord
{
    protected static string $resource = SubdepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
