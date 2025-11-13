<?php

namespace App\Api\Order;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateOrder
{
    use AsAction;

    public function rules(): array
    {
        return [
            'client_name' => 'required|string|max:255',
            'client_phone' => 'nullable|string|max:20',
            'client_email' => 'nullable|email|max:255',
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,processing,completed,cancelled',
            'notes' => 'nullable|string|max:1000'
        ];
    }

    public function handle(Request $request)
    {
        $tenant = $request->user()->tenant;
        
        // Find or create client
        // Priority: email > phone > create new
        $client = null;
        
        if ($request->client_email) {
            // Try to find by email first
            $client = \App\Models\Client::where('tenant_id', $tenant->id)
                ->where('email', $request->client_email)
                ->first();
        }
        
        if (!$client && $request->client_phone) {
            // If not found by email, try by phone
            $client = \App\Models\Client::where('tenant_id', $tenant->id)
                ->where('phone', $request->client_phone)
                ->first();
        }
        
        if (!$client) {
            // Create new client if not found
            $client = \App\Models\Client::create([
                'tenant_id' => $tenant->id,
                'name' => $request->client_name,
                'phone' => $request->client_phone,
                'email' => $request->client_email,
            ]);
        } else {
            // Update existing client info
            $client->update([
                'name' => $request->client_name,
                'phone' => $request->client_phone ?: $client->phone,
                'email' => $request->client_email ?: $client->email,
            ]);
        }
        
        // Create the order
        $order = \App\Models\Order::create([
            'tenant_id' => $tenant->id,
            'user_id' => $request->user()->id,
            'client_id' => $client->id,
            'total' => $request->total,
            'meta' => [
                'notes' => $request->notes,
                'status' => $request->status,
            ]
        ]);

        // Create order items
        foreach ($request->items as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'quantity' => $item['quantity'],
                'amount' => $item['price'],
                'total_pre_tax' => $item['quantity'] * $item['price'],
                'data' => [
                    'name' => $item['name'],
                ]
            ]);
        }

        // Set order status
        $order->setStatus($request->status);

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order->load(['items', 'client'])
        ]);
    }
}

