<?php

namespace App\Filament\SuperAdmin\Resources\Blocks\Pages;

use App\Filament\SuperAdmin\Resources\Blocks\BlockResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBlock extends CreateRecord
{
    protected static string $resource = BlockResource::class;
}
