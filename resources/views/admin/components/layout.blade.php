<div>
    <x-admin::notify />
    {{-- <ui:navbar wire:ignore container="max-w-7xl" class="!bg-purple-700 bg-gradient-to-r from-primary-900 via-primary-800 to-indigo-700 !p-3 text-white"> --}}
    <ui:navbar wire:ignore container="max-w-7xl" class="!bg-[#030637] bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-[#030637] via-[#3c0753] to-[#720455]/50 !p-3 text-white">
    {{-- <ui:navbar wire:ignore class="!bg-primary-900 !p-2 text-white"> --}}
    {{-- <ui:navbar wire:ignore class="bg-gradient-to-r from-blue-800 via-cyan-700 to-blue-900  !p-2 text-white"> --}}
    {{-- <ui:navbar wire:ignore class="bg-[conic-gradient(at_top_left,_var(--tw-gradient-stops))] from-[#202040] via-[#543864] to-[#ff6363] !p-2 text-white"> --}}
        {{-- <ui:brand href="{{ route('admin.home') }}" wire:navigate logo="{{data_get(currentTenant(), 'logo')}}" name="{{data_get(currentTenant(), 'name')}}" Xsubtitle="{{ config('app.domain') }}" size="7"  /> --}}
        <ui:brand href="{{ route('admin.home') }}" wire:navigate logo="{{ asset('assets/images/logo-shape-white.svg') }}"  size="6" iconClass="!w-auto" />
        <ui:brand href="{{ route('admin.home') }}" wire:navigate logo="{{ asset('assets/images/logo-white.webp') }}"  size="6" iconClass="!w-auto" />
 
        <a href="{{ route('admin.orders.index') }}" wire:navigate title="" class="shrink-0 ms-12 justify-center flex items-center gap-x-2 text-white p-1 px-2 rounded-lg " wire:current="bg-black/40">
            <ui:icon name="message-2" size="6" />
            <span class="text-sm hidden lg:block">
                التفاعل والطلبات
            </span>
            <span class="text-sm block lg:hidden">
                الطلبات
            </span>
        </a>

        <x-slot name="end">
            <ui:button variant="ghost" class="text-white !hidden !lg:block !bg-green-600 !hover:bg-green-700" wire:current="!bg-white/10" href="{{ tenant('storeFrontUrl') }}" target="_blank" icon:trailing="arrow-up-left" label="معاينة البروشور" /> 
            <ui:button variant="ghost" class="text-white !block !lg:hidden !bg-green-600 !hover:bg-green-700" wire:current="!bg-white/10" href="{{ tenant('storeFrontUrl') }}" target="_blank" icon:trailing="arrow-up-left" /> 
            <ui:dropdown>
                <x-slot:trigger @click="openDropdown = ! openDropdown" class="flex items-center gap-x-2" icon:trailing="chevron-down">
                    <ui:avatar :src="data_get(auth()->user(), 'image')" size="sm" class="border-2 border-black/10 hover:border-black/20" /> 
                </x-slot:trigger>

                <div class="p-0.5 bg-white rounded-b-md mt-px w-48 text-sm">
                    <div class="text-gray-500 p-2 mb-1">
                        <ui:heading size="sm" class="text-gray-500">{{ data_get(auth()->user(), 'name') }}</ui:heading>
                        @if (auth()->user()?->email)
                            <ui:text size="xs" class="text-gray-500">{{ data_get(auth()->user(), 'email') }}</ui:text>
                        @endif
                    </div>
                    <div class=" grid gap-y-px">
                        <ui:button variant="secondary" icon="user" href="{{ route('admin.account.index') }}" wire:navigate label="حسابي" class="bg-gray-100 justify-start" />

                        <ui:button variant="secondary" icon="home" href="{{ route('site.home') }}" label="{{config('app.name')}}" class="bg-gray-100 justify-start" />
                        @if (auth()->user())
                            <ui:button variant="secondary" icon="logout" label="خروج" href="{{ route('auth.logout') }}" class="bg-gray-100 justify-start" />
                        @endif
                    </div>
                </div>
            </ui:dropdown>
        </x-slot>
    </ui:navbar>
     
    <nav class="bg-white pt-1x">
        <div class="flex items-center gap-x-px max-w-7xl justify-between lg:justify-start overflow-x-auto mx-auto px-px lg:px-0 divide-x-reverse divide-xXX divide-gray-400/20 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            <a href="{{ route('admin.home') }}" wire:navigate title="" class="lg:w-fullx xshrink-0 lg:shrink justify-center flex items-center w-full lg:w-auto gap-x-2  lg:px-5 px-2 py-3" wire:current.exact="bg-gray-200">
                <ui:icon name="file-text" size="6" />
                <span class="text-sm hidden lg:block">
                    محتوى الصفحة
                </span>
                <span class="text-sm block lg:hidden">
                    المحتوى
                </span>
            </a>

            <a href="{{ route('admin.design') }}" wire:navigate title="" class="lg:w-fullX xshrink-0 lg:shrink justify-center flex items-center w-full lg:w-auto gap-x-2 lg:px-5 px-2 py-3" wire:current="bg-gray-200">
                <ui:icon name="palette" size="6" />
                <span class="text-sm">
                    التصميم
                </span>
            </a>

            <a href="{{ route('admin.share') }}" wire:navigate title="" class="lg:w-fullX xshrink-0 lg:shrink justify-center flex items-center w-full lg:w-auto gap-x-2 lg:px-5 px-2 py-3" wire:current="bg-gray-200">
                <ui:icon name="share" size="6" />
                <span class="text-sm hidden lg:block">
                    نشر ومشاركة 
                </span>
                <span class="text-sm block lg:hidden">
                    نشر
                </span>
            </a>

            <a href="{{ route('admin.settings.index') }}" wire:navigate title="" class="lg:w-fullX xshrink-0 lg:shrink justify-center flex items-center w-full lg:w-auto gap-x-2 lg:px-5 px-2 py-3" wire:current="bg-gray-200">
                <ui:icon name="settings" size="6" />
                <span class="text-sm">
                    الإعدادات
                </span>
            </a>
    
        </div>
    </nav>
  
    {{$slot}}

    {{-- <hr class="my-1"> 
 
    <ui:router.link href="/" component="home">home</ui:router.link>
    <ui:router.link href="about" component="about">about</ui:router.link>

    <hr class="my-1"> 

    <ui:router.view class="min-h-screen"></ui:router.view> --}}
</div>


