<template>
<nav class="bg-white pt-1x">
        <div class="flex items-center gap-x-px font-semibold max-w-7xl justify-between lg:justify-start overflow-x-auto mx-auto px-px lg:px-0 divide-x-reverse divide-xXX divide-base-400/20 [&amp;::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
        
            <RouterLink :to="{ name: 'home' }" title="" class="flex flex-col md:flex-row w-full px-2 lg:py-3 py-2 gap-2 items-center justify-center lg:w-auto lg:px-5 lg:shrink" activeClass="bg-base-200">
                <svg viewBox="0 0 24 24"  class="md:size-7 size-10" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z" fill="#1C274C"></path> <path d="M9 17.25C8.58579 17.25 8.25 17.5858 8.25 18C8.25 18.4142 8.58579 18.75 9 18.75H15C15.4142 18.75 15.75 18.4142 15.75 18C15.75 17.5858 15.4142 17.25 15 17.25H9Z" fill="#1C274C"></path> </g></svg>
                <span class="text-xs block md:hidden font-thin md:font-normal">
                    الرئيسية
                </span>
            </RouterLink>
        
            <RouterLink :to="{ name: 'content' }" title="" class="flex flex-col md:flex-row w-full px-2 lg:py-3 py-2 gap-2 items-center justify-center lg:w-auto lg:px-5 lg:shrink" activeClass="bg-base-200">
                <svg viewBox="0 0 24 24" class="md:size-7 size-10" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.87868 2.87868C5 3.75736 5 5.17157 5 8V16C5 18.8284 5 20.2426 5.87868 21.1213C6.75736 22 8.17157 22 11 22H13C15.8284 22 17.2426 22 18.1213 21.1213C19 20.2426 19 18.8284 19 16V8C19 5.17157 19 3.75736 18.1213 2.87868C17.2426 2 15.8284 2 13 2H11C8.17157 2 6.75736 2 5.87868 2.87868ZM8.25 17C8.25 16.5858 8.58579 16.25 9 16.25H12C12.4142 16.25 12.75 16.5858 12.75 17C12.75 17.4142 12.4142 17.75 12 17.75H9C8.58579 17.75 8.25 17.4142 8.25 17ZM9 12.25C8.58579 12.25 8.25 12.5858 8.25 13C8.25 13.4142 8.58579 13.75 9 13.75H15C15.4142 13.75 15.75 13.4142 15.75 13C15.75 12.5858 15.4142 12.25 15 12.25H9ZM8.25 9C8.25 8.58579 8.58579 8.25 9 8.25H15C15.4142 8.25 15.75 8.58579 15.75 9C15.75 9.41421 15.4142 9.75 15 9.75H9C8.58579 9.75 8.25 9.41421 8.25 9Z" fill="#1C274C"></path> <path opacity="0.5" d="M5.23525 4.05811C5 4.94139 5 6.17689 5 7.99985V15.9999C5 17.8229 5 19.0584 5.23527 19.9417L5 19.9238C4.02491 19.8279 3.36857 19.6111 2.87868 19.1212C2 18.2425 2 16.8283 2 13.9999V9.99991C2 7.17148 2 5.75726 2.87868 4.87859C3.36857 4.3887 4.02491 4.17194 5 4.07602L5.23525 4.05811Z" fill="#1C274C"></path> <path opacity="0.5" d="M18.7646 19.9417C18.9999 19.0584 18.9999 17.8229 18.9999 15.9999V7.99985C18.9999 6.17689 18.9999 4.94139 18.7647 4.05811L18.9999 4.07602C19.975 4.17194 20.6314 4.3887 21.1212 4.87859C21.9999 5.75726 21.9999 7.17148 21.9999 9.99991V13.9999C21.9999 16.8283 21.9999 18.2425 21.1212 19.1212C20.6314 19.6111 19.975 19.8279 18.9999 19.9238L18.7646 19.9417Z" fill="#1C274C"></path> </g></svg>

                <span class="text-sm hidden md:block">
                    محتوى الصفحة
                </span>
                <span class="text-xs block md:hidden font-thin md:font-normal">
                    المحتوى
                </span>
            </RouterLink>

            <RouterLink :to="{ name: 'design' }" title="" class="flex flex-col md:flex-row w-full px-2 lg:py-3 py-2 gap-2 items-center justify-center lg:w-auto lg:px-5 lg:shrink" activeClass="bg-base-200">
                 
                <svg viewBox="0 0 24 24" class="md:size-7 size-10" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7 18C7 18.5523 6.55228 19 6 19C5.44772 19 5 18.5523 5 18C5 17.4477 5.44772 17 6 17C6.55228 17 7 17.4477 7 18Z" fill="#1C274C"></path> <path opacity="0.4" d="M10 6V18C10 20.2091 8.20914 22 6 22C3.79086 22 2 20.2091 2 18V6C2 3.79086 3.79086 2 6 2C8.20914 2 10 3.79086 10 6Z" fill="#1C274C"></path> <path opacity="0.7" d="M9.24756 20.3357L13.2218 16.3614L19.0599 10.2719C20.5819 8.68438 20.5554 6.17138 19.0003 4.61629C17.4218 3.03773 14.8624 3.03773 13.2838 4.61629L10 7.90015V18C10 18.8718 9.72106 19.6786 9.24756 20.3357Z" fill="#1C274C"></path> <path d="M13.2218 16.3617L9.24756 20.336C9.72014 19.6801 9.99891 18.8752 10 18.0053C9.99711 20.212 8.20736 22 6 22H17.8994C20.1086 22 21.8994 20.2091 21.8994 18C21.8994 15.7909 20.1086 14 17.8994 14H15.486L13.2218 16.3617Z" fill="#1C274C"></path> </g></svg>  
                <span class="md:text-sm text-xs font-thin md:font-normal">
                    التصميم
                </span>
            </RouterLink>

            <RouterLink :to="{ name: 'share' }" title="" class="flex flex-col md:flex-row w-full px-2 lg:py-3 py-2 gap-2 items-center justify-center lg:w-auto lg:px-5 lg:shrink" activeClass="bg-base-200">
                
                <svg viewBox="0 0 24 24" class="md:size-7 size-10" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M8.14114 4.5C8 5.34287 8 6.46249 8 8V16C8 17.5375 8 18.6571 8.14114 19.5H8C5.64298 19.5 4.46447 19.5 3.73223 18.7678C3 18.0355 3 16.857 3 14.5V9.5C3 7.14298 3 5.96447 3.73223 5.23223C4.46447 4.5 5.64298 4.5 8 4.5H8.14114Z" fill="#1C274C"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M8.87868 2.87868C8 3.75736 8 5.17157 8 8V16C8 18.8284 8 20.2426 8.87868 21.1213C9.75736 22 11.1716 22 14 22H15C17.8284 22 19.2426 22 20.1213 21.1213C21 20.2426 21 18.8284 21 16V8C21 5.17157 21 3.75736 20.1213 2.87868C19.2426 2 17.8284 2 15 2H14C11.1716 2 9.75736 2 8.87868 2.87868ZM15.0303 7.46967C14.7374 7.17678 14.2626 7.17678 13.9697 7.46967L11.4697 9.96967C11.1768 10.2626 11.1768 10.7374 11.4697 11.0303C11.7626 11.3232 12.2374 11.3232 12.5303 11.0303L13.75 9.81066V16C13.75 16.4142 14.0858 16.75 14.5 16.75C14.9142 16.75 15.25 16.4142 15.25 16V9.81066L16.4697 11.0303C16.7626 11.3232 17.2374 11.3232 17.5303 11.0303C17.8232 10.7374 17.8232 10.2626 17.5303 9.96967L15.0303 7.46967Z" fill="#1C274C"></path> </g></svg>
                <span class="text-sm hidden md:block">
                    نشر ومشاركة 
                </span>
                <span class="text-xs block md:hidden font-thin">
                    نشر
                </span>
            </RouterLink>

            <RouterLink :to="{ name: 'settings' }" title="" class="flex flex-col md:flex-row w-full px-2 lg:py-3 py-2 gap-2 items-center justify-center lg:w-auto lg:px-5 lg:shrink" activeClass="bg-base-200">
                
                <svg viewBox="0 0 24 24" class="md:size-7 size-10" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M14.2788 2.15224C13.9085 2 13.439 2 12.5 2C11.561 2 11.0915 2 10.7212 2.15224C10.2274 2.35523 9.83509 2.74458 9.63056 3.23463C9.53719 3.45834 9.50065 3.7185 9.48635 4.09799C9.46534 4.65568 9.17716 5.17189 8.69017 5.45093C8.20318 5.72996 7.60864 5.71954 7.11149 5.45876C6.77318 5.2813 6.52789 5.18262 6.28599 5.15102C5.75609 5.08178 5.22018 5.22429 4.79616 5.5472C4.47814 5.78938 4.24339 6.1929 3.7739 6.99993C3.30441 7.80697 3.06967 8.21048 3.01735 8.60491C2.94758 9.1308 3.09118 9.66266 3.41655 10.0835C3.56506 10.2756 3.77377 10.437 4.0977 10.639C4.57391 10.936 4.88032 11.4419 4.88029 12C4.88026 12.5581 4.57386 13.0639 4.0977 13.3608C3.77372 13.5629 3.56497 13.7244 3.41645 13.9165C3.09108 14.3373 2.94749 14.8691 3.01725 15.395C3.06957 15.7894 3.30432 16.193 3.7738 17C4.24329 17.807 4.47804 18.2106 4.79606 18.4527C5.22008 18.7756 5.75599 18.9181 6.28589 18.8489C6.52778 18.8173 6.77305 18.7186 7.11133 18.5412C7.60852 18.2804 8.2031 18.27 8.69012 18.549C9.17714 18.8281 9.46533 19.3443 9.48635 19.9021C9.50065 20.2815 9.53719 20.5417 9.63056 20.7654C9.83509 21.2554 10.2274 21.6448 10.7212 21.8478C11.0915 22 11.561 22 12.5 22C13.439 22 13.9085 22 14.2788 21.8478C14.7726 21.6448 15.1649 21.2554 15.3694 20.7654C15.4628 20.5417 15.4994 20.2815 15.5137 19.902C15.5347 19.3443 15.8228 18.8281 16.3098 18.549C16.7968 18.2699 17.3914 18.2804 17.8886 18.5412C18.2269 18.7186 18.4721 18.8172 18.714 18.8488C19.2439 18.9181 19.7798 18.7756 20.2038 18.4527C20.5219 18.2105 20.7566 17.807 21.2261 16.9999C21.6956 16.1929 21.9303 15.7894 21.9827 15.395C22.0524 14.8691 21.9088 14.3372 21.5835 13.9164C21.4349 13.7243 21.2262 13.5628 20.9022 13.3608C20.4261 13.0639 20.1197 12.558 20.1197 11.9999C20.1197 11.4418 20.4261 10.9361 20.9022 10.6392C21.2263 10.4371 21.435 10.2757 21.5836 10.0835C21.9089 9.66273 22.0525 9.13087 21.9828 8.60497C21.9304 8.21055 21.6957 7.80703 21.2262 7C20.7567 6.19297 20.522 5.78945 20.2039 5.54727C19.7799 5.22436 19.244 5.08185 18.7141 5.15109C18.4722 5.18269 18.2269 5.28136 17.8887 5.4588C17.3915 5.71959 16.7969 5.73002 16.3099 5.45096C15.8229 5.17191 15.5347 4.65566 15.5136 4.09794C15.4993 3.71848 15.4628 3.45833 15.3694 3.23463C15.1649 2.74458 14.7726 2.35523 14.2788 2.15224Z" fill="#1C274C"></path> <path d="M15.5227 12C15.5227 13.6569 14.1694 15 12.4999 15C10.8304 15 9.47705 13.6569 9.47705 12C9.47705 10.3431 10.8304 9 12.4999 9C14.1694 9 15.5227 10.3431 15.5227 12Z" fill="#1C274C"></path> </g></svg>

                <span class="md:text-sm text-xs font-thin md:font-normal">
                    الإعدادات
                </span>
            </RouterLink>
    
        </div>
    </nav>
</template>

<script setup>

</script>