<?php

namespace App\Api\Block\Portfolio;

use App\Models\Portfolio;
use App\Models\Block;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPortfolio
{
    use AsAction;

    public function handle()
    {
        $tenantId = currentTenant()->id;
        
        // Get portfolio items for current tenant
        $items = Portfolio::where('tenant_id', $tenantId)
            ->orderBy('sort')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'image' => $item->image,
                    'image_url' => $item->image_url,
                    'caption' => $item->caption,
                    'active' => $item->active,
                    'sort' => $item->sort,
                ];
            });

        $block = Block::firstOrCreate([
            'name' => 'portfolio',
        ]);

        return response()->json([
            'data' => [
                'id' => $block->id,  
                'active' => $block->active,  
                'items' => $items,
            ],
        ]);
    }
}


