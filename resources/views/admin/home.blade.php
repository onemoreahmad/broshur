 <x-admin::layout>
    <x-admin::container>

            
        list broshurs .. 
 
    </x-admin::container>
</x-admin::layout>
<?php 
 
new 
#[\Livewire\Attributes\Title('إدارة البروشور')]
class extends \Livewire\Volt\Component {

     public $range = [7];
 
     public function mount()
     {
         $this->range = [(int) now()->diffInDays(now()->copy()->startOfMonth()->subDay(3), true)];
     }

}; ?>


