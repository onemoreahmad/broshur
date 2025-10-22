<?php 

use Illuminate\Contracts\View\View;
use App\Models\Block;
 
new class extends \Livewire\Volt\Component {
    public function render(): View
    {
        $blocks = Block::where('active', true)->orderBy('order')->get();
        $header = Block::where('name', 'header')->first();
   

        return view()->first(['theme::home'])
            ->layout('theme::layout')
            ->with([
                'blocks' => $blocks,
                'options' => option(),
                'header' => data_get($header, 'config', []),
            ])
            ;      
    } 
}; ?>

 