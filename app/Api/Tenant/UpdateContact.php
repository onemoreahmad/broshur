<?php

namespace App\Api\Tenant;

use App\Http\Resources\TenantResource;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateContact
{
    use AsAction;

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'digits_between:9,12'],
        ];
    }

    public function getValidationMessages(): array
    {
        return [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.email' => 'البريد الإلكتروني غير صالح',
            'email.max' => 'البريد الإلكتروني يجب أن يكون أقل من 255 حرف',
            'phone.digits_between' => 'رقم الهاتف يجب أن يكون بين 9 و 12 رقم',
        ];
    }

    public function handle(Request $request)
    {
        $tenant = $request->user()->tenant;
        
        $tenant->email = $request->filled('email') ? $request->email : null;
        $tenant->phone = $request->filled('phone') ? $request->phone : null;
        
        $tenant->save();

        return response()->json([
            'message' => 'Contact information updated successfully',
            'tenant' => TenantResource::make($tenant),
        ]);
    }
}

