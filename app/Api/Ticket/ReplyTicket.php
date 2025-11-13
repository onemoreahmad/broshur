<?php

namespace App\Api\Ticket;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Storage;

class ReplyTicket
{
    use AsAction;

    public function rules(): array
    {
        return [
            'message' => 'required|string|max:5000',
            'attachments' => 'nullable|array',
            'attachments.*' => 'image|max:5120', // Max 5MB per image
        ];
    }

    public function handle(Request $request, $id)
    {
        $ticket = \App\Models\Ticket::where('tenant_id', $request->user()->tenant->id)
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        // Only allow replies to open tickets
        if ($ticket->status === 'closed') {
            return response()->json([
                'message' => 'لا يمكن الرد على التذكرة المغلقة'
            ], 422);
        }

        $tenant = $request->user()->tenant;
        $attachments = [];

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('tickets/' . $tenant->id );
                $attachments[] = [
                    'path' => $path,
                    'url' => Storage::url($path),
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                ];
            }
        }

        $reply = \App\Models\TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => $request->user()->id,
            'message' => $request->message,
            'attachments' => $attachments,
            'is_admin_reply' => false,
        ]);

        // Update ticket status to open if it was pending
        if ($ticket->status === 'pending') {
            $ticket->update(['status' => 'open']);
        }

        return response()->json([
            'message' => 'تم إرسال الرد بنجاح',
            'data' => $reply->load('user')
        ], 201);
    }
}

