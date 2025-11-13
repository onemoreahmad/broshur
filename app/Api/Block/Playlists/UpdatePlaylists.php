<?php

namespace App\Api\Block\Playlists;

use App\Models\Block;
use App\Models\Playlist;
use App\Models\PlaylistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePlaylists
{
    use AsAction;

    public function rules(): array
    {
        return [
            'playlists' => ['nullable', 'array'],
            'playlists.*.id' => ['nullable', 'integer', 'exists:playlists,id'],
            'playlists.*.name' => ['required', 'string', 'max:255'],
            'playlists.*.slug' => ['nullable', 'string', 'max:255'],
            'playlists.*.logo' => ['nullable', 'string', 'max:5024'],
            'playlists.*.cover' => ['nullable', 'string', 'max:5024'],
            'playlists.*.description' => ['nullable', 'string', 'max:2000'],
            'playlists.*.active' => ['nullable', 'boolean'],
            'playlists.*.items' => ['nullable', 'array'],
            'playlists.*.items.*.id' => ['nullable', 'integer', 'exists:playlist_items,id'],
            'playlists.*.items.*.name' => ['required', 'string', 'max:255'],
            'playlists.*.items.*.cover' => ['nullable', 'string', 'max:5024'],
            'playlists.*.items.*.path' => ['nullable', 'string', 'max:500'],
            'playlists.*.items.*.file' => ['nullable', 'string', 'max:500'],
            'playlists.*.items.*.link' => ['nullable', 'string', 'max:500'],
            'playlists.*.items.*.type' => ['nullable', 'string', 'max:100'],
            'playlists.*.items.*.meta' => ['nullable', 'array'],
            'active' => ['nullable', 'boolean'],
            'title' => ['nullable', 'string', 'max:200'],
            'subtitle' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function handle(Request $request)
    {
        $tenantId = currentTenant()->id;

        $block = Block::firstOrCreate([
            'name' => 'playlists',
        ]);

        $block->config = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
        ];
        $block->active = (bool) $request->active;
        $block->save();

        DB::transaction(function () use ($request, $tenantId, $block) {
            // Get existing playlist IDs
            $existingIds = Playlist::where('tenant_id', $tenantId)->pluck('id')->toArray();
            $submittedIds = collect($request->playlists)->pluck('id')->filter()->toArray();
            
            // Delete playlists that are no longer in the request
            $playlistsToDelete = array_diff($existingIds, $submittedIds);
            if (!empty($playlistsToDelete)) {
                Playlist::whereIn('id', $playlistsToDelete)->delete();
            }
            
            // Update or create playlists
            foreach ($request->playlists as $playlistIndex => $playlistData) {
                $playlistId = data_get($playlistData, 'id');
                
                if ($playlistId) {
                    // Update existing playlist
                    $playlist = Playlist::where('id', $playlistId)
                        ->where('tenant_id', $tenantId)
                        ->first();
                    
                    if ($playlist) {
                        $playlist->update([
                            'name' => data_get($playlistData, 'name'),
                            'slug' => data_get($playlistData, 'slug'),
                            'logo' => data_get($playlistData, 'logo'),
                            'cover' => data_get($playlistData, 'cover'),
                            'description' => data_get($playlistData, 'description'),
                            'active' => (bool) data_get($playlistData, 'active', true),
                            'sort' => $playlistIndex,
                        ]);
                    }
                } else {
                    // Create new playlist
                    $playlist = Playlist::create([
                        'tenant_id' => $tenantId,
                        'block_id' => $block->id,
                        'name' => data_get($playlistData, 'name'),
                        'slug' => data_get($playlistData, 'slug'),
                        'logo' => data_get($playlistData, 'logo'),
                        'cover' => data_get($playlistData, 'cover'),
                        'description' => data_get($playlistData, 'description'),
                        'active' => (bool) data_get($playlistData, 'active', true),
                        'sort' => $playlistIndex,    
                    ]);
                }

                // Handle items for this playlist
                if ($playlist) {
                    $items = data_get($playlistData, 'items', []);
                    $existingItemIds = PlaylistItem::where('playlist_id', $playlist->id)->pluck('id')->toArray();
                    $submittedItemIds = collect($items)->pluck('id')->filter()->toArray();
                    
                    // Delete items that are no longer in the request
                    $itemsToDelete = array_diff($existingItemIds, $submittedItemIds);
                    if (!empty($itemsToDelete)) {
                        PlaylistItem::whereIn('id', $itemsToDelete)->delete();
                    }
                    
                    // Update or create items
                    foreach ($items as $itemIndex => $itemData) {
                        $itemId = data_get($itemData, 'id');
                        
                        if ($itemId) {
                            // Update existing item
                            PlaylistItem::where('id', $itemId)
                                ->where('playlist_id', $playlist->id)
                                ->update([
                                    'name' => data_get($itemData, 'name'),
                                    'cover' => data_get($itemData, 'cover'),
                                    'path' => data_get($itemData, 'path'),
                                    'file' => data_get($itemData, 'file'),
                                    'link' => data_get($itemData, 'link'),
                                    'type' => data_get($itemData, 'type'),
                                    'meta' => data_get($itemData, 'meta'),
                                    'sort' => $itemIndex,
                                ]);
                        } else {
                            // Create new item
                            PlaylistItem::create([
                                'playlist_id' => $playlist->id,
                                'name' => data_get($itemData, 'name'),
                                'cover' => data_get($itemData, 'cover'),
                                'path' => data_get($itemData, 'path'),
                                'file' => data_get($itemData, 'file'),
                                'link' => data_get($itemData, 'link'),
                                'type' => data_get($itemData, 'type'),
                                'meta' => data_get($itemData, 'meta'),
                                'sort' => $itemIndex,
                            ]);
                        }
                    }
                }
            }
        });

        // Return updated data
        $playlists = Playlist::where('tenant_id', $tenantId)
            ->with('items')
            ->orderBy('sort')
            ->get()
            ->map(function ($playlist) {
                return [
                    'id' => $playlist->id,
                    'name' => $playlist->name,
                    'slug' => $playlist->slug,
                    'logo' => $playlist->logo,
                    'logo_url' => $playlist->logo_url,
                    'cover' => $playlist->cover,
                    'cover_url' => $playlist->cover_url,
                    'description' => $playlist->description,
                    'active' => $playlist->active,
                    'sort' => $playlist->sort,
                    'items' => $playlist->items->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'name' => $item->name,
                            'cover' => $item->cover,
                            'cover_url' => $item->cover_url,
                            'path' => $item->path,
                            'file' => $item->file,
                            'link' => $item->link,
                            'type' => $item->type,
                            'meta' => $item->meta,
                            'sort' => $item->sort,
                        ];
                    }),
                ];
            });

        
        return response()->json([
            'message' => 'Playlists updated successfully',
            'data' => [
                'id' => $block->id,
                'active' => $block->active,
                'title' => data_get($block, 'config.title', ''),
                'subtitle' => data_get($block, 'config.subtitle', ''),
                'playlists' => $playlists,
            ],
        ]);
    }

    public function getValidationMessages(): array
    {
        return [
            'playlists.*.name.required' => 'الرجاء إدخال اسم القائمة',
            'playlists.*.items.*.name.required' => 'الرجاء إدخال اسم العنصر',
        ];
    }

    public function getValidationAttributes(): array
    {
        return [
            'playlists.*.name' => 'اسم القائمة',
            'playlists.*.slug' => 'الرابط',
            'playlists.*.logo' => 'الشعار',
            'playlists.*.cover' => 'الغلاف',
            'playlists.*.description' => 'الوصف',
            'playlists.*.active' => 'الحالة',
            'playlists.*.items.*.name' => 'اسم العنصر',
            'playlists.*.items.*.cover' => 'الغلاف',
            'playlists.*.items.*.path' => 'المسار',
            'playlists.*.items.*.file' => 'الملف',
            'playlists.*.items.*.link' => 'الرابط',
            'playlists.*.items.*.type' => 'النوع',
        ];
    }
}

