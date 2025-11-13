<?php

namespace App\Api\Ticket;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\Storage;

class CreateTicket
{
    use AsAction;

    public function rules(): array
    {
        return [
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
            'priority' => 'nullable|integer|in:1,2,3',
            'attachments' => 'nullable|array',
            'attachments.*' => 'image|max:5120', // Max 5MB per image
        ];
    }

    public function handle(Request $request)
    {
        $tenant = $request->user()->tenant;
        $attachments = [];

        // Handle file uploads
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('tickets/' . data_get($tenant, 'id') );
                $attachments[] = [
                    'path' => $path,
                    'url' => Storage::url($path),
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                ];
            }
        }

        $ticket = \App\Models\Ticket::create([
            'tenant_id' => data_get($tenant, 'id'),
            'user_id' => auth()->id(),
            'subject' => data_get($request, 'subject'),
            'message' => data_get($request, 'message'),
            'priority' => data_get($request, 'priority') ?? 1,
            'attachments' => $attachments,
            'status' => 'open',
        ]);

        return response()->json([
            'message' => 'تم إنشاء التذكرة بنجاح',
            'data' => $ticket->load(['user','replies.user']) 
        ], 201);
    }
}

