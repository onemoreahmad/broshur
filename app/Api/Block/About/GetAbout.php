<?php

namespace App\Api\Block\About;

use Lorisleiva\Actions\Concerns\AsAction;

class GetAbout
{
    use AsAction;

    public function handle()
    {
        $block = \App\Models\Block::where('name', 'about')->first();
        
        return response()->json([
            'data' => [
                'title' => data_get($block, 'config.title', ''),
                'text' => data_get($block, 'config.text', ''),
                'active' => (boolean) data_get($block, 'active', true),
            ],
        ]);
    }
}
