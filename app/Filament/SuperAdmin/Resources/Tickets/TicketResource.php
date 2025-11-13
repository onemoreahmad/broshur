<?php

namespace App\Filament\SuperAdmin\Resources\Tickets;

use App\Filament\SuperAdmin\Resources\Tickets\Pages\CreateTicket;
use App\Filament\SuperAdmin\Resources\Tickets\Pages\EditTicket;
use App\Filament\SuperAdmin\Resources\Tickets\Pages\ListTickets;
use App\Filament\SuperAdmin\Resources\Tickets\Pages\ViewTicket;
use App\Filament\SuperAdmin\Resources\Tickets\RelationManagers\RepliesRelationManager;
use App\Filament\SuperAdmin\Resources\Tickets\Schemas\TicketForm;
use App\Filament\SuperAdmin\Resources\Tickets\Tables\TicketsTable;
use App\Models\Ticket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationLabel = 'تذاكر الدعم';
    
    protected static ?string $modelLabel = 'تذكرة';
    
    protected static ?string $pluralModelLabel = 'تذاكر الدعم';
    
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-ticket';
    
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return TicketForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RepliesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTickets::route('/'),
            'create' => CreateTicket::route('/create'),
            'view' => ViewTicket::route('/{record}'),
            'edit' => EditTicket::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
