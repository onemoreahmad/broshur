<?php

namespace App\Api\Tenant;

use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateTheme
{
    use AsAction;

    public function rules(): array
    {
        return [
            'theme_id' => 'required|integer|min:1'
        ];
    }

    public function handle(Request $request)
    {
        $tenant = currentTenant();
        $tenant->theme_id = $request->theme_id;
        $tenant->save();

        return response()->json([
            'message' => 'Theme updated successfully'
        ]);
    }
}

