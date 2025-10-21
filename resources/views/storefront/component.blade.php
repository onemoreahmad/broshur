<div>
    @includeFirst(['theme::'.$component, 'core::empty'])
</div>


<?php
new class extends Livewire\Volt\Component {
    public $component;
  
    function placeholder()
    {
        return loadingIcon();

        // return view('ui::components.lazy-placeholder', ['color' => 'gray-400', 'padding' => 'py-1', 'size' => '4', 'width' => 'w-10']);
    }
 
}; ?>
