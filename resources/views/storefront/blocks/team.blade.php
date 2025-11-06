
<?php
use App\Models\Block;
use App\Models\TeamMember;

new class extends Livewire\Volt\Component {
    public $component;
    public $view;
  
    public function render(): \Illuminate\Contracts\View\View
    {
        $view = $this->view ?? 'team';
        
        $block = Block::where('name', 'team')->first();
        $tenantId = currentTenant()->id;
        
        $members = TeamMember::where('tenant_id', $tenantId)
            ->where('active', true)
            ->orderBy('sort')
            ->get()
            ->map(function ($member) {
                return [
                    'id' => $member->id,
                    'name' => $member->name,
                    'job_title' => $member->job_title,
                    'bio' => $member->bio,
                    'image' => $member->image,
                    'image_url' => $member->image_url,
                    'active' => $member->active,
                    'sort' => $member->sort,
                ];
            });
         
        if(data_get($block, 'active', false)){
            return view()->first(['theme::blocks.'.$view, 'theme::blocks.team'], [
                'block' => $block, 
                'members' => $members,
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

