<?php

namespace App\Filament\SuperAdmin\Resources\Tickets\Pages;

use App\Filament\SuperAdmin\Resources\Tickets\Actions\ReplyAction;
use App\Filament\SuperAdmin\Resources\Tickets\TicketResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ReplyAction::make(),
            EditAction::make(),
        ];
    }
}
