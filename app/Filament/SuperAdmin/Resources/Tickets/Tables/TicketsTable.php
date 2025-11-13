<?php

namespace App\Filament\SuperAdmin\Resources\Tickets\Tables;

use App\Filament\SuperAdmin\Resources\Tickets\Actions\ReplyAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('tenant.name')
                    ->label('Tenant')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subject')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'success',
                        'pending' => 'warning',
                        'closed' => 'gray',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('priority')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        1 => 'Low',
                        2 => 'Medium',
                        3 => 'High',
                        default => 'Low',
                    })
                    ->color(fn ($state) => match ($state) {
                        1 => 'gray',
                        2 => 'warning',
                        3 => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('replies_count')
                    ->label('Replies')
                    ->counts('replies')
                    ->sortable(),
                TextColumn::make('closed_at')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Not closed'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'open' => 'Open',
                        'pending' => 'Pending',
                        'closed' => 'Closed',
                    ]),
                SelectFilter::make('priority')
                    ->options([
                        1 => 'Low',
                        2 => 'Medium',
                        3 => 'High',
                    ]),
                TrashedFilter::make(),
            ])
            ->actions([
                ViewAction::make(),
                ReplyAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
