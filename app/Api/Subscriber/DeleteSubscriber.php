<?php

namespace App\Api\Subscriber;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class DeleteSubscriber
{
    use AsAction;

    public function handle(Request $request, $id)
    {
        $tenant = $request->user()->tenant;
        
        // Find the subscriber and ensure it belongs to the tenant
        $subscriber = \App\Models\Subscriber::where('tenant_id', $tenant->id)
            ->where('id', $id)
            ->first();

        if (!$subscriber) {
            return response()->json([
                'message' => 'المشترك غير موجود'
            ], 404);
        }

        $subscriber->delete();

        return response()->json([
            'message' => 'تم حذف المشترك بنجاح'
        ]);
    }
}

