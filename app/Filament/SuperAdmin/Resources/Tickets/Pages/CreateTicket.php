<?php

namespace App\Filament\SuperAdmin\Resources\Tickets\Pages;

use App\Filament\SuperAdmin\Resources\Tickets\TicketResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;
}
