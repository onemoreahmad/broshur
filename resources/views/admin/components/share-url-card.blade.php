@props([
    'url' => null,
    'width' => 'max-w-sm',
])
 
<div>
  <ui:card class="{{ $width }} !p-2">
 
        <ui:input-group label="نسخ ومشاركة رابط الصفحة" :block="true">
            <ui:input icon="link" dir="ltr" x-data="{linkatUrl: '{{ $url }}'}" x-model="linkatUrl" value="{{ $url }}" readonly copyable />
            
            <div class="flex gap-x-2 justify-center items-center mt-4">
                <ui:button class="w-full" icon:trailing="arrow-up-left" href="{{ $url }}" target="_blank">معيانة</ui:button>
                <ui:button class="w-full" variant="outline" icon="share" @click="$dispatch('openmodal', { modal: 'share-link' })">مشاركة</ui:button>
            </div>
        </ui:input-group>


        <ui:modal name="share-link" size="md" title="مشاركة رابط صفحتك">
          
            <div class="flex justify-center items-center mt-4">
                <ui:icon name="share" class="size-10 mx-auto text-gray-400 justify-center flex" />
            </div>

            <ui:heading class="text-center" size="lg">مشاركة رابط صفحتك </ui:heading>
            <ui:text class="text-center" size="xs">انسخ وشارك رابط صفحتك على الشبكات الاجتماعية </ui:text>
 
            <div class="mt-6 flex items-center gap-x-1 p-5">
                <ui:input icon="link" x-data="{linkatUrl: '{{ $url }}'}" x-model="linkatUrl" value="{{ $url }}" readonly copyable />
                <ui:button icon:trailing="arrow-up-left" href="{{ $url }}" target="_blank">معيانة</ui:button>
            </div>
               
            <div class="flex flex-col gap-2  p-4">
                <ui:button variant="outline" class="w-full" target="_blank" href="https://api.whatsapp.com/send?text={{ $url }}">
                    <x-slot:image>
                        <img src="{{ asset('assets/icons/social/brand-whatsapp.svg') }}" alt="whatsapp" class="size-5">
                    </x-slot:image>
                    مشاركة على واتساب
                </ui:button>
                <ui:button variant="outline" class="w-full" target="_blank" href="https://t.me/share/url?text={{ $url }}&url={{ $url }}">
                    <x-slot:image>
                        <img src="{{ asset('assets/icons/social/brand-telegram.svg') }}" alt="telegram" class="size-5">
                    </x-slot:image>
                    مشاركة على تليجرام
                </ui:button>
                <ui:button variant="outline" class="w-full" target="_blank" href="https://x.com/intent/tweet?url={{ $url }}&text={{ currentTenant()->name }}">
                    <x-slot:image>
                        <img src="{{ asset('assets/icons/social/brand-x.svg') }}" alt="x" class="size-5">
                    </x-slot:image>
                    مشاركة على تويتر  
                </ui:button>
                <ui:button variant="outline" class="w-full" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}">
                    <x-slot:image>
                        <img src="{{ asset('assets/icons/social/brand-facebook.svg') }}" alt="facebook" class="size-5">
                    </x-slot:image>
                    مشاركة على فيسبوك
                </ui:button>
                <ui:button variant="outline" class="w-full" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ $url }}">
                    <x-slot:image>
                        <img src="{{ asset('assets/icons/social/brand-linkedin.svg') }}" alt="linkedin" class="size-5">
                    </x-slot:image>
                    مشاركة على لينكد ان
                </ui:button>

                <ui:button variant="outline" class="w-full" target="_blank" href="mailto:info@example.com?&subject=&cc=&bcc=&body={{ $url }}">
                    <x-slot:image>
                        <img src="{{ asset('assets/icons/social/brand-email.svg') }}" alt="email" class="size-5">
                    </x-slot:image>
                    مشاركة على البريد الالكتروني
                </ui:button>
 
    
            </div>
 
        </ui:modal>
 
</ui:card>


</div>