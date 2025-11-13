<?php

namespace App\Filament\SuperAdmin\Resources\Tickets\Actions;

use App\Models\TicketReply;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;

class ReplyAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'reply';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('رد')
            ->icon('heroicon-o-chat-bubble-left-right')
            ->color('success')
            ->form([
                Textarea::make('message')
                    ->label('رسالة الرد')
                    ->required()
                    ->rows(5)
                    ->placeholder('أدخل رسالة الرد...'),
            ])
            ->action(function (array $data, $record) {
                TicketReply::create([
                    'ticket_id' => $record->id,
                    'user_id' => auth()->id(),
                    'message' => $data['message'],
                    'is_admin_reply' => true,
                ]);
            })
            ->successNotificationTitle('تم إرسال الرد بنجاح');
    }
}

