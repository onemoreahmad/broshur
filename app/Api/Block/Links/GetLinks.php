<?php

namespace App\Api\Block\Links;

use Lorisleiva\Actions\Concerns\AsAction;

class GetLinks
{
    use AsAction;

    public function handle()
    {
        $block = \App\Models\Block::where('name', 'links')->first();
        
        $links = collect(data_get($block, 'config.links', []))
            ->map(function ($link) {
                return [
                    'url' => data_get($link, 'url', ''),
                    'network' => data_get($link, 'network', ''),
                    'label' => data_get($link, 'label', ''),
                    'active' => (bool) data_get($link, 'active', true),
                ];
            })->values();

        return response()->json([
            'data' => [
                'links' => $links,
            ],
        ]);
    }
}
