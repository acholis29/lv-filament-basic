<?php

namespace App\Filament\Resources\SubdepartmentResource\Pages;

use App\Filament\Resources\SubdepartmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSubdepartment extends ViewRecord
{
    protected static string $resource = SubdepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
