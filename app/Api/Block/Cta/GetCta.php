<?php

namespace App\Api\Block\Cta;

use Lorisleiva\Actions\Concerns\AsAction;

class GetCta
{
    use AsAction;

    public function handle()
    {
        $block = \App\Models\Block::where('name', 'cta')->first();
        
        return response()->json([
            'data' => [
                'active' => (bool) data_get($block, 'active', false),
                'whatsapp_enabled' => (bool) data_get($block, 'config.whatsapp_enabled', false),
                'whatsapp_number' => data_get($block, 'config.whatsapp_number', ''),
                'whatsapp_message' => data_get($block, 'config.whatsapp_message', ''),
                'contact_enabled' => (bool) data_get($block, 'config.contact_enabled', false),
                'contact_email' => data_get($block, 'config.contact_email', ''),
                'contact_subject' => data_get($block, 'config.contact_subject', ''),
            ],
        ]);
    }
}
