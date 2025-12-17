<?php

namespace App\Api\Tenant;

use App\Http\Resources\TenantResource;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTenants
{
    use AsAction;

    public function handle(Request $request)
    {
        $tenants = $request->user()
            ->tenants()
            ->latest('id')
            ->get();

        return response()->json([
            'data' => TenantResource::collection($tenants),
            'current_tenant_id' => $request->user()->current_tenant_id,
        ]);
    }
}


