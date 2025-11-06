
<?php
use App\Models\Block;
use App\Models\Service;

new class extends Livewire\Volt\Component {
    public $component;
    public $view;
  
    public function render(): \Illuminate\Contracts\View\View
    {
        $view = $this->view ?? 'services';
        
        $block = Block::where('name', 'services')->first();
        $tenantId = currentTenant()->id;
        
        $services = Service::where('tenant_id', $tenantId)
            ->where('active', true)
            ->with('addons')
            ->orderBy('sort')
            ->get()
            ->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'subtitle' => $service->subtitle,
                    'detail' => $service->detail,
                    'price' => $service->price !== null ? $service->price / 100 : null,
                    'icon' => $service->icon,
                    'image' => $service->image,
                    'image_url' => $service->image_url,
                    'active' => $service->active,
                    'sort' => $service->sort,
                    'addons' => $service->addons->where('active', true)->map(function ($addon) {
                        return [
                            'id' => $addon->id,
                            'name' => $addon->name,
                            'price' => $addon->price !== null ? $addon->price / 100 : null,
                            'active' => $addon->active,
                            'sort' => $addon->sort,
                        ];
                    }),
                ];
            });
         
        if(data_get($block, 'active', false) || $services->count() > 0){
            return view()->first(['theme::blocks.'.$view, 'theme::blocks.services'], [
                'block' => $block, 
                'services' => $services,
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

