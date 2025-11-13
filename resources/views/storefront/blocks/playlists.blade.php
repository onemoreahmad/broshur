
<?php
use App\Models\Block;
use App\Models\Playlist;

new class extends Livewire\Volt\Component {
    public $component;
    public $view;
  
    public function render(): \Illuminate\Contracts\View\View
    {
        $view = $this->view ?? 'playlists';
        
        $block = Block::where('name', 'playlists')->first();
        $tenantId = currentTenant()->id;
        
        $playlists = Playlist::where('tenant_id', $tenantId)
            ->where('active', true)
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
         
        if(data_get($block, 'active', false) || $playlists->count() > 0){
            return view()->first(['theme::blocks.'.$view, 'theme::blocks.playlists'], [
                'block' => $block, 
                'playlists' => $playlists,
                'title' => data_get($block, 'config.title', ''),
                'subtitle' => data_get($block, 'config.subtitle', ''),
            ]);      
        }

        return view('empty');
    } 

    function placeholder()
    {
        return loadingIcon();
    }
}; ?>

