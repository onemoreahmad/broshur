<?php

namespace App\Api\Block\Portfolio;

use Lorisleiva\Actions\Concerns\AsAction;

class GetPortfolio
{
    use AsAction;

    public function handle()
    {
        $block = \App\Models\Block::firstOrCreate([
            'name' => 'portfolio',
        ]);
        
        return response()->json([
            'data' => [
                'id' => data_get($block, 'id'),
                'active' => (bool) data_get($block, 'active', true),
                'items' => collect(data_get($block, 'config.items', []))
                    ->map(function ($item) {
                        return [
                            'image' => data_get($item, 'image', ''),
                            'caption' => data_get($item, 'caption', ''),
                            'active' => (bool) data_get($item, 'active', true),
                        ];
                    })->values(),
            ],
        ]);
    }
}


