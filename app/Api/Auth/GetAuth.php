<?php

namespace App\Api\Auth;

use App\Http\Resources\TenantResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAuth
{
    use AsAction;

    public function handle(Request $request)
    {
        $data = collect($request->user()->load('tenant')->only('id', 'name', 'email', 'tenant'));
        
        return response()->json([
            'tenant' => TenantResource::make($data->get('tenant')),
            'user' => UserResource::make($request->user()),
        ]);
    }
}

