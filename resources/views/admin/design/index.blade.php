 <x-admin::layout>
     <x-admin::container>
     <div class="lg:grid grid-cols-3 gap-8">
        <div class="col-span-2 relative">
            {{-- <ui:icon name="corner-up-left" size="12" class="absolute -top-10 left-0 -rotate-[33deg] text-black/20 !hidden !lg:block" /> --}}
            <livewire:admin.design.design />       
        </div>

        <div class="col-span-1"> 
            {{-- <div class="mx-auto w-[350px] mb-6">
                <x-admin::share-url-card url="{{ currentTenant('storefrontUrl')   }}" />
            </div> --}}
            <ui:mobile>
                <iframe id="linkinbio-iframe" src="{{route('storefront.home.preview', currentTenant('handle'))}}" class="w-full min-h-screen"></iframe>
            </ui:mobile>   
        </div>
     </div>
     
 </x-admin::container>
 

</x-admin::layout>

<?php 
 
new 
#[\Livewire\Attributes\Title('تصميم الصفحة')]
class extends \Livewire\Volt\Component {
     
}; ?>


