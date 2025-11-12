<?php

namespace App\Api\Subscriber;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateSubscriber
{
    use AsAction;

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'meta' => 'nullable|array'
        ];
    }

    public function handle(Request $request)
    {
        $tenant = $request->user()->tenant;
        
        // Check if email already exists for this tenant
        $existingSubscriber = \App\Models\Subscriber::where('tenant_id', $tenant->id)
            ->where('email', $request->email)
            ->first();

        if ($existingSubscriber) {
            return response()->json([
                'message' => 'البريد الإلكتروني مسجل مسبقاً',
                'errors' => ['email' => ['البريد الإلكتروني مسجل مسبقاً']]
            ], 422);
        }

        // Create the subscriber
        $subscriber = \App\Models\Subscriber::create([
            // 'tenant_id' => $tenant->id,
            'name' => $request->name,
            'email' => $request->email,
            // 'meta' => $request->meta ?? []
        ]);

        return response()->json([
            'message' => 'تم إضافة المشترك بنجاح',
            'subscriber' => $subscriber
        ]);
    }
}

