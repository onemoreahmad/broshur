<x-admin::layout>
     
    <div class="bg-gray-300 min-h-lg pt-3 px-0.5 xl:px-0">
        <div class="max-w-7xl mx-auto py-4 flex items-center gap-4">
            <img src="{{data_get(currentTenant(), 'logo')}}" alt="avatar" class="size-16 rounded-2xl">
            <div class="">
                <h1 class="text-2xl font-bold"> {{data_get(currentTenant(), 'name')}} </h1> 
                <p class="text-sm text-gray-500"> {{data_get(currentTenant(), 'handle')}} </p>
            </div>
        </div>
 
        <div class="flex gap-px overflow-hidden mx-auto justify-between max-w-7xl mt-3 overflow-x-auto">
            <button wire:click="setTab('header')" class="cursor-pointer w-fit shrink-0 flex flex-grow items-center gap-x-2 text-xs rounded-t p-2 px-3 {{ $tab == 'header' ? 'bg-white' : 'bg-gray-100/50' }}">
                <span class="text-lg inline-block -mt-1"> 👨🏻‍💻 </span>
                <span class="text-sm text-gray-500"> الترويسة (الهيدر) </span>
            </button>
            <button wire:click="setTab('cta')" class="cursor-pointer w-fit shrink-0 hover:bg-gray-50 rounded-t p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'cta' ? 'bg-white' : 'bg-gray-100/50' }}">
                <span class="text-lg inline-block -mt-1"> 🎓 </span>
                <span class="text-sm text-gray-500"> أزرار الإجراءات </span>
            </button>
            <button wire:click="setTab('hero')" class="cursor-pointer w-fit shrink-0 hover:bg-gray-50 rounded-t p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'hero' ? 'bg-white' : 'bg-gray-100/50' }}">
                <span class="text-lg inline-block -mt-1"> 💼 </span>
                <span class="text-sm text-gray-500"> المنتج الرئيسي</span>
            </button>
            <button wire:click="setTab('faq')" class="cursor-pointer w-fit shrink-0 hover:bg-gray-50 rounded-t p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'faq' ? 'bg-white' : 'bg-gray-100/50' }}">
                <span class="text-lg inline-block -mt-1"> 💼 </span>
                <span class="text-sm text-gray-500"> الأسئلة المتكررة</span>
            </button>
            <button wire:click="setTab('features')" class="cursor-pointer w-fit shrink-0 hover:bg-gray-50 rounded-t p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'features' ? 'bg-white' : 'bg-gray-100/50' }}">
                <span class="text-lg inline-block -mt-1"> 🎯 </span>
                <span class="text-sm text-gray-500"> قائمة المزايا </span>
            </button>
            <button wire:click="setTab('testimonials')" class="cursor-pointer w-fit shrink-0 hover:bg-gray-50 rounded-t p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'testimonials' ? 'bg-white' : 'bg-gray-100/50' }}">
                <span class="text-lg inline-block -mt-1"> 🎖️ </span>
                <span class="text-sm text-gray-500"> آراء العملاء </span>
            </button>
            <button wire:click="setTab('projects')" class="cursor-pointer w-fit shrink-0 hover:bg-gray-50 rounded-t p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'projects' ? 'bg-white' : 'bg-gray-100/50' }}">
                <span class="text-lg inline-block -mt-1"> 👨🏻‍⚖️ </span>
                <span class="text-sm text-gray-500"> الأعمال والمشاريع </span>
            </button>
            <button wire:click="setTab('branches')" class="cursor-pointer w-fit shrink-0 hover:bg-gray-50 rounded-t p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'branches' ? 'bg-white' : 'bg-gray-100/50' }}">
                <span class="text-lg inline-block -mt-1"> 🎎 </span>
                <span class="text-sm text-gray-500"> الفروع وساعات العمل </span>
            </button>
            <button wire:click="setTab('links')" class="cursor-pointer w-fit shrink-0 hover:bg-gray-50 rounded-t p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'links' ? 'bg-white' : 'bg-gray-100/50' }}">
                <span class="text-lg inline-block -mt-1"> 🔗 </span>
                <span class="text-sm text-gray-500"> الحسابات الإجتماعية </span>
            </button>
   
        </div>

    </div>
 
        <div class="bg-white rounded-b-lg shadow-sm p-6 max-w-7xl mx-auto">
            <livewire:is :component="'admin.home.'.$tab" wire:key="tab-{{ $tab }}" lazy />
        </div> 
 
</x-admin::layout>
<?php 
 
 use Livewire\Attributes\Url;
 use Livewire\Attributes\On;
new 
#[\Livewire\Attributes\Title('إدارة البروشور')]
class extends \Livewire\Volt\Component {

     public $range = [7];
  
    #[Url(keep: true)]
     public $tab = 'header';

     public function mount()
     {
        $this->range = [(int) now()->diffInDays(now()->copy()->startOfMonth()->subDay(3), true)];
        $this->tab = request()->tab ?? 'header';
     }

    #[On('setTab')]
    public function setTab($tab) {
        $this->tab = $tab;
    }
     
}; ?>


