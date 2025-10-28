<?php

namespace App\Api\Block\Faq;

use Lorisleiva\Actions\Concerns\AsAction;

class GetFaq
{
    use AsAction;

    public function handle()
    {
        $block = \App\Models\Block::where('name', 'faq')->first();
        
        return response()->json([
            'data' => [
                'faqs' => data_get($block, 'config.faqs', []),
            ],
        ]);
    }
}
