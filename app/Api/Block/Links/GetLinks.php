<?php

namespace App\Api\Block\Links;

use App\Models\Link;
use App\Models\Block;
use Lorisleiva\Actions\Concerns\AsAction;

class GetLinks
{
    use AsAction;

    public function handle()
    {
        $block = Block::firstOrCreate([
            'name' => 'links',
        ]);
        
        // Get links for this block
        $links = Link::where('block_id', $block->id)
            ->where('type', 'link')
            ->orderBy('sort')
            ->get()
            ->map(function ($link) {
                return [
                    'id' => $link->id,
                    'url' => $link->link,
                    'network' => data_get($link, 'meta.network', ''),
                    'label' => data_get($link, 'meta.label', ''),
                    'active' => $link->active,
                    'sort' => $link->sort,
                ];
            });

        return response()->json([
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'links' => $links,
            ],
        ]);
    }
}
