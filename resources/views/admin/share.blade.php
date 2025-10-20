<x-admin::layout>   
  
    {{-- <div class="py-1 bg-gray-100">
        <ui:breadcrumbs class="max-w-7xl mx-auto py-2">
            <ui:breadcrumbs.item href="{{ route('admin.home') }}" icon="home" wire:navigate />
            <ui:breadcrumbs.item wire:navigate> نشر ومشاركة البروشور</ui:breadcrumbs.item>
        </ui:breadcrumbs>
    </div> --}}
 
    <div class="max-w-7xl mx-auto py-6 flex flex-col gap-y-4">
        <ui:callout color="blue" icon="info-circle" text="يمكنك نشر ومشاركة رابط البروشور من هنا." />
 
        {{-- <div class="md:flex items-center bg-gray-50 p-4 rounded-lg">
            <div class="w-full">
               <div class="me-3 font-bold ms-1 mb-4 text-gray-500 flex items-center text-sm grow leading-[21px]">
                  <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 me-2" data-sentry-element="svg" data-sentry-source-file="page.tsx">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" data-sentry-element="path" data-sentry-source-file="page.tsx"></path>
                  </svg>
                  نسبة اكتمال البروشور
               </div>
               <div class="flex items-center bg-gray-300/50 p-[1px] xborder border-blue-400 rounded-sm my-1 w-full">
                  <div class="grow rounded-sm truncate">
                     <div class="bg-gradient-to-l from-blue-800 to-blue-500 text-xs leading-none py-2 px-3 text-white font-bold rounded-s truncate" style="width: {{ currentTenant('progress') }}%;"><span> {{ currentTenant('progress') }}% </span></div>
                  </div>
               </div>
            </div>
         </div> --}}
          
         <div x-data="{ input: '{{ currentTenant('storefrontUrl') }}'  }" class="flex items-center gap-2 bg-gray-300/50 p-1 rounded-lg">
            <ui:icon name="link" class="text-gray-500 ms-2" />
            <div class="text-gray-400 text-sm w-full bg-white p-2 px-3 rounded-lg border border-gray-200" dir="ltr">{{ currentTenant('storefrontUrl') }}</div>
            <ui:button icon="copy" @click="navigator.clipboard.writeText(input), $dispatch('notify', {text: 'تم نسخ رابط السيرة الذاتية', type: 'success'})" class="bg-white hover:bg-gray-100 !text-gray-500" />
            <ui:button icon="eye" icon:trailing="arrow-up-left" target="_blank" variant="primary" class="bg-green-500 hover:bg-green-600 text-white" href="{{ currentTenant('storefrontUrl') }}"> معاينة البروشور</ui:button>
         </div>
  
   
      

         <div class="md:flex items-center bg-gray-50 p-2 rounded-lg" data-sentry-component="ShareCv" data-sentry-source-file="share-cv.tsx">
            <div class="grow">
               <div class="me-3 font-bold ms-1 mb-6 mt-2 md:mb-0 shrink-0 text-gray-500 flex items-center text-sm grow">
                  <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 me-2" data-sentry-element="svg" data-sentry-source-file="share-cv.tsx">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" data-sentry-element="path" data-sentry-source-file="share-cv.tsx"></path>
                  </svg>
                  مشاركة البروشور
               </div>
          
                <div class="flex flex-col md:flex-row items-center gap-2 p-2 mt-4">
                  
                  <ui:button variant="outline" class="w-fullx" target="_blank" href="https://api.whatsapp.com/send?text={{ currentTenant('storefrontUrl') }}">
            
                         <img src="{{ asset('assets/icons/social/brand-whatsapp.svg') }}" alt="whatsapp" class="size-5 !text-white">
                 
                        واتساب
                  </ui:button>
                  <ui:button variant="outline" class="w-fullx" target="_blank" href="https://t.me/share/url?text={{ currentTenant('storefrontUrl') }}&url={{ currentTenant('storefrontUrl') }}">
                  
                           <img src="{{ asset('assets/icons/social/brand-telegram.svg') }}" alt="telegram" class="size-5">
                     
                        تليجرام
                  </ui:button>
                  <ui:button variant="outline" class="w-fullx" target="_blank" href="https://x.com/intent/tweet?url={{ currentTenant('storefrontUrl') }}&text={{ tenant()->name }}">
                     
                           <img src="{{ asset('assets/icons/social/brand-x.svg') }}" alt="x" class="size-5">
                     
                        تويتر  
                  </ui:button>
                  <ui:button variant="outline" class="w-fullx" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ currentTenant('storefrontUrl') }}">
                     
                           <img src="{{ asset('assets/icons/social/brand-facebook.svg') }}" alt="facebook" class="size-5">
               
                        فيسبوك
                  </ui:button>
                  <ui:button variant="outline" class="w-fullx" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ currentTenant('storefrontUrl') }}">
                     
                           <img src="{{ asset('assets/icons/social/brand-linkedin.svg') }}" alt="linkedin" class="size-5">
                     
                        لينكد ان
                  </ui:button>
      
                  <ui:button variant="outline" class="w-fullx" target="_blank" href="mailto:info@example.com?&subject=&cc=&bcc=&body={{ currentTenant('storefrontUrl') }}">
                     
                           <img src="{{ asset('assets/icons/social/brand-email.svg') }}" alt="email" class="size-5">
                     
                        البريد الالكتروني
                  </ui:button>
                </div>
  
            </div>
         </div>




      
    </div>  
</x-admin::layout>

<?php
use Livewire\Attributes\Title;
 

new 
#[Title('نشر ومشاركة البروشور')]
class extends \Livewire\Volt\Component {

 
}; ?>
