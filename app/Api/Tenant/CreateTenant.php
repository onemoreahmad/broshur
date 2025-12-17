<?php

namespace App\Api\Tenant;

use App\Actions\CreateTenant as CreateTenantAction;
use App\Http\Resources\TenantResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateTenant
{
    use AsAction;

    public function rules(): array
    {
        return [
            'tenant_name' => ['required', 'string', 'min:2', 'max:200'],
            'tenant_handle' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('tenants', 'handle'),
            ],
        ];
    }

    public function getValidationMessages(): array
    {
        return [
            'tenant_name.required' => 'اسم المنشأة مطلوب',
            'tenant_name.min' => 'اسم المنشأة يجب أن يكون على الأقل حرفين',
            'tenant_handle.required' => 'المعرف الفرعي مطلوب',
            'tenant_handle.regex' => 'المعرف يجب أن يحتوي على أحرف صغيرة وأرقام وشرطات فقط',
            'tenant_handle.unique' => 'المعرف مستخدم بالفعل',
        ];
    }

    public function handle(Request $request)
    {
        $handle = Str::lower(trim($request->tenant_handle));

        $tenant = CreateTenantAction::run([
            'tenant_name' => $request->tenant_name,
            'tenant_handle' => $handle,
            'email' => $request->user()->email,
            'user_id' => $request->user()->id,
        ]);

        // set the current tenant for the user
        $request->user()->current_tenant_id = $tenant->id;
        $request->user()->save();
         
        return response()->json([
            'message' => __('Tenant added successfully.'),
            'tenant' => TenantResource::make($tenant),
        ], 201);
 
    }
}


