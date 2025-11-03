
<?php
use App\Models\Block;
use App\Models\Link;

new class extends Livewire\Volt\Component {
    public $component;
    public $view;
  
    public function render(): \Illuminate\Contracts\View\View
    {
        $view = $this->view ?? 'links';
        
        $block = Block::where('name', 'links')->first();
        $links = Link::orderBy('sort')->where('active', true)->where('type', 'link')->get();

        if ($block->active) {
            return view()->first(['theme::blocks.'.$view, 'theme::blocks.links'], ['block' => $block, 'links' => $links]);      
        }

        return view('empty');      
    }

    function placeholder()
    {
        return loadingIcon();
    }
}; ?>
        return view()->first(['theme::blocks.'.$view, 'theme::blocks.links'], ['block' => $block, 'links' => $links]);      
    } 

    function placeholder()
    {
        return loadingIcon();
    }
}; ?>
