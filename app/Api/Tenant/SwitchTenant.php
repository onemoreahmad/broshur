<?php

namespace App\Api\Tenant;

use App\Http\Resources\TenantResource;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class SwitchTenant
{
    use AsAction;

    public function handle(Request $request, Tenant $tenant)
    {
        if ($tenant->user_id !== $request->user()->id) {
            return response()->json([
                'message' => __('Unauthorized'),
            ], 403);
        }

        $request->user()->current_tenant_id = $tenant->id;
        $request->user()->save();

        return response()->json([
            'message' => __('Tenant switched successfully.'),
            'tenant' => TenantResource::make($tenant),
        ]);
    }
}


