<?php

namespace App\Api\Subscriber;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetSubscribers
{
    use AsAction;

    public function handle(Request $request)
    {
        $subscribers = \App\Models\Subscriber::where('tenant_id', $request->user()->tenant->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json([
            'data' => $subscribers->items(),
            'pagination' => [
                'current_page' => $subscribers->currentPage(),
                'last_page' => $subscribers->lastPage(),
                'per_page' => $subscribers->perPage(),
                'total' => $subscribers->total(),
                'has_more' => $subscribers->hasMorePages()
            ]
        ]);
    }
}

