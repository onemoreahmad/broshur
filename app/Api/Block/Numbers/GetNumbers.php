<?php

namespace App\Api\Block\Numbers;

use App\Models\Block;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNumbers
{
    use AsAction;

    public function handle()
    {
        $block = Block::firstOrCreate(['name' => 'numbers']);
        
        return response()->json([
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'title' => data_get($block, 'config.title', ''),
                'subtitle' => data_get($block, 'config.subtitle', ''),
                'items' => data_get($block, 'config.items', []),
            ],
        ]);
    }
}

