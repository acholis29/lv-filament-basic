<?php

namespace App\Filament\Resources\MsLanguageResource\Pages;

use App\Filament\Resources\MsLanguageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMsLanguage extends EditRecord
{
    protected static string $resource = MsLanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
