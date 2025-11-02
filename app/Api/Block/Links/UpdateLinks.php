<?php

namespace App\Api\Block\Links;

use App\Models\Link;
use App\Models\Block;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Support\Facades\DB;

class UpdateLinks
{
    use AsAction;

    public function rules(): array
    {
        return [
            'active' => ['nullable', 'boolean'],
            'links' => ['nullable', 'array'],
            'links.*.id' => ['nullable', 'integer', 'exists:links,id'],
            'links.*.url' => ['required', 'url', 'max:500'],
            'links.*.network' => ['required', 'string', 'max:50'],
            'links.*.label' => ['nullable', 'string', 'max:100'],
            'links.*.active' => ['nullable', 'boolean'],
        ];
    }

    public function handle(Request $request)
    {
        $tenantId = currentTenant()->id;

        $block = Block::firstOrCreate([
            'name' => 'links',
        ]);

        if ($request->has('active')) {
            $block->update([
                'active' => $request->active,
            ]);
        }

        if ($request->has('links')) {
            DB::transaction(function () use ($request, $tenantId, $block) {
                // Get existing link IDs for this block
                $existingIds = Link::where('block_id', $block->id)
                    ->where('type', 'link')
                    ->pluck('id')
                    ->toArray();
                $submittedIds = collect($request->links)->pluck('id')->filter()->toArray();
                
                // Delete links that are no longer in the request
                $linksToDelete = array_diff($existingIds, $submittedIds);
                if (!empty($linksToDelete)) {
                    Link::whereIn('id', $linksToDelete)->delete();
                }
                
                // Update or create links
                foreach ($request->links as $index => $linkData) {
                    $linkId = data_get($linkData, 'id');
                    
                    // Debug: Log the link data being processed
                    \Log::info('Processing link data:', $linkData);
                    
                    $network = data_get($linkData, 'network', '');
                    
                    if ($linkId) {
                        // Update existing link
                        Link::where('id', $linkId)
                            ->update([
                                'name' => $network,
                                'slug' => $network,
                                'link' => data_get($linkData, 'url'),
                                'block_id' => $block->id,
                                'meta' => [
                                    'network' => $network,
                                    'label' => data_get($linkData, 'label'),
                                ],
                                'active' => (bool) data_get($linkData, 'active'),
                                'sort' => $index,
                            ]);
                    } else {
                        // Create new link
                        Link::create([
                            'tenant_id' => $tenantId,
                            'type' => 'link',
                            'name' => $network,
                            'slug' => $network,
                            'link' => data_get($linkData, 'url'),
                            'block_id' => $block->id,
                            'meta' => [
                                'network' => $network,
                                'label' => data_get($linkData, 'label'),
                            ],
                            'active' => (bool) data_get($linkData, 'active'),
                            'sort' => $index,
                        ]);
                    }
                }
            });
        }

        // Return updated data
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
            'message' => 'Links updated successfully',
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'links' => $links,
            ],
        ]);
    }

    public function getValidationAttributes(): array
    {
        return [
            'links' => 'الروابط',
            'links.*.url' => 'رابط',
            'links.*.network' => 'الشبكة الاجتماعية',
            'links.*.label' => 'التسمية',
            'links.*.active' => 'الحالة',
        ];
    }
}
