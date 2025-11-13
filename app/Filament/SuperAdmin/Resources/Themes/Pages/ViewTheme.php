<?php

namespace App\Filament\SuperAdmin\Resources\Themes\Pages;

use App\Filament\SuperAdmin\Resources\Themes\ThemeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTheme extends ViewRecord
{
    protected static string $resource = ThemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
