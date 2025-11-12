<div>
    <x-admin::notify />
    <ui:navbar wire:ignore container="max-w-7xl" class="!bg-purple-700 bg-gradient-to-r from-primary-900 via-primary-800 to-indigo-700 !p-3 text-white">
    {{-- <ui:navbar wire:ignore container="max-w-7xl" class="!bg-[#030637] bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-[#030637] via-[#3c0753] to-[#720455]/50 !p-3 text-white"> --}}
    {{-- <ui:navbar wire:ignore class="!bg-primary-900 !p-2 text-white"> --}}
    {{-- <ui:navbar wire:ignore class="bg-gradient-to-r from-blue-800 via-cyan-700 to-blue-900  !p-2 text-white"> --}}
    {{-- <ui:navbar wire:ignore class="bg-[conic-gradient(at_top_left,_var(--tw-gradient-stops))] from-[#202040] via-[#543864] to-[#ff6363] !p-2 text-white"> --}}
        {{-- <ui:brand href="{{ route('admin.home') }}" wire:navigate logo="{{data_get(currentTenant(), 'logo')}}" name="{{data_get(currentTenant(), 'name')}}" Xsubtitle="{{ config('app.domain') }}" size="7"  /> --}}
        <ui:brand href="{{ route('admin.home') }}" wire:navigate logo="{{ asset('assets/images/logo-shape-white.svg') }}"  size="6" iconClass="!w-auto" />
        <ui:brand href="{{ route('admin.home') }}" wire:navigate logo="{{ asset('assets/images/broshur-logo-shape.webp') }}"  size="6" iconClass="!w-auto" />
 
        <a href="{{ route('admin.orders.index') }}" wire:navigate title="" class="shrink-0 ms-12 justify-center flex items-center gap-x-2 text-white p-1 px-2 rounded-lg " wire:current="bg-black/40">
            {{-- <ui:icon name="message-2" size="6" /> --}}
            <svg viewBox="0 0 24 24" class="size-5 text-white" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M22 10.5V12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2H13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> <circle cx="19" cy="5" r="3" stroke="currentColor" stroke-width="1.5"></circle> <path d="M7 14H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> <path d="M7 17.5H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
            <span class="text-sm hidden lg:block">
                التفاعل والطلبات
            </span>
            <span class="text-sm block lg:hidden">
                الطلبات
            </span>
        </a>

        <x-slot name="end">
            <ui:button variant="ghost" class="text-white !hidden !lg:block !bg-green-600 !hover:bg-green-700" wire:current="!bg-white/10" href="{{ tenant('storeFrontUrl') }}" target="_blank" icon:trailing="arrow-up-left" icon="link" label="معاينة البروشور" /> 
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
                {{-- <ui:icon name="file-text" size="6" /> --}}
                {{-- <svg class="size-6" viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg" transform="matrix(1, 0, 0, -1, 0, 0)rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15.3929 4.05365L14.8912 4.61112L15.3929 4.05365ZM19.3517 7.61654L18.85 8.17402L19.3517 7.61654ZM21.654 10.1541L20.9689 10.4592V10.4592L21.654 10.1541ZM3.17157 20.8284L3.7019 20.2981H3.7019L3.17157 20.8284ZM20.8284 20.8284L20.2981 20.2981L20.2981 20.2981L20.8284 20.8284ZM14 21.25H10V22.75H14V21.25ZM2.75 14V10H1.25V14H2.75ZM21.25 13.5629V14H22.75V13.5629H21.25ZM14.8912 4.61112L18.85 8.17402L19.8534 7.05907L15.8947 3.49618L14.8912 4.61112ZM22.75 13.5629C22.75 11.8745 22.7651 10.8055 22.3391 9.84897L20.9689 10.4592C21.2349 11.0565 21.25 11.742 21.25 13.5629H22.75ZM18.85 8.17402C20.2034 9.3921 20.7029 9.86199 20.9689 10.4592L22.3391 9.84897C21.9131 8.89241 21.1084 8.18853 19.8534 7.05907L18.85 8.17402ZM10.0298 2.75C11.6116 2.75 12.2085 2.76158 12.7405 2.96573L13.2779 1.5653C12.4261 1.23842 11.498 1.25 10.0298 1.25V2.75ZM15.8947 3.49618C14.8087 2.51878 14.1297 1.89214 13.2779 1.5653L12.7405 2.96573C13.2727 3.16993 13.7215 3.55836 14.8912 4.61112L15.8947 3.49618ZM10 21.25C8.09318 21.25 6.73851 21.2484 5.71085 21.1102C4.70476 20.975 4.12511 20.7213 3.7019 20.2981L2.64124 21.3588C3.38961 22.1071 4.33855 22.4392 5.51098 22.5969C6.66182 22.7516 8.13558 22.75 10 22.75V21.25ZM1.25 14C1.25 15.8644 1.24841 17.3382 1.40313 18.489C1.56076 19.6614 1.89288 20.6104 2.64124 21.3588L3.7019 20.2981C3.27869 19.8749 3.02502 19.2952 2.88976 18.2892C2.75159 17.2615 2.75 15.9068 2.75 14H1.25ZM14 22.75C15.8644 22.75 17.3382 22.7516 18.489 22.5969C19.6614 22.4392 20.6104 22.1071 21.3588 21.3588L20.2981 20.2981C19.8749 20.7213 19.2952 20.975 18.2892 21.1102C17.2615 21.2484 15.9068 21.25 14 21.25V22.75ZM21.25 14C21.25 15.9068 21.2484 17.2615 21.1102 18.2892C20.975 19.2952 20.7213 19.8749 20.2981 20.2981L21.3588 21.3588C22.1071 20.6104 22.4392 19.6614 22.5969 18.489C22.7516 17.3382 22.75 15.8644 22.75 14H21.25ZM2.75 10C2.75 8.09318 2.75159 6.73851 2.88976 5.71085C3.02502 4.70476 3.27869 4.12511 3.7019 3.7019L2.64124 2.64124C1.89288 3.38961 1.56076 4.33855 1.40313 5.51098C1.24841 6.66182 1.25 8.13558 1.25 10H2.75ZM10.0298 1.25C8.15538 1.25 6.67442 1.24842 5.51887 1.40307C4.34232 1.56054 3.39019 1.8923 2.64124 2.64124L3.7019 3.7019C4.12453 3.27928 4.70596 3.02525 5.71785 2.88982C6.75075 2.75158 8.11311 2.75 10.0298 2.75V1.25Z" fill="#1C274C"></path> <path opacity="0.5" d="M6 14.5H14" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M6 18H11.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M13 2.5V5C13 7.35702 13 8.53553 13.7322 9.26777C14.4645 10 15.643 10 18 10H22" stroke="#1C274C" stroke-width="1.5"></path> </g></svg> --}}
                <svg viewBox="0 0 24 24" class="size-7" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M2 6.94975C2 6.06722 2 5.62595 2.06935 5.25839C2.37464 3.64031 3.64031 2.37464 5.25839 2.06935C5.62595 2 6.06722 2 6.94975 2C7.33642 2 7.52976 2 7.71557 2.01738C8.51665 2.09229 9.27652 2.40704 9.89594 2.92051C10.0396 3.03961 10.1763 3.17633 10.4497 3.44975L11 4C11.8158 4.81578 12.2237 5.22367 12.7121 5.49543C12.9804 5.64471 13.2651 5.7626 13.5604 5.84678C14.0979 6 14.6747 6 15.8284 6H16.2021C18.8345 6 20.1506 6 21.0062 6.76946C21.0849 6.84024 21.1598 6.91514 21.2305 6.99383C22 7.84935 22 9.16554 22 11.7979V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V6.94975Z" fill="#1C274C"></path> <path d="M20 6.23751C19.9992 5.94016 19.9949 5.76263 19.9746 5.60842C19.7974 4.26222 18.7381 3.2029 17.3919 3.02567C17.1969 3 16.9647 3 16.5003 3H9.98828C10.1042 3.10392 10.2347 3.23445 10.45 3.44975L11.0003 4C11.8161 4.81578 12.2239 5.22367 12.7124 5.49543C12.9807 5.64471 13.2653 5.7626 13.5606 5.84678C14.0982 6 14.675 6 15.8287 6H16.2024C17.9814 6 19.1593 6 20 6.23751Z" fill="#1C274C"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.25 10C12.25 9.58579 12.5858 9.25 13 9.25H18C18.4142 9.25 18.75 9.58579 18.75 10C18.75 10.4142 18.4142 10.75 18 10.75H13C12.5858 10.75 12.25 10.4142 12.25 10Z" fill="#1C274C"></path> </g></svg>
                <span class="text-sm hidden lg:block">
                    محتوى الصفحة
                </span>
                <span class="text-sm block lg:hidden">
                    المحتوى
                </span>
            </a>

            <a href="{{ route('admin.design') }}" wire:navigate title="" class="lg:w-fullX xshrink-0 lg:shrink justify-center flex items-center w-full lg:w-auto gap-x-2 lg:px-5 px-2 py-3" wire:current="bg-gray-200">
                {{-- <ui:icon name="palette" size="6" /> --}}
                {{-- <svg viewBox="0 0 24 24" class="size-6" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 12.0261C2 17.1723 5.86713 21.413 10.8468 21.9863C11.5816 22.0709 12.2938 21.7576 12.8168 21.2333C13.4703 20.5781 13.4703 19.5159 12.8168 18.8607C12.2938 18.3364 11.8674 17.5541 12.2619 16.9268C13.8385 14.4192 22 20.178 22 12.0261C22 6.48884 17.5228 2 12 2C6.47715 2 2 6.48884 2 12.0261Z" stroke="#1C274C" stroke-width="1.5"></path> <circle opacity="0.5" cx="17.5" cy="11.5" r="1.5" stroke="#1C274C" stroke-width="1.5"></circle> <circle opacity="0.5" cx="6.5" cy="11.5" r="1.5" stroke="#1C274C" stroke-width="1.5"></circle> <path opacity="0.5" d="M11 6.99976C11 7.82818 10.3284 8.49976 9.5 8.49976C8.67157 8.49976 8 7.82818 8 6.99976C8 6.17133 8.67157 5.49976 9.5 5.49976C10.3284 5.49976 11 6.17133 11 6.99976Z" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M16 7C16 7.82843 15.3284 8.5 14.5 8.5C13.6716 8.5 13 7.82843 13 7C13 6.17157 13.6716 5.5 14.5 5.5C15.3284 5.5 16 6.17157 16 7Z" stroke="#1C274C" stroke-width="1.5"></path> </g></svg> --}}
                <svg viewBox="0 0 24 24" class="size-7" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7 18C7 18.5523 6.55228 19 6 19C5.44772 19 5 18.5523 5 18C5 17.4477 5.44772 17 6 17C6.55228 17 7 17.4477 7 18Z" fill="#1C274C"></path> <path opacity="0.4" d="M10 6V18C10 20.2091 8.20914 22 6 22C3.79086 22 2 20.2091 2 18V6C2 3.79086 3.79086 2 6 2C8.20914 2 10 3.79086 10 6Z" fill="#1C274C"></path> <path opacity="0.7" d="M9.24756 20.3357L13.2218 16.3614L19.0599 10.2719C20.5819 8.68438 20.5554 6.17138 19.0003 4.61629C17.4218 3.03773 14.8624 3.03773 13.2838 4.61629L10 7.90015V18C10 18.8718 9.72106 19.6786 9.24756 20.3357Z" fill="#1C274C"></path> <path d="M13.2218 16.3617L9.24756 20.336C9.72014 19.6801 9.99891 18.8752 10 18.0053C9.99711 20.212 8.20736 22 6 22H17.8994C20.1086 22 21.8994 20.2091 21.8994 18C21.8994 15.7909 20.1086 14 17.8994 14H15.486L13.2218 16.3617Z" fill="#1C274C"></path> </g></svg>  
                <span class="text-sm">
                    التصميم
                </span>
            </a>

            <a href="{{ route('admin.share') }}" wire:navigate title="" class="lg:w-fullX xshrink-0 lg:shrink justify-center flex items-center w-full lg:w-auto gap-x-2 lg:px-5 px-2 py-3" wire:current="bg-gray-200">
                {{-- <ui:icon name="share" size="6" /> --}}
                <svg viewBox="0 0 24 24" class="size-7" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M8.14114 4.5C8 5.34287 8 6.46249 8 8V16C8 17.5375 8 18.6571 8.14114 19.5H8C5.64298 19.5 4.46447 19.5 3.73223 18.7678C3 18.0355 3 16.857 3 14.5V9.5C3 7.14298 3 5.96447 3.73223 5.23223C4.46447 4.5 5.64298 4.5 8 4.5H8.14114Z" fill="#1C274C"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M8.87868 2.87868C8 3.75736 8 5.17157 8 8V16C8 18.8284 8 20.2426 8.87868 21.1213C9.75736 22 11.1716 22 14 22H15C17.8284 22 19.2426 22 20.1213 21.1213C21 20.2426 21 18.8284 21 16V8C21 5.17157 21 3.75736 20.1213 2.87868C19.2426 2 17.8284 2 15 2H14C11.1716 2 9.75736 2 8.87868 2.87868ZM15.0303 7.46967C14.7374 7.17678 14.2626 7.17678 13.9697 7.46967L11.4697 9.96967C11.1768 10.2626 11.1768 10.7374 11.4697 11.0303C11.7626 11.3232 12.2374 11.3232 12.5303 11.0303L13.75 9.81066V16C13.75 16.4142 14.0858 16.75 14.5 16.75C14.9142 16.75 15.25 16.4142 15.25 16V9.81066L16.4697 11.0303C16.7626 11.3232 17.2374 11.3232 17.5303 11.0303C17.8232 10.7374 17.8232 10.2626 17.5303 9.96967L15.0303 7.46967Z" fill="#1C274C"></path> </g></svg>
                <span class="text-sm hidden lg:block">
                    نشر ومشاركة 
                </span>
                <span class="text-sm block lg:hidden">
                    نشر
                </span>
            </a>

            <a href="{{ route('admin.settings.index') }}" wire:navigate title="" class="lg:w-fullX xshrink-0 lg:shrink justify-center flex items-center w-full lg:w-auto gap-x-2 lg:px-5 px-2 py-3" wire:current="bg-gray-200">
                {{-- <ui:icon name="settings" size="6" /> --}}
                <svg viewBox="0 0 24 24" class="size-7" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M14.2788 2.15224C13.9085 2 13.439 2 12.5 2C11.561 2 11.0915 2 10.7212 2.15224C10.2274 2.35523 9.83509 2.74458 9.63056 3.23463C9.53719 3.45834 9.50065 3.7185 9.48635 4.09799C9.46534 4.65568 9.17716 5.17189 8.69017 5.45093C8.20318 5.72996 7.60864 5.71954 7.11149 5.45876C6.77318 5.2813 6.52789 5.18262 6.28599 5.15102C5.75609 5.08178 5.22018 5.22429 4.79616 5.5472C4.47814 5.78938 4.24339 6.1929 3.7739 6.99993C3.30441 7.80697 3.06967 8.21048 3.01735 8.60491C2.94758 9.1308 3.09118 9.66266 3.41655 10.0835C3.56506 10.2756 3.77377 10.437 4.0977 10.639C4.57391 10.936 4.88032 11.4419 4.88029 12C4.88026 12.5581 4.57386 13.0639 4.0977 13.3608C3.77372 13.5629 3.56497 13.7244 3.41645 13.9165C3.09108 14.3373 2.94749 14.8691 3.01725 15.395C3.06957 15.7894 3.30432 16.193 3.7738 17C4.24329 17.807 4.47804 18.2106 4.79606 18.4527C5.22008 18.7756 5.75599 18.9181 6.28589 18.8489C6.52778 18.8173 6.77305 18.7186 7.11133 18.5412C7.60852 18.2804 8.2031 18.27 8.69012 18.549C9.17714 18.8281 9.46533 19.3443 9.48635 19.9021C9.50065 20.2815 9.53719 20.5417 9.63056 20.7654C9.83509 21.2554 10.2274 21.6448 10.7212 21.8478C11.0915 22 11.561 22 12.5 22C13.439 22 13.9085 22 14.2788 21.8478C14.7726 21.6448 15.1649 21.2554 15.3694 20.7654C15.4628 20.5417 15.4994 20.2815 15.5137 19.902C15.5347 19.3443 15.8228 18.8281 16.3098 18.549C16.7968 18.2699 17.3914 18.2804 17.8886 18.5412C18.2269 18.7186 18.4721 18.8172 18.714 18.8488C19.2439 18.9181 19.7798 18.7756 20.2038 18.4527C20.5219 18.2105 20.7566 17.807 21.2261 16.9999C21.6956 16.1929 21.9303 15.7894 21.9827 15.395C22.0524 14.8691 21.9088 14.3372 21.5835 13.9164C21.4349 13.7243 21.2262 13.5628 20.9022 13.3608C20.4261 13.0639 20.1197 12.558 20.1197 11.9999C20.1197 11.4418 20.4261 10.9361 20.9022 10.6392C21.2263 10.4371 21.435 10.2757 21.5836 10.0835C21.9089 9.66273 22.0525 9.13087 21.9828 8.60497C21.9304 8.21055 21.6957 7.80703 21.2262 7C20.7567 6.19297 20.522 5.78945 20.2039 5.54727C19.7799 5.22436 19.244 5.08185 18.7141 5.15109C18.4722 5.18269 18.2269 5.28136 17.8887 5.4588C17.3915 5.71959 16.7969 5.73002 16.3099 5.45096C15.8229 5.17191 15.5347 4.65566 15.5136 4.09794C15.4993 3.71848 15.4628 3.45833 15.3694 3.23463C15.1649 2.74458 14.7726 2.35523 14.2788 2.15224Z" fill="#1C274C"></path> <path d="M15.5227 12C15.5227 13.6569 14.1694 15 12.4999 15C10.8304 15 9.47705 13.6569 9.47705 12C9.47705 10.3431 10.8304 9 12.4999 9C14.1694 9 15.5227 10.3431 15.5227 12Z" fill="#1C274C"></path> </g></svg>

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


