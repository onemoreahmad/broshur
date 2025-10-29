<?php

namespace App\Api\Block\Reviews;

use App\Models\Block;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateReviews
{
    use AsAction;

    public function rules(): array
    {
        return [
            'reviews' => ['nullable', 'array'],
            'reviews.*.id' => ['nullable', 'integer', 'exists:reviews,id'],
            'reviews.*.client_name' => ['required', 'string', 'max:255'],
            'reviews.*.client_email' => ['nullable', 'email', 'max:255'],
            'reviews.*.client_phone' => ['nullable', 'string', 'max:20'],
            'reviews.*.score' => ['required', 'integer', 'min:1', 'max:5'],
            'reviews.*.review_text' => ['required', 'string', 'max:1000'],
            'reviews.*.active' => ['nullable', 'boolean'],
            'active' => ['nullable', 'boolean'],
        ];
    }

    public function handle(Request $request)
    {
        $tenantId = currentTenant()->id;

        $block = Block::firstOrCreate([
            'name' => 'reviews',
        ]);

        $block->update([
            'active' => $request->active,
        ]);

        DB::transaction(function () use ($request, $tenantId, $block) {
            // Get existing review IDs
            $existingIds = Review::where('tenant_id', $tenantId)->pluck('id')->toArray();
            $submittedIds = collect($request->reviews)->pluck('id')->filter()->toArray();
            
            // Delete reviews that are no longer in the request
            $reviewsToDelete = array_diff($existingIds, $submittedIds);
            if (!empty($reviewsToDelete)) {
                Review::whereIn('id', $reviewsToDelete)->delete();
            }
            
            // Update or create reviews
            foreach ($request->reviews as $index => $reviewData) {
                $reviewId = data_get($reviewData, 'id');
                
                if ($reviewId) {
                    // Update existing review
                    Review::where('id', $reviewId)
                        ->where('tenant_id', $tenantId)
                        ->update([
                            'client_name' => data_get($reviewData, 'client_name'),
                            'client_email' => data_get($reviewData, 'client_email'),
                            'client_phone' => data_get($reviewData, 'client_phone'),
                            'score' => data_get($reviewData, 'score'),
                            'review_text' => data_get($reviewData, 'review_text'),
                            'active' => (bool) data_get($reviewData, 'active', true),
                            'sort' => $index,
                        ]);
                } else {
                    // Create new review
                    Review::create([
                        'tenant_id' => $tenantId,
                        'block_id' => $block->id,
                        'client_name' => data_get($reviewData, 'client_name'),
                        'client_email' => data_get($reviewData, 'client_email'),
                        'client_phone' => data_get($reviewData, 'client_phone'),
                        'score' => data_get($reviewData, 'score'),
                        'review_text' => data_get($reviewData, 'review_text'),
                        'active' => (bool) data_get($reviewData, 'active', true),
                        'sort' => $index,
                    ]);
                }
            }
        });

        // Return updated data
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

        
        return response()->json([
            'message' => 'Reviews updated successfully',
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'reviews' => $reviews,
            ],
        ]);
    }
}
