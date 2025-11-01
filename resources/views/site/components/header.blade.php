<header class="py-2 @if(!request()->routeIs('site.home')) bg-black/80 @endif text-white sm:py-3 fixedX w-full " x-data="{expanded: false}">
        <div class="px-2 lg:px-0 mx-auto max-w-7xl">
            <div class="flex items-center justify-between">
                <div class="shrink-0 flex items-center gap-x-2">
                    <a href="{{ route('site.home') }}" wire:navigate title="" class="flex items-center gap-x-3  ">
                        <img class="w-auto h-7" src="{{ asset('assets/images/logo-shape-white.svg') }}" alt="" />
                        <img class="w-auto h-7" src="{{ asset('assets/images/logo-white-0.webp') }}" alt="" />
                        {{-- <span class=" font-bold">
                            {{ config('app.name') }} 
                        </span> --}}
                    </a>

                    {{-- <div class="lg:ms-20 ms-6 flex items-center gap-x-2">
                        <ui:button variant="ghost" href="{{ route('site.page.plans') }}" label="الأسعار" wire:navigate wire:current="!bg-gray-800" class="text-white hover:text-white/70 !hover:bg-black/5 "  />
                    </div> --}}
                </div>
     
      
                <div class="flex items-center sm:ms-auto lg:ms-4 gap-x-2">
                    @auth
                        <ui:button variant="primary" href="{{ route('admin.home') }}" label="لوحة التحكم" class="!rounded-full text-xl !p-6" rounded="full" icon="settings" />
                    @else
                        <ui:button variant="primary" href="{{ route('auth.register') }}" label="بروشور جديد" wire:navigate rounded="full" icon="plus" class="!rounded-full !bg-primary-600 !hover:bg-primary-700" />
                        <ui:button variant="ghost" href="{{ route('auth.login') }}" label="دخول" wire:navigate class="text-white hover:text-white/70 !hover:bg-black/5 " icon:trailing="arrow-left" />
                    @endauth   
 
                </div>
     
            </div>
        </div>
    </header>
 

     <svg class="absolute hidden md:block inset-0 -z-10 size-full stroke-black/10 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]" aria-hidden="true">
        <defs>
          <pattern id="983e3e4c-de6d-4c3f-8d64-b9761d1534cc" width="200" height="200" x="50%" y="-1" patternUnits="userSpaceOnUse">
            <path d="M.5 200V.5H200" fill="none" />
          </pattern>
        </defs>
        <svg x="50%" y="-1" class="overflow-visible fill-pink-200/5">
          <path d="M-200 0h201v201h-201Z M600 0h201v201h-201Z M-400 600h201v201h-201Z M200 800h201v201h-201Z" stroke-width="0" />
        </svg>
        <rect width="100%" height="100%" stroke-width="0" fill="url(#983e3e4c-de6d-4c3f-8d64-b9761d1534cc)" />
      </svg>
      {{-- <div class="absolute left-[calc(50%-4rem)] top-40 -z-10 transform-gpu blur-3xl sm:left-[calc(50%-18rem)] lg:left-48 lg:top-[calc(50%-30rem)] xl:left-[calc(50%-24rem)]" aria-hidden="true">
        <div class="aspect-[1108/632] w-[69.25rem] bg-gradient-to-r from-[#80caff] to-[#4f46e5] opacity-10" style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)"></div>
      </div>
       --}}