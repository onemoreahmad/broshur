<div>
    @if(data_get($block, 'active', true))
        @includeFirst(['theme::blocks.'.$component, 'empty'] , data_get($block, 'config', []))
    @endif
</div>
 
<?php
use App\Models\Block;
new class extends Livewire\Volt\Component {
    public $component;
 
    function with() {           
         return [
            'block' =>   Block::where('name', $this->component)->first()
        ]; 
    }
 
    function placeholder()
    {
        return loadingIcon();

        // return view('ui::components.lazy-placeholder', ['color' => 'gray-400', 'padding' => 'py-1', 'size' => '4', 'width' => 'w-10']);
    }
 
}; ?>
