<?php

namespace App\Api\Block\Portfolio;

use App\Models\Portfolio;
use App\Models\Block;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\DB;

class UpdatePortfolio
{
    use AsAction;

    public function rules(): array
    {
        return [
            'items' => ['nullable', 'array'],
            'items.*.id' => ['nullable', 'integer', 'exists:portfolios,id'],
            'items.*.name' => ['required', 'string', 'max:255'],
            'items.*.image' => ['required', 'string', 'max:1024'],
            'items.*.caption' => ['nullable', 'string', 'max:255'],
            'items.*.active' => ['nullable', 'boolean'],
        ];
    }

    public function handle(Request $request)
    {
        $tenantId = currentTenant()->id;

        $block = Block::firstOrCreate([
            'name' => 'portfolio',
        ]);

        $block->update([
            'active' => $request->active,
        ]);

        DB::transaction(function () use ($request, $tenantId) {
            // Get existing portfolio IDs
            $existingIds = Portfolio::where('tenant_id', $tenantId)->pluck('id')->toArray();
            $submittedIds = collect($request->items)->pluck('id')->filter()->toArray();
            
            // Delete items that are no longer in the request
            $itemsToDelete = array_diff($existingIds, $submittedIds);
            if (!empty($itemsToDelete)) {
                Portfolio::whereIn('id', $itemsToDelete)->delete();
            }
            
            // Update or create items
            foreach ($request->items as $index => $itemData) {
                $itemId = data_get($itemData, 'id');
                
                if ($itemId) {
                    // Update existing item
                    Portfolio::where('id', $itemId)
                        ->where('tenant_id', $tenantId)
                        ->update([
                            'name' => data_get($itemData, 'name'),
                            'image' => data_get($itemData, 'image'),
                            'caption' => data_get($itemData, 'caption'),
                            'active' => (bool) data_get($itemData, 'active', true),
                            'sort' => $index,
                        ]);
                } else {
                    // Create new item
                    Portfolio::create([
                        'tenant_id' => $tenantId,
                        'name' => data_get($itemData, 'name'),
                        'image' => data_get($itemData, 'image'),
                        'caption' => data_get($itemData, 'caption'),
                        'active' => (bool) data_get($itemData, 'active', true),
                        'sort' => $index,
                    ]);
                }
            }
        });

        // Return updated data
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

        
        return response()->json([
            'message' => 'Portfolio updated successfully',
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'items' => $items,
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'items' => 'العناصر',
            'items.*.image' => 'الصورة',
            'items.*.caption' => 'الوصف',
            'items.*.active' => 'الحالة',
        ];
    }
}


