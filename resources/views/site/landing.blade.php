<div class="bg-stone-300  min-h-screen pt-10 lg:pt-12 px-1 lg:px-0">
    <section class="relative xbg-white/50 pb-32 mx-auto max-w-7xl rounded-3xl   bg-gradient-to-b from-[#f4f4f4]  via-teal-300/10 to-transparent">
        <div class="absolute inset-0 -z-10 opacity-40 pointer-events-none">
            <svg class="size-full text-stone-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M10 0H0V10" fill="none" stroke="currentColor" stroke-width="0.4" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <div class="px-4 mx-auto max-w-7xl ">
            <div class="flex justify-center max-w-xl mx-auto">
                <div class="rounded-full flex items-center w-full mx-auto justify-between -mt-7 bg-black text-white px-2 py-2 text-xs sm:text-sm font-medium">
                      <a href="{{ route('site.home') }}" wire:navigate title="" class="flex items-center gap-x-3 ms-3">
                        <img class="w-auto h-7" src="{{ asset('assets/images/logo-shape-white.svg') }}" alt="" />
                        {{-- <img class="w-auto h-10" src="{{ asset('assets/images/logo-white.webp') }}" alt="" /> --}}
                        <img class="w-auto h-7" src="{{ asset('assets/images/logo-white-0.webp') }}" alt="" />
                        {{-- <span class="text-xl lg:text-3xl font-camel font-extrabold">
                            {{ config('app.name') }} 
                        </span> --}}
                    </a>
                   
              
                    <div class="flex items-center justify-end lg:gap-x-2">
                        @auth
                            <ui:button variant="primary" href="{{ route('dashboard.home') }}" label="لوحة التحكم" class="!rounded-full text-base font-tsh !p-6" rounded="full" icon="settings" />
                        @else
                            <ui:button variant="primary" href="{{ route('auth.register') }}" label="أنشئ صفحة" wire:navigate rounded="full" icon="plus" class="!rounded-full !bg-primary-600 !hover:bg-primary-700" />
                            <ui:button variant="ghost" href="{{ route('auth.login') }}" label="دخول" wire:navigate class="text-white hover:text-white/70 !hover:bg-black/5 !font-normal" icon:trailing="arrow-left" />
                        @endauth   
                    </div>
                </div>
            </div>


            <div class="mt-24 lg:mt-32 text-center max-w-4xl mx-auto">
 


      <div class="inline-flex items-center justify-center max-w-5xl  bg-white/30 rounded-xl p-2 mx-auto gap-x-2  mb-10 border-black/5 border-dotted">
            <img class="size-7" src="{{ asset('assets/images/logos/mnjm-logo.png') }}" alt="" />
            <div>
                <div class="flex items-center justify-center gap-x-0.5 -mr-0.5">
                    <svg class="size-3 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                        />
                    </svg>
                    <svg class="size-3 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                        />
                    </svg>
                    <svg class="size-3 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                        />
                    </svg>
                    <svg class="size-3 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                        />
                    </svg>
                    <svg class="size-3 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                        />
                    </svg>
                </div>
                <p class=" text-[11px] opacity-50"><b>4.9</b> على منجم</p>
            </div>
        </div>

                <h1 class="text-4xl sm:text-5xl md:text-6xl text-base-900 tracking-tight max-w-sm lg:max-w-2xl mx-auto">
                     أنشئ صفحة دائمة لأعمالك،  
                    <div class="relative inline-flex">
                        <span class="absolute inset-x-0 bottom-0 border-b-[12px] border-amber-400"></span>
                        <h1 class="relative text-4xl font-semibold text-black sm:text-6xl lg:text-7xl">تبيع عنّك</h1>
                    </div>
                    ،
                  

                    {{-- <span class="text-primary-500">تبيع عنّك، </span> --}}
                     بدقائق!
                </h1>
                <p class="mt-8 text-gray-500 max-w-sm lg:max-w-xl mx-auto text-base lg:text-lg  font-thin">
                    أنشئ  
                    صفحة لتسويق أعمالك ومشاريعك
                    خلال دقائق،
                    تستقبل طلبات العملاء عنّك، تجاوب على أسئلتهم، وتوصلهم بك 24/7 على مدار الساعة.
                </p>
            </div>

        <div class="mt-12 text-center max-w-sm lg:max-w-xl mx-auto">
                <div class="mt-6 flex items-center justify-center gap-3">
                    <a href="{{ route('auth.register')}}" wire:navigate class="inline-flex items-center gap-3 rounded-full bg-primary-600 text-white px-3 py-3 text-2xl ps-6 font-semiboldx shadow-sm hover:bg-primary-700">
                        أنشئ صفحتك مجاناً 
                        <ui:icon name="arrow-left" size="10" class="bg-amber-400 rounded-full p-1" />
                    </a>
                </div>
                <p class="mt-2 text-xs text-stone-500/50">خطة مجانية •  أنشئ صفحتك بثواني</p>
        </div>


        <div class="bg-stone-100x z-50 relative">
            <div class="max-w-7xl mx-auto px-4">
            
                <div class="mt-12 grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
                    
                    <div class="lg:pt-24 order-2 lg:order-none">
                        <div class="flex items-start gap-3 lg:text-end lg:flex-row-reverse">
                            <div class="shrink-0 rounded-2xl bg-stone-900/90 text-white p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-10" viewBox="0 0 24 24" fill="currentColor"><path d="M3 3h18v2H3V3zm0 6h12v2H3V9zm0 6h18v2H3v-2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-stone-900"> رابط دائم لصفحتك </h3>
                                <p class="mt-1 text-sm text-stone-600">صفحتك الرقمية الدائمة، مع رابط دائم للوصول إليها.</p>
                                {{-- <a href="#" class="mt-2 inline-block text-sm font-medium text-stone-700 hover:text-stone-900 underline underline-offset-4">Learn More</a> --}}
                            </div>
                        </div>

                        <div class="mt-16 flex items-start lg:text-end gap-3 lg:flex-row-reverse">
                            <div class="shrink-0 rounded-2xl bg-stone-900/90 text-white p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-10" viewBox="0 0 24 24" fill="currentColor"><path d="M4 5h16v10H5.17L4 16.17V5zm0 14h16v2H4v-2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-stone-900"> تصميم مخصص لصفحتك </h3>
                                <p class="mt-1 text-sm text-stone-600">تصميم مخصص لصفحتك، بناءً على ألوان هويتك وبراندك.</p>
                                {{-- <a href="#" class="mt-2 inline-block text-sm font-medium text-stone-700 hover:text-stone-900 underline underline-offset-4">Learn More</a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="order-1 lg:order-none">
                    <ui:mobile-dark>
                            {{-- <img src="https://template.canva.com/EAEsa3Aii8U/4/0/900w-3QolSmpWFXk.jpg" class="w-full h-full object-cover" alt="" /> --}}
                            <img src="https://template.canva.com/EAFqeAlAaHc/1/0/900w-2-Zw-73tvq4.jpg" class="w-full h-full object-cover" alt="" />
                        </ui:mobile-dark>
                    </div>

                    <div class="lg:pt-24 order-3 lg:order-none">
                        <div class="flex items-start gap-3 justify-end">
                        <div class="shrink-0 rounded-2xl bg-stone-900/90 text-white p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-10" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3l9 4-9 4-9-4 9-4zm0 7l9 4-9 4-9-4 9-4zm0 7l9 4-9 4-9-4 9-4z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-stone-900">Digital Marketing</h3>
                                <p class="mt-1 text-sm text-stone-600">Boost your online presence with our comprehensive digital marketing services.</p>
                                <a href="#" class="mt-2 inline-block text-sm font-medium text-stone-700 hover:text-stone-900 underline underline-offset-4">Learn More</a>
                            </div>
                            
                        </div>

                        <div class="mt-16 flex items-start gap-3 justify-end">
                        <div class="shrink-0 rounded-2xl bg-stone-900/90 text-white p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-10" viewBox="0 0 24 24" fill="currentColor"><path d="M5 4h14v2H5V4zm0 4h10v2H5V8zm0 4h14v2H5v-2zm0 4h10v2H5v-2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-stone-900">Graphic Design</h3>
                                <p class="mt-1 text-sm text-stone-600">Boost your online presence with our comprehensive digital marketing services.</p>
                                <a href="#" class="mt-2 inline-block text-sm font-medium text-stone-700 hover:text-stone-900 underline underline-offset-4">Learn More</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
        <div class="flex flex-wrap items-center justify-center max-w-5xl gap-5 mx-auto mt-20 sm:gap-y-8 md:gap-12">
            <img class="object-contain bg-white/20 rounded-2xl p-2 size-16 lg:size-20 max-w-full filter grayscaleX hover:grayscale-0 transition-all duration-300" src="{{ asset('assets/images/clients/aswar.avif') }}" alt="" />
            <img class="object-contain bg-white/20 rounded-2xl p-2 size-16 lg:size-20 max-w-full filter grayscaleX hover:grayscale-0 transition-all duration-300" src="{{ asset('assets/images/clients/frst.webp') }}" alt="" />
            <img class="object-contain bg-white/20 rounded-2xl p-2 size-16 lg:size-20 max-w-full filter grayscaleX hover:grayscale-0 transition-all duration-300" src="{{ asset('assets/images/clients/qoot.png') }}" alt="" />
            <img class="object-contain bg-white/20 rounded-2xl p-2 size-16 lg:size-20 max-w-full filter grayscaleX hover:grayscale-0 transition-all duration-300" src="{{ asset('assets/images/clients/shthel-color.webp') }}" alt="" />
            <img class="object-contain bg-white/20 rounded-2xl p-2 size-16 lg:size-20 max-w-full filter grayscaleX hover:grayscale-0 transition-all duration-300" src="{{ asset('assets/images/clients/crisp-burger.webp') }}" alt="" />
            <img class="object-contain bg-white/20 rounded-2xl p-2 size-16 lg:size-20 max-w-full filter grayscaleX hover:grayscale-0 transition-all duration-300" src="{{ asset('assets/images/clients/baderatg.jpg') }}" alt="" />
            <img class="object-contain bg-white/20 rounded-2xl p-2 size-16 lg:size-20 max-w-full filter grayscaleX hover:grayscale-0 transition-all duration-300" src="{{ asset('assets/images/clients/crisp-ice.png') }}" alt="" />
        </div>
 
        </div>
    </section>
     
     
 

     <div class="mx-auto max-w-3xl text-center relative z-10">
        <h1 class="text-3xl sm:text-4xl  text-gray-800">
            <b class="font-bold inline-block mb-7 text-5xl lg:text-6xl">لا تفوّت عميل!</b>
            <br class="" />
            استقبل طلبات عملائك وجاوب على كل أسئلتهم.
        </h1>
        <p class="mt-4 text-gray-600 leading-7 text-xl font-thin">
            استقبل اتصالات العملاء، طلبات الشراء والحجوزات، الاشتراكات والدفع، لا تفّوت عميل بعد اليوم.
        </p>
        {{-- <div class="mt-6">
            <a href="#" class="inline-flex items-center justify-center rounded-full bg-violet-600 px-6 py-3 text-white font-semibold shadow-sm hover:bg-violet-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-violet-600">
                Start for Free
            </a>
        </div> --}}
    </div>


    <!-- Features section -->
    <section class="px-4 mx-auto max-w-7xl mt-12 lg:mt-20">
        <div class="rounded-[28px] bg-base-500/5 shadow-sm  p-4 sm:p-6 lg:p-8">
            <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6 auto-rows-[130px] sm:auto-rows-[160px] lg:auto-rows-[180px]">
                <!-- Maximize Card Rewards -->
                <div class="col-span-12 md:col-span-6 lg:col-span-5 row-span-3 rounded-3xl bg-violet-100/70 p-6 sm:p-7 lg:p-8 flex flex-col">
                    <div class="flex-1">
                        <h3 class="text-2xl lg:text-3xl font-black tracking-tight text-black"> نموذج للحجز</h3>
                        <p class="mt-4 text-stone-600 text-sm leading-6 max-w-sm">Maximize rewards on every purchase. Identify top cards for each spend.</p>
                    </div>
                    <div class="mt-6 self-end">
                        <!-- credit card illustration -->
                        <svg class="w-40 h-28 sm:w-48 sm:h-32 text-violet-500" viewBox="0 0 200 130" xmlns="http://www.w3.org/2000/svg" fill="none">
                            <rect x="10" y="20" rx="14" ry="14" width="180" height="100" fill="currentColor" opacity="0.25"/>
                            <rect x="18" y="36" width="164" height="16" rx="4" fill="currentColor"/>
                            <rect x="18" y="62" width="90" height="10" rx="3" fill="currentColor" opacity="0.6"/>
                            <rect x="18" y="78" width="60" height="10" rx="3" fill="currentColor" opacity="0.6"/>
                            <rect x="152" y="70" width="30" height="22" rx="4" fill="#7c3aed"/>
                        </svg>
                    </div>
                </div>

                <!-- Manage Cards (wide) -->
                <div class="col-span-12 md:col-span-6 lg:col-span-7 row-span-1 rounded-3xl bg-pink-100 p-6 sm:p-7 lg:p-8 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-black text-black"> رسالة واتساب </h3>
                        <p class="mt-2 text-stone-600 text-sm">Manage multiple cards, track benefits, & set payment reminders.</p>
                    </div>
                    <svg class="w-28 h-28 text-pink-500" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" fill="none">
                        <rect x="12" y="36" width="96" height="56" rx="10" fill="currentColor" opacity="0.25"/>
                        <rect x="20" y="48" width="80" height="10" rx="3" fill="currentColor"/>
                        <rect x="20" y="64" width="42" height="8" rx="3" fill="currentColor" opacity="0.7"/>
                        <rect x="70" y="62" width="22" height="16" rx="4" fill="#ec4899"/>
                    </svg>
                </div>

                <!-- Set Goals -->
                <div class="col-span-12 sm:col-span-6 lg:col-span-3 row-span-2 rounded-3xl bg-yellow-100 p-6 sm:p-7 lg:p-8 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-extrabold text-black"> حجز موعد </h3>
                        <p class="mt-2 text-stone-700 text-sm">Set trip goals or target annual fee waivers.</p>
                    </div>
                    <svg class="w-20 h-20 text-yellow-500" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg" fill="none">
                        <circle cx="48" cy="48" r="28" stroke="currentColor" stroke-width="6"/>
                        <circle cx="48" cy="48" r="16" stroke="currentColor" stroke-width="6"/>
                        <path d="M48 20v-8M76 48h8M48 84v8M12 48H4" stroke="#eab308" stroke-width="6" stroke-linecap="round"/>
                        <path d="M69 27 86 14" stroke="#eab308" stroke-width="6" stroke-linecap="round"/>
                    </svg>
                </div>

                <!-- Lounges -->
                <div class="col-span-12 sm:col-span-6 lg:col-span-4 row-span-2 rounded-3xl bg-lime-100 p-6 sm:p-7 lg:p-8 flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-extrabold text-black"> شراء مباشر </h3>
                        <p class="mt-2 text-stone-700 text-sm">Track & find eligible airport & railway lounge access.</p>
                    </div>
                    <svg class="w-24 h-24 text-lime-600" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" fill="none">
                        <rect x="10" y="50" width="100" height="22" rx="6" fill="currentColor" opacity="0.25"/>
                        <rect x="20" y="40" width="40" height="10" rx="3" fill="currentColor"/>
                        <rect x="20" y="76" width="40" height="10" rx="3" fill="currentColor"/>
                        <path d="M88 40v46" stroke="#65a30d" stroke-width="8" stroke-linecap="round"/>
                        <path d="M76 56h24" stroke="#65a30d" stroke-width="8" stroke-linecap="round"/>
                    </svg>
                </div>

                <!-- Credit Card Strategy -->
                <div class="col-span-12 lg:col-span-7 row-span-2 rounded-3xl bg-orange-100 p-6 sm:p-7 lg:p-8 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl lg:text-3xl font-black text-black"> نماذج متعددة للاستحواذ على عميلك </h3>
                        <p class="mt-4 text-stone-700 text-sm max-w-md">Personalized credit card plan that fits your lifestyle.</p>
                    </div>
                    <svg class="w-40 h-28 text-orange-500" viewBox="0 0 200 120" xmlns="http://www.w3.org/2000/svg" fill="none">
                        <rect x="16" y="20" width="24" height="80" rx="4" fill="currentColor" opacity="0.3"/>
                        <rect x="60" y="44" width="24" height="56" rx="4" fill="currentColor"/>
                        <rect x="104" y="32" width="24" height="68" rx="4" fill="currentColor" opacity="0.6"/>
                        <path d="M24 22c36 0 60 20 92 20 20 0 40-8 68-20" stroke="#f97316" stroke-width="6" stroke-linecap="round"/>
                    </svg>
                </div>

                <!-- Find, Compare & Apply -->
                <div class="col-span-12 lg:col-span-5 row-span-2 rounded-3xl bg-sky-100 p-6 sm:p-7 lg:p-8 flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl lg:text-3xl font-black text-black"> تسجيل اهتمام </h3>
                        <p class="mt-4 text-stone-700 text-sm max-w-md">Discover ideal cards. Compare features and apply in minutes.</p>
                    </div>
                    <svg class="w-40 h-28 text-sky-500" viewBox="0 0 200 120" xmlns="http://www.w3.org/2000/svg" fill="none">
                        <rect x="22" y="44" width="110" height="18" rx="9" fill="currentColor"/>
                        <rect x="22" y="70" width="70" height="12" rx="6" fill="currentColor" opacity="0.6"/>
                        <circle cx="150" cy="80" r="20" stroke="#0ea5e9" stroke-width="8"/>
                        <path d="M164 94l14 14" stroke="#0ea5e9" stroke-width="8" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>



    <section class="py-16 lg:py-20 xl:py-32">
        <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-6xl">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl lg:text-5xl"> الأسئلة المتكررة  </h2>
                <p class="mt-4 text-base font-thin leading-7 text-gray-600/60 lg:text-xl lg:mt-6 lg:leading-8"> هنا قائمة بإجاباتنا على أكثر الأسئلة تكراراً، إذا لم تجد إجابة لسؤالك 
                <a href="{{route('site.page.contact')}}" wire:navigate class="text-primary-700 hover:text-primary-600"> تواصل معنا</a>
                 في أي وقت.</p>
            </div>
    
            <div x-cloak class="max-w-5xl bg-white mx-auto mt-12 overflow-hidden divide-y sm:mt-16 rounded-xl" x-data="{ active: 1 }">
                <div
                    x-data="{
                            id: 1,
                            get expanded() {
                                return this.active === this.id
                            },
                            set expanded(value) {
                                this.active = value ? this.id : null
                            },
                        }"
                    role="region"
                >
                    <h3>
                        <button @click="expanded = !expanded" :aria-expanded="expanded" class="flex items-center justify-between w-full px-6 py-5 text-sm lg:text-lg font-semibold  text-gray-900 sm:p-6">
                            <span>  ما هو بروشور؟  </span>
                            <span x-show="expanded" aria-hidden="true" class="ms-4">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </span>
                            <span x-show="!expanded" aria-hidden="true" class="ms-4">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </span>
                        </button>
                    </h3>
    
                    <div x-show="expanded" x-collapse>
                        <div class="px-6 pb-6">
                            <p class="text-sm lg:text-base text-gray-600">
بروشور هو منصة تساعدك على إنشاء صفحة تجارية مخصصة لمتجرك أو مشروعك، يمكنك تصميمها بنفسك، تعديل الألوان والعناصر، وعرض منتجاتك وخدماتك بطريقة جذابة وسهلة المشاركة.

                            </p>
                        </div>
                    </div>
                </div>
    
                <div
                    x-data="{
                            id: 2,
                            get expanded() {
                                return this.active === this.id
                            },
                            set expanded(value) {
                                this.active = value ? this.id : null
                            },
                        }"
                    role="region"
                >
                    <h3>
                        <button @click="expanded = !expanded" :aria-expanded="expanded" class="flex items-center justify-between w-full px-6 py-5 text-sm lg:text-lg font-semibold  text-gray-900 sm:p-6">
                           
                            <span>   هل أحتاج لأي خبرة تقنية لإنشاء صفحتي؟ </span>
                            <span x-show="expanded" aria-hidden="true" class="ms-4">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </span>
                            <span x-show="!expanded" aria-hidden="true" class="ms-4">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </span>
                        </button>
                    </h3>
    
                    <div x-show="expanded" x-collapse>
                        <div class="px-6 pb-6">
                            <p class="text-sm lg:text-base text-gray-600">
                            لا، المنصة مصممة لتكون سهلة الاستخدام. يمكنك إنشاء صفحتك وتخصيصها خلال دقائق بدون أي معرفة تقنية.
                             </p>
                        </div>
                    </div>
                </div>
    
                <div
                    x-data="{
                            id: 3,
                            get expanded() {
                                return this.active === this.id
                            },
                            set expanded(value) {
                                this.active = value ? this.id : null
                            },
                        }"
                    role="region"
                >
                    <h3>
                        <button @click="expanded = !expanded" :aria-expanded="expanded" class="flex items-center justify-between w-full px-6 py-5 text-sm lg:text-lg font-semibold  text-gray-900 sm:p-6">
                           
                            <span>  هل أحتاج لدفع رسوم لإنشاء الصفحة؟ </span>
                            <span x-show="expanded" aria-hidden="true" class="ms-4">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </span>
                            <span x-show="!expanded" aria-hidden="true" class="ms-4">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </span>
                        </button>
                    </h3>
    
                    <div x-show="expanded" x-collapse>
                        <div class="px-6 pb-6">
                            <p class="text-sm lg:text-base text-gray-600">
                                لا،
                                نقدم خطة أساسية مجانية لإنشاء صفحتك بسرعة. كما توجد خيارات للترقية للاستفادة من مزايا إضافية مثل دومين مخصص وقوالب مخصصة وغيره
                            </p>
                        </div>
                    </div>
                </div>
    
                <div
                    x-data="{
                        id: 4,
                        get expanded() {
                            return this.active === this.id
                        },
                        set expanded(value) {
                            this.active = value ? this.id : null
                        },
                    }"
                    role="region"
                >
                    <h3>
                        <button @click="expanded = !expanded" :aria-expanded="expanded" class="flex items-center justify-between w-full px-6 py-5 text-sm lg:text-lg font-semibold  text-gray-900 sm:p-6">
                            <span> هل أستطيع استخدام رابط ونطاق مخصص لهويتي مثل company.com ؟  </span>
                            <span x-show="expanded" aria-hidden="true" class="ms-4">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </span>
                            <span x-show="!expanded" aria-hidden="true" class="ms-4">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </span>
                        </button>
                    </h3>
    
                    <div x-show="expanded" x-collapse>
                        <div class="px-6 pb-6">
                            <p class="text-sm lg:text-base text-gray-600"> 
                                نعم، في باقة بريميوم
                                يمكنك ربط نطاقك (company.com) للاستخدام في الصفحة بدل 
                                من رابط بروشور الافتراضي.
                            </p>
                        </div>
                    </div>
                </div>
    
                <div
                    x-data="{
                            id: 5,
                            get expanded() {
                                return this.active === this.id
                            },
                            set expanded(value) {
                                this.active = value ? this.id : null
                            },
                        }"
                    role="region"
                >
                    <h3>
                        <button @click="expanded = !expanded" :aria-expanded="expanded" class="flex items-center justify-between w-full px-6 py-5 text-sm lg:text-lg font-semibold  text-gray-900 sm:p-6">
                            <span> ماهي الدول المسموح بها لاستخدام منصة بروشور ؟ </span>
                            <span x-show="expanded" aria-hidden="true" class="ms-4">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </span>
                            <span x-show="!expanded" aria-hidden="true" class="ms-4">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </span>
                        </button>
                    </h3>
    
                    <div x-show="expanded" x-collapse>
                        <div class="px-6 pb-6">
                            <p class="text-sm lg:text-base text-gray-600"> 
                             لا توجد قيود على الدول. يمكنك استخدام منصة بروشور من أي مكان به انترنت.
                             <br>
القيود ستكون عند تعاملك مع شركات الأطراف الخارجية مثل بوابات الدفع والمنصات الأخرى التي تود ربطها في مع بروشور. 

                            </p>
                        </div>
                    </div>
                </div>
            </div>
     
        </div>
    </section>


    <!-- broshur review -->
    {{-- <div class="mt-10">
        <div class="relative mx-auto max-w-6xl">
            <div class="absolute inset-x-10 -top-6 -z-10 h-6 rounded-3xl bg-white shadow-lg ring-1 ring-black/10"></div>
            <div class="absolute inset-x-6 -top-3 -z-10 h-8 rounded-3xl bg-white shadow-lg ring-1 ring-black/10"></div>
            <div class="rounded-3xl bg-white shadow-xl ring-1 ring-black/10 overflow-hidden">
                <div class="border-b border-stone-200 px-4 sm:px-6 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="size-2.5 rounded-full bg-red-400"></span>
                        <span class="size-2.5 rounded-full bg-yellow-400"></span>
                        <span class="size-2.5 rounded-full bg-green-400"></span>
                    </div>
                    <div class="text-xs text-stone-500">February 2023</div>
                    <div class="flex items-center gap-2">
                        <span class="rounded-md bg-stone-100 text-stone-700 text-xs px-2 py-1">Publish</span>
                        <span class="rounded-md bg-stone-100 text-stone-700 text-xs px-2 py-1">Share</span>
                    </div>
                </div>
                <div class="aspect-[16/9] bg-white">
                    <div class="h-full w-full bg-gradient-to-br from-stone-50 to-stone-100"></div>
                </div>
            </div>
        </div>
    </div> --}}


      <div class=" text-center max-w-sm lg:max-w-xl mx-auto">
                <div class=" flex items-center justify-center gap-3">
                    <a href="{{ route('auth.register') }}" wire:navigate class="inline-flex items-center gap-3 rounded-full bg-primary-600 text-white px-3 py-3 text-2xl ps-6 font-semiboldx shadow-sm hover:bg-primary-700">
                        أنشئ صفحتك مجاناً 
                        <ui:icon name="arrow-left" size="10" class="bg-amber-400 rounded-full p-1" />
                    </a>
                </div>
                <p class="mt-2 text-xs text-stone-500/50">خطة مجانية •  أنشئ صفحتك بثواني</p>
        </div>

<footer class="py-12 bg-white mt-32">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    
        <div class="lg:flex lg:items-center lg:justify-between  ">
            <div>
                <img class="w-auto h-8 mx-auto lg:mx-0" src="{{ asset('assets/images/logo.svg') }}" alt="" />
            </div>

            {{-- <ul class="flex items-center justify-center mt-8 gap-x-6 sm:mt-12 sm:gap-x-16 lg:mt-0">
                <li>
                    <a href="{{ route('site.page.about') }}" wire:navigate title="" class="text-sm font-medium text-gray-900 transition-all duration-200 font-pj hover:text-gray-600"> عن {{ config('app.name') }} </a>
                </li>

                <li>
                    <a href="{{ route('site.page.plans') }}" wire:navigate title="" class="text-sm font-medium text-gray-900 transition-all duration-200 font-pj hover:text-gray-600"> الأسعار </a>
                </li>

                <li>
                    <a href="{{ route('site.page.faq') }}" wire:navigate title="" class="text-sm font-medium text-gray-900 transition-all duration-200 font-pj hover:text-gray-600"> الأسئلة المتكررة </a>
                </li>
 

                <li>
                    <a href="{{ route('site.page.contact') }}" wire:navigate title="" class="text-sm font-medium text-gray-900 transition-all duration-200 font-pj hover:text-gray-600"> اتصل بنا </a>
                </li>
            </ul> --}}

            <ul class="flex items-center justify-center mt-8 gap-x-3 sm:mt-12 lg:justify-end lg:mt-0">
                <li>
                    <a href="#" target="_blank" title="" class="inline-flex items-center justify-center w-10 h-10 text-gray-900 transition-all duration-200 rounded-full hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:ring-gray-200" rel="noopener">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M19.633 7.997c.013.175.013.349.013.523 0 5.325-4.053 11.461-11.46 11.461-2.282 0-4.402-.661-6.186-1.809.324.037.636.05.973.05a8.07 8.07 0 0 0 5.001-1.721 4.036 4.036 0 0 1-3.767-2.793c.249.037.499.062.761.062.361 0 .724-.05 1.061-.137a4.027 4.027 0 0 1-3.23-3.953v-.05c.537.299 1.16.486 1.82.511a4.022 4.022 0 0 1-1.796-3.354c0-.748.199-1.434.548-2.032a11.457 11.457 0 0 0 8.306 4.215c-.062-.3-.1-.611-.1-.923a4.026 4.026 0 0 1 4.028-4.028c1.16 0 2.207.486 2.943 1.272a7.957 7.957 0 0 0 2.556-.973 4.02 4.02 0 0 1-1.771 2.22 8.073 8.073 0 0 0 2.319-.624 8.645 8.645 0 0 1-2.019 2.083z"
                            ></path>
                        </svg>
                    </a>
                </li>

                <li>
                    <a href="#" target="_blank" title="" class="inline-flex items-center justify-center w-10 h-10 text-gray-900 transition-all duration-200 rounded-full hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:ring-gray-200" rel="noopener">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path>
                        </svg>
                    </a>
                </li>

                <li>
                    <a href="#" target="_blank" title="" class="inline-flex items-center justify-center w-10 h-10 text-gray-900 transition-all duration-200 rounded-full hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:ring-gray-200" rel="noopener">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.999 7.377a4.623 4.623 0 1 0 0 9.248 4.623 4.623 0 0 0 0-9.248zm0 7.627a3.004 3.004 0 1 1 0-6.008 3.004 3.004 0 0 1 0 6.008z"></path>
                            <circle cx="16.806" cy="7.207" r="1.078"></circle>
                            <path
                                d="M20.533 6.111A4.605 4.605 0 0 0 17.9 3.479a6.606 6.606 0 0 0-2.186-.42c-.963-.042-1.268-.054-3.71-.054s-2.755 0-3.71.054a6.554 6.554 0 0 0-2.184.42 4.6 4.6 0 0 0-2.633 2.632 6.585 6.585 0 0 0-.419 2.186c-.043.962-.056 1.267-.056 3.71 0 2.442 0 2.753.056 3.71.015.748.156 1.486.419 2.187a4.61 4.61 0 0 0 2.634 2.632 6.584 6.584 0 0 0 2.185.45c.963.042 1.268.055 3.71.055s2.755 0 3.71-.055a6.615 6.615 0 0 0 2.186-.419 4.613 4.613 0 0 0 2.633-2.633c.263-.7.404-1.438.419-2.186.043-.962.056-1.267.056-3.71s0-2.753-.056-3.71a6.581 6.581 0 0 0-.421-2.217zm-1.218 9.532a5.043 5.043 0 0 1-.311 1.688 2.987 2.987 0 0 1-1.712 1.711 4.985 4.985 0 0 1-1.67.311c-.95.044-1.218.055-3.654.055-2.438 0-2.687 0-3.655-.055a4.96 4.96 0 0 1-1.669-.311 2.985 2.985 0 0 1-1.719-1.711 5.08 5.08 0 0 1-.311-1.669c-.043-.95-.053-1.218-.053-3.654 0-2.437 0-2.686.053-3.655a5.038 5.038 0 0 1 .311-1.687c.305-.789.93-1.41 1.719-1.712a5.01 5.01 0 0 1 1.669-.311c.951-.043 1.218-.055 3.655-.055s2.687 0 3.654.055a4.96 4.96 0 0 1 1.67.311 2.991 2.991 0 0 1 1.712 1.712 5.08 5.08 0 0 1 .311 1.669c.043.951.054 1.218.054 3.655 0 2.436 0 2.698-.043 3.654h-.011z"
                            ></path>
                        </svg>
                    </a>
                </li>
 
            </ul>
        </div>

        <hr class="mt-10 border-gray-200/75" />

        <div class="mt-10 md:flex md:items-center md:justify-between">
            <ul class="flex items-center justify-center gap-x-6 md:order-2 md:justify-end">
                <li>
                    <a href="{{ route('site.page.terms') }}" wire:navigate title="" class="text-xs font-normal text-gray-600 transition-all duration-200 font-pj hover:text-gray-900"> الشروط والأحكام </a>
                </li>

                {{-- <li>
                    <a href="{{ route('site.page.privacy') }}" wire:navigate title="" class="text-xs font-normal text-gray-600 transition-all duration-200 font-pj hover:text-gray-900"> الخصوصية </a>
                </li> --}}
            </ul>

            <p class="mt-8 text-sm font-normal text-center text-gray-600 md:text-left md:mt-0 md:order-1 font-pj">© الحقوق محفوظة {{ date('Y') }} </p>
        </div>
    </div>
</footer>

</div>

<?php 
 
new 
#[\Livewire\Attributes\Title('أنشئ بروشور لأعمالك، يبيع عنّك بدقائق!')]
class extends \Livewire\Volt\Component {
     
}; ?>
