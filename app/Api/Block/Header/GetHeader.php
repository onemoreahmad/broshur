<?php

namespace App\Api\Block\Header;

use Lorisleiva\Actions\Concerns\AsAction;

class GetHeader
{
    use AsAction;

    public function handle()
    {
        return response()->json([
            'data' => [
                'name' => currentTenant()->name,
                'slogan' => currentTenant()->slogan,
                'logo' => data_get(currentTenant(), 'logo'),
                // 'cover' => data_get(currentTenant(), 'cover'),
            ],
        ]);
    }
}
