<?php

namespace App\Api\Block\Agreement;

use Lorisleiva\Actions\Concerns\AsAction;

class GetAgreement
{
    use AsAction;

    public function handle()
    {
        $block = \App\Models\Block::where('name', 'agreement')->first();
        
        return response()->json([
            'data' => [
                'agreement_title' => data_get($block, 'config.agreement_title', ''),
                'agreement_content' => data_get($block, 'config.agreement_content', ''),
                'privacy_title' => data_get($block, 'config.privacy_title', ''),
                'privacy_content' => data_get($block, 'config.privacy_content', ''),
                'active' => (boolean) data_get($block, 'active', true),
            ],
        ]);
    }
}

