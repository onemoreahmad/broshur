<?php

namespace App\Api\Ticket;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTicket
{
    use AsAction;

    public function handle(Request $request, $id)
    {
        $ticket = \App\Models\Ticket::where('tenant_id', $request->user()->tenant->id)
            ->where('user_id', $request->user()->id)
            ->with(['user', 'replies.user'])
            ->findOrFail($id);

        return response()->json([
            'data' => $ticket
        ]);
    }
}

