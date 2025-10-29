<?php

namespace App\Api\Block\Faq;

use App\Models\Block;
use Lorisleiva\Actions\Concerns\AsAction;

class GetFaq
{
    use AsAction;

    public function handle()
    {
        $block = Block::firstOrCreate(['name' => 'faq']);
        
        return response()->json([
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'faqs' => data_get($block, 'config.faqs', []),
            ],
        ]);
    }
}
