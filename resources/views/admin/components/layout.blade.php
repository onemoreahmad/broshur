<div>
    <x-admin::notify />
    <ui:navbar wire:ignore class="!bg-purple-700 bg-gradient-to-r from-primary-900 via-primary-800 to-indigo-700 !p-3 text-white">
    {{-- <ui:navbar wire:ignore class="!bg-primary-900 !p-2 text-white"> --}}
    {{-- <ui:navbar wire:ignore class="bg-gradient-to-r from-blue-800 via-cyan-700 to-blue-900  !p-2 text-white"> --}}
    {{-- <ui:navbar wire:ignore class="bg-[conic-gradient(at_top_left,_var(--tw-gradient-stops))] from-[#202040] via-[#543864] to-[#ff6363] !p-2 text-white"> --}}
        <ui:brand href="{{ route('admin.home') }}" wire:navigate logo="{{data_get(currentTenant(), 'logo')}}" name="{{ config('app.name') }}" Xsubtitle="{{ config('app.domain') }}" size="7"  />
 


        <x-slot name="end">
            {{-- <ui:button variant="ghost" class="text-white" wire:current="!bg-white/10" href="{{ route('admin.settings.index') }}" wire:navigate icon="settings" label="الإعدادات" />  --}}
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
        <div class="flex items-center gap-x-px container justify-between lg:justify-start overflow-x-auto mx-auto px-px lg:px-0 divide-x-reverse divide-xXX divide-gray-400/20 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            <a href="{{ route('admin.home') }}" wire:navigate title="" class="lg:w-fullx shrink-0 lg:shrink justify-center flex items-center gap-x-2  px-5 py-3" wire:current.exact="bg-gray-200">
                <ui:icon name="home" size="6" />
            </a>

            <a href="{{ route('admin.orders.index') }}" wire:navigate title="" class="lg:w-fullX shrink-0 lg:shrinkX justify-center flex items-center gap-x-2 px-5 py-3" wire:current="bg-gray-200">
                <ui:icon name="message-2" size="6" />
                <span class="text-sm">
                    التفاعل والطلبات
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


