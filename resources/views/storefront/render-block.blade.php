{{-- <div>
    @if(data_get($block, 'active'))
        @includeFirst(['theme::blocks.'.$component, 'empty'] , data_get($block, 'config', []))
    @endif
</div> --}}
 
<?php
use App\Models\Block;
new class extends Livewire\Volt\Component {
    public $component;
 
    function placeholder()
    {
        return loadingIcon();

        // return view('ui::components.lazy-placeholder', ['color' => 'gray-400', 'padding' => 'py-1', 'size' => '4', 'width' => 'w-10']);
    }
 
    public function render(): \Illuminate\Contracts\View\View
    {
        $block = Block::where('name', $this->component)->first();
        
        if(data_get($block, 'active', false)){
            return view()->first(['theme::blocks.'.$this->component], data_get($block, 'config', []));      
        }

        return view('empty');
    } 
}; ?>
