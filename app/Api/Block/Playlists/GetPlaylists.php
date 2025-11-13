<?php

namespace App\Api\Block\Playlists;

use App\Models\Block;
use App\Models\Playlist;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPlaylists
{
    use AsAction;

    public function handle()
    {
        $tenantId = currentTenant()->id;
        
        // Get playlists for current tenant
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

        $block = Block::firstOrCreate([
            'name' => 'playlists',    
        ],['active' => false]);

        return response()->json([
            'data' => [
                'id' => $block->id,  
                'active' => $block->active,
                'title' => data_get($block, 'config.title', ''),
                'subtitle' => data_get($block, 'config.subtitle', ''),
                'playlists' => $playlists,
            ],
        ]);
    }
}

