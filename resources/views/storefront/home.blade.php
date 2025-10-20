<?php 

use Illuminate\Contracts\View\View;
use App\Models\Block;
use App\Models\ThemeOption;
 
new class extends \Livewire\Volt\Component {
    public function render(): View
    {
        $blocks = Block::where('tenant_id', tenant('id'))->where('active', true)->orderBy('order')->get();
   
        $themeOption = ThemeOption::where('theme_id', tenant('theme_id'))->first();

        return view()->first(['theme::home'])
            ->layout('theme::layout')
            ->with([
                'blocks' => $blocks,
                'options' => data_get($themeOption, 'config', []),
            ])
            ;      
    } 
}; ?>

 