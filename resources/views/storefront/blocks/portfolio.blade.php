
<?php
use App\Models\Block;
use App\Models\Portfolio;

new class extends Livewire\Volt\Component {
    public $component;
    public $view;
  
    public function render(): \Illuminate\Contracts\View\View
    {
        $view = $this->view ?? 'portfolio';
        
        $block = Block::where('name', 'portfolio')->first();
        $portfolio = Portfolio::orderBy('sort', 'desc')->where('active', true)->get();
        
        
        if($block->active){
            return view()->first(['theme::blocks.'.$view, 'theme::blocks.portfolio'], ['block' => $block, 'portfolio' => $portfolio, 'title' => data_get($block, 'config.title', ''), 'subtitle' => data_get($block, 'config.subtitle', '')]);      
        }

        return view('empty');
    } 

    function placeholder()
    {
        return loadingIcon();
    }
}; ?>
