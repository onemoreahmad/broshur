<?php

namespace App\Api\Tenant;

use App\Http\Resources\TenantResource;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateHandle
{
    use AsAction;

    public function rules(): array
    {
        return [
            'handle' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-z0-9-]+$/',
                'unique:tenants,handle,' . request()->user()->tenant->id
            ]
        ];
    }

    public function getValidationMessages(): array
    {
        return [
            'handle.regex' => 'اسم المستخدم يجب أن يحتوي على أحرف صغيرة وأرقام وشرطات فقط',
            'handle.unique' => 'اسم المستخدم هذا مستخدم بالفعل',
            'handle.min' => 'اسم المستخدم يجب أن يكون على الأقل 3 أحرف',
            'handle.max' => 'اسم المستخدم يجب أن يكون أقل من 50 حرف'
        ];
    }

    public function handle(Request $request)
    {
        $tenant = $request->user()->tenant;
        $tenant->handle = $request->handle;
        $tenant->save();

        return response()->json([
            'message' => 'Handle updated successfully',
            'tenant' => TenantResource::make($tenant),
        ]);
    }
}

