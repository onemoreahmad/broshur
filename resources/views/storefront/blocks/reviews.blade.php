
<?php
use App\Models\Block;
use App\Models\Review;

new class extends Livewire\Volt\Component {
    public $component;
    public $view;
  
    public function render(): \Illuminate\Contracts\View\View
    {
        $view = $this->view ?? 'reviews';
        
        $block = Block::where('name', 'reviews')->first();
        $reviews = Review::orderBy('id', 'desc')->where('active', true)->limit(6)->get();
        
        
        if($block && $block->active){
            return view()->first(['theme::blocks.'.$view, 'theme::blocks.reviews'], ['block' => $block, 'reviews' => $reviews]);      
        }

        return view('empty');
    } 

    function placeholder()
    {
        return loadingIcon();
    }
}; ?>
