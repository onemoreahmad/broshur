<?php

namespace App\Api\Block\Features;

use Lorisleiva\Actions\Concerns\AsAction;

class GetFeatures
{
    use AsAction;

    public function handle()
    {
        $block = \App\Models\Block::where('name', 'features')->first();
        
        return response()->json([
            'data' => [
                'features' => data_get($block, 'config.features', []),
            ],
        ]);
    }
}
