<?php

namespace App\Api\Block\Features;

use App\Models\Block;
use Lorisleiva\Actions\Concerns\AsAction;

class GetFeatures
{
    use AsAction;

    public function handle()
    {
        $block = Block::firstOrCreate(['name' => 'features']);
        
        return response()->json([
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'title' => data_get($block, 'config.title', ''),
                'subtitle' => data_get($block, 'config.subtitle', ''),
                'features' => data_get($block, 'config.features', []),
            ],
        ]);
    }
}
