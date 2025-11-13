<?php

namespace App\Api\Ticket;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTickets
{
    use AsAction;

    public function handle(Request $request)
    {
        $tickets = \App\Models\Ticket::where('tenant_id', $request->user()->tenant->id)
            ->where('user_id', $request->user()->id)
            ->with([ 'replies.user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json([
            'data' => $tickets->items(),
            'pagination' => [
                'current_page' => $tickets->currentPage(),
                'last_page' => $tickets->lastPage(),
                'per_page' => $tickets->perPage(),
                'total' => $tickets->total(),
                'has_more' => $tickets->hasMorePages()
            ]
        ]);
    }
}

