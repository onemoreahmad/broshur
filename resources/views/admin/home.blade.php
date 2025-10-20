<x-admin::layout>
     
    <div class="bg-gray-200 min-h-lg pt-3 px-0.5 xl:px-0">
        <div class="max-w-7xl mx-auto py-4 flex items-center gap-4">
            <img src="{{data_get(currentTenant(), 'logo')}}" alt="avatar" class="size-16 rounded-2xl">
            <div class="">
                <h1 class="text-2xl font-bold"> {{data_get(currentTenant(), 'name')}} </h1> 
                <p class="text-sm text-gray-500"> {{data_get(currentTenant(), 'handle')}} </p>
            </div>
        </div>
 
        <div class="lg:flex max-w-7xl mx-auto items-start px-1 xl:px-0">
            <nav class="flex lg:flex-col lg:w-80 gap-px overflow-hidden mx-auto justify-between max-w-7xl overflow-x-auto text-start">
                <button wire:click="setTab('header')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 flex flex-grow items-center gap-x-2 text-xs rounded-s p-2 px-3 {{ $tab == 'header' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 👨🏻‍💻 </span>
                    <span class="text-sm text-gray-500"> الترويسة (الهيدر) </span>
                </button>
                <button wire:click="setTab('cta')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 rounded-s p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'cta' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 🎓 </span>
                    <span class="text-sm text-gray-500"> أزرار الإجراءات </span>
                </button>
                <button wire:click="setTab('hero')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 rounded-s p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'hero' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 💼 </span>
                    <span class="text-sm text-gray-500"> المنتج الرئيسي</span>
                </button>
                <button wire:click="setTab('faq')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 rounded-s p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'faq' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 💼 </span>
                    <span class="text-sm text-gray-500"> الأسئلة المتكررة</span>
                </button>
                <button wire:click="setTab('features')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 rounded-s p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'features' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 🎯 </span>
                    <span class="text-sm text-gray-500"> قائمة المزايا </span>
                </button>
                <button wire:click="setTab('testimonials')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 rounded-s p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'testimonials' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 🎖️ </span>
                    <span class="text-sm text-gray-500"> آراء العملاء </span>
                </button>
                <button wire:click="setTab('projects')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 rounded-s p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'projects' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 👨🏻‍⚖️ </span>
                    <span class="text-sm text-gray-500"> الأعمال والمشاريع </span>
                </button>
                <button wire:click="setTab('branches')" class="cursor-pointer lg:w-full w-fit text-start shrink-0 hover:bg-gray-50 rounded-s p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'branches' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 🎎 </span>
                    <span class="text-sm text-gray-500"> الفروع وساعات العمل </span>
                </button>
                <button wire:click="setTab('links')" class="cursor-pointer lg:w-full w-fit text-start shrink-0 hover:bg-gray-50 rounded-s p-2 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'links' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 🔗 </span>
                    <span class="text-sm text-gray-500"> الحسابات الإجتماعية </span>
                </button>
            </nav>

            <div class="bg-white lg:rounded-lg rounded-b-lg -mr-1.5 p-6 min-h-[60vh] w-full">
                <livewire:is :component="'admin.home.'.$tab" wire:key="tab-{{ $tab }}" lazy />
            </div> 

            <div class="hidden lg:block lg:px-5">
                <ui:mobile>
                    <iframe id="linkinbio-iframe" src="{{route('storefront.home.preview', currentTenant('handle'))}}" class="w-full min-h-screen"></iframe>
                </ui:mobile>   
            </div>

        </div>
    </div>
 
        {{-- <div class="bg-gray-100 min-h-screen">
            <div class="bg-white rounded-b-lg shadow-sm p-6 max-w-7xl mx-auto">
                <livewire:is :component="'admin.home.'.$tab" wire:key="tab-{{ $tab }}" lazy />
            </div> 
        </div>  --}}
    
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


