<x-admin::layout>
     
    <div class="bg-gray-200 min-h-lg pt-3 px-0.5 xl:px-0">
        <div class="max-w-7xl mx-auto py-4 flex items-center gap-4">
            <img src="{{data_get(currentTenant(), 'logo')}}" alt="avatar" class="size-16 rounded-2xl">
            <div class="">
                <h1 class="text-2xl font-bold"> {{data_get(currentTenant(), 'name')}} </h1> 
                <p class="text-sm text-gray-500"> {{data_get(currentTenant(), 'handle')}} </p>
            </div>
        </div>
 
        <div class="lg:flex max-w-7xl mx-auto items-start px-1 xl:px-0 mt-3">
            <nav class="flex lg:flex-col lg:w-80 gap-px overflow-hidden mx-auto justify-between max-w-7xl overflow-x-auto text-start">
                <button wire:click="setTab('header')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 flex flex-grow items-center gap-x-2 text-xs rounded-s p-2.5 px-3 {{ $tab == 'header' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-layout-navbar size-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 3a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h12zm1 6h-14v9a1 1 0 0 0 .883 .993l.117 .007h12a1 1 0 0 0 .993 -.883l.007 -.117v-9z" /></svg>
                     </span>
                    <span class="text-sm text-gray-500"> الترويسة (الهيدر) </span>
                </button>
                <button wire:click="setTab('cta')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'cta' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 
<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-octagon-plus size-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13.196 1.246l5.575 2.39a3.04 3.04 0 0 1 1.595 1.594l2.388 5.573c.328 .764 .328 1.63 0 2.393l-2.39 5.575a3.04 3.04 0 0 1 -1.594 1.595l-5.573 2.388a3.03 3.03 0 0 1 -2.393 0l-5.574 -2.389a3.04 3.04 0 0 1 -1.595 -1.595l-2.388 -5.574a3.04 3.04 0 0 1 0 -2.392l2.39 -5.575a3.04 3.04 0 0 1 1.593 -1.595l5.574 -2.388a3.04 3.04 0 0 1 2.392 0m-1.196 6.754a1 1 0 0 0 -1 1v2h-2a1 1 0 0 0 0 2h2v2a1 1 0 0 0 2 0v-2h2a1 1 0 0 0 0 -2h-2v-2a1 1 0 0 0 -1 -1" /></svg>  
                     </span>
                    <span class="text-sm text-gray-500"> أزرار الإجراءات </span>
                </button>
                 <button wire:click="setTab('links')" class="cursor-pointer lg:w-full w-fit text-start shrink-0 hover:bg-gray-50 rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'links' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 
                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-share size-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M8.7 10.7l6.6 -3.4" /><path d="M8.7 13.3l6.6 3.4" /></svg>
                    </span>
                    <span class="text-sm text-gray-500"> الحسابات الإجتماعية </span>
                </button>
                <button wire:click="setTab('hero')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'hero' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star size-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" /></svg>
                     </span>
                    <span class="text-sm text-gray-500"> المنتج الرئيسي</span>
                </button>
              
                <button wire:click="setTab('features')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'features' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-folder-star size-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 19h-5a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2h4l3 3h7a2 2 0 0 1 2 2v2.5" /><path d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" /></svg>
                    </span>
                    <span class="text-sm text-gray-500"> قائمة المزايا </span>
                </button>
                <button wire:click="setTab('faq')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'faq' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-help-hexagon size-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.425 1.414a3.33 3.33 0 0 1 3.026 -.097l.19 .097l6.775 3.995l.096 .063l.092 .077l.107 .075a3.224 3.224 0 0 1 1.266 2.188l.018 .202l.005 .204v7.284c0 1.106 -.57 2.129 -1.454 2.693l-.17 .1l-6.803 4.302c-.918 .504 -2.019 .535 -3.004 .068l-.196 -.1l-6.695 -4.237a3.225 3.225 0 0 1 -1.671 -2.619l-.007 -.207v-7.285c0 -1.106 .57 -2.128 1.476 -2.705l6.95 -4.098zm1.575 13.586a1 1 0 0 0 -.993 .883l-.007 .117l.007 .127a1 1 0 0 0 1.986 0l.007 -.117l-.007 -.127a1 1 0 0 0 -.993 -.883zm1.368 -6.673a2.98 2.98 0 0 0 -3.631 .728a1 1 0 0 0 1.44 1.383l.171 -.18a.98 .98 0 0 1 1.11 -.15a1 1 0 0 1 -.34 1.886l-.232 .012a1 1 0 0 0 .111 1.994a3 3 0 0 0 1.371 -5.673z" /></svg>
                    </span>
                    <span class="text-sm text-gray-500"> الأسئلة المتكررة</span>
                </button>
                <button wire:click="setTab('testimonials')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'testimonials' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-stars size-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17.657 12.007a1.39 1.39 0 0 0 -1.103 .765l-.855 1.723l-1.907 .277c-.52 .072 -.96 .44 -1.124 .944l-.038 .14c-.1 .465 .046 .954 .393 1.29l1.377 1.337l-.326 1.892a1.393 1.393 0 0 0 2.018 1.465l1.708 -.895l1.708 .896a1.388 1.388 0 0 0 1.462 -.105l.112 -.09a1.39 1.39 0 0 0 .442 -1.272l-.325 -1.891l1.38 -1.339c.38 -.371 .516 -.924 .352 -1.427l-.051 -.134a1.39 1.39 0 0 0 -1.073 -.81l-1.907 -.278l-.853 -1.722a1.393 1.393 0 0 0 -1.247 -.773l-.143 .007z" /><path d="M6.057 12.007a1.39 1.39 0 0 0 -1.103 .765l-.855 1.723l-1.907 .277c-.52 .072 -.96 .44 -1.124 .944l-.038 .14c-.1 .465 .046 .954 .393 1.29l1.377 1.337l-.326 1.892a1.393 1.393 0 0 0 2.018 1.465l1.708 -.895l1.708 .896a1.388 1.388 0 0 0 1.462 -.105l.112 -.09a1.39 1.39 0 0 0 .442 -1.272l-.324 -1.891l1.38 -1.339c.38 -.371 .516 -.924 .352 -1.427l-.051 -.134a1.39 1.39 0 0 0 -1.073 -.81l-1.908 -.279l-.853 -1.722a1.393 1.393 0 0 0 -1.247 -.772l-.143 .007z" /><path d="M11.857 2.007a1.39 1.39 0 0 0 -1.103 .765l-.855 1.723l-1.907 .277c-.52 .072 -.96 .44 -1.124 .944l-.038 .14c-.1 .465 .046 .954 .393 1.29l1.377 1.337l-.326 1.892a1.393 1.393 0 0 0 2.018 1.465l1.708 -.894l1.709 .896a1.388 1.388 0 0 0 1.462 -.105l.112 -.09a1.39 1.39 0 0 0 .442 -1.272l-.325 -1.892l1.38 -1.339c.38 -.371 .516 -.924 .352 -1.427l-.051 -.134a1.39 1.39 0 0 0 -1.073 -.81l-1.908 -.279l-.853 -1.722a1.393 1.393 0 0 0 -1.247 -.772l-.143 .007z" /></svg>    
                     </span>
                    <span class="text-sm text-gray-500"> آراء العملاء </span>
                </button>
                <button wire:click="setTab('projects')" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'projects' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-trophy size-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 3a1 1 0 0 1 .993 .883l.007 .117v2.17a3 3 0 1 1 0 5.659v.171a6.002 6.002 0 0 1 -5 5.917v2.083h3a1 1 0 0 1 .117 1.993l-.117 .007h-8a1 1 0 0 1 -.117 -1.993l.117 -.007h3v-2.083a6.002 6.002 0 0 1 -4.996 -5.692l-.004 -.225v-.171a3 3 0 0 1 -3.996 -2.653l-.003 -.176l.005 -.176a3 3 0 0 1 3.995 -2.654l-.001 -2.17a1 1 0 0 1 1 -1h10zm-12 5a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm14 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z" /></svg>
                     </span>
                    <span class="text-sm text-gray-500"> الأعمال والمشاريع </span>
                </button>
                <button wire:click="setTab('branches')" class="cursor-pointer lg:w-full w-fit text-start shrink-0 hover:bg-gray-50 rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 {{ $tab == 'branches' ? 'bg-white' : 'bg-gray-100/50' }}">
                    <span class="text-lg inline-block -mt-1"> 
                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-map-2 size-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" /><path d="M9 4v13" /><path d="M15 7v5.5" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
                    </span>
                    <span class="text-sm text-gray-500"> الفروع وساعات العمل </span>
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


