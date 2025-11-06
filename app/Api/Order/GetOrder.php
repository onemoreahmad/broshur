<?php

namespace App\Api\Order;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetOrder
{
    use AsAction;

    public function handle(Request $request, $id)
    {
        $order = \App\Models\Order::where('tenant_id', $request->user()->tenant->id)
            ->with(['items'])
            ->findOrFail($id);

        return response()->json([
            'data' => $order,
        ]);
    }
}

