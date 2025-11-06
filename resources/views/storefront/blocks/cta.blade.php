
<?php
use App\Models\Block;
use App\Models\Link;

new class extends Livewire\Volt\Component {
    public $component;
    public $view;
  
    public function render(): \Illuminate\Contracts\View\View
    {
        $view = $this->view ?? 'cta';
        
        $block = Block::where('name', 'cta')->first();
        $links = Link::orderBy('sort')->where('active', true)->where('type', 'cta')->get();
        
        if (data_get($block, 'active', false)) {
            return view()->first(['theme::blocks.'.$view, 'theme::blocks.cta'], ['block' => $block, 'links' => $links]);      
        }
        return view('empty');      
    } 

    function placeholder()
    {
        return loadingIcon();
    }
}; ?>
