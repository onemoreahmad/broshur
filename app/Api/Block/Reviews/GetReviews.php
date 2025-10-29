<?php

namespace App\Api\Block\Reviews;

use App\Models\Block;
use App\Models\Review;
use Lorisleiva\Actions\Concerns\AsAction;

class GetReviews
{
    use AsAction;

    public function handle()
    {
        $tenantId = currentTenant()->id;
        
        // Get reviews for current tenant
        $reviews = Review::where('tenant_id', $tenantId)
            ->orderBy('sort')
            ->get()
            ->map(function ($review) {
                return [
                    'id' => $review->id,
                    'client_name' => $review->client_name,
                    'client_email' => $review->client_email,
                    'client_phone' => $review->client_phone,
                    'score' => $review->score,
                    'review_text' => $review->review_text,
                    'active' => $review->active,
                    'sort' => $review->sort,
                ];
            });

        $block = Block::firstOrCreate([
            'name' => 'reviews',
        ]);

        return response()->json([
            'data' => [
                'id' => $block->id,  
                'active' => $block->active,  
                'reviews' => $reviews,
            ],
        ]);
    }
}
