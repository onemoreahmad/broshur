<?php

namespace App\Api\Tenant;

use App\Http\Resources\TenantResource;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateLocation
{
    use AsAction;

    public function rules(): array
    {
        return [
            'country' => ['nullable', 'string', 'size:2'],
            'city' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function handle(Request $request)
    {
        $tenant = $request->user()->tenant;
        
        if ($request->has('country')) {
            $tenant->country = $request->country;
        }
        
        if ($request->has('city')) {
            $tenant->city = $request->city;
        }
        
        $tenant->save();

        return response()->json([
            'message' => 'Location updated successfully',
            'tenant' => TenantResource::make($tenant),
        ]);
    }
}

