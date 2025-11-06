<?php 

use Illuminate\Contracts\View\View;
use App\Models\Block;
 
new class extends \Livewire\Volt\Component {
    public function render(): View
    {
        $privacyPolicy = Block::where('name', 'agreement')->first();

        return view()->first(['theme::agreement'])
            ->layout('theme::layout')
            ->with([
                'privacyPolicy' => $privacyPolicy,
                'options' => option(),
            ])
            ;      
    } 
}; ?>

 