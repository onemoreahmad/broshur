<template>
<div class="lg:py-2 py-1.5 px-1.5 xl:px-0 !bg-purple-700 bg-gradient-to-l from-gray-900 via-indigo-800 to-blue-900 text-white" wire:ignore="">
   <div class="max-w-7xl mx-auto flex items-center justify-between gap-x-2">
      <div class="flex items-center">
         <RouterLink :to="{ name: 'home' }" class="inline-flex items-center gap-2">
            <img src="/assets/images/broshur-logo-shape.webp" alt="" class="size-6 lg:w-auto w-6 hidden md:block">

            <!-- <img src="/assets/images/logo-white-0.webp" alt="" class="size-6 !w-auto hidden md:block"> -->
         </RouterLink>
         <div class="mx-2 bg-white/20 h-8 rounded-full w-px hidden md:block">   </div> 
            <div class="flex items-center lg:gap-x-2 gap-x-1.5">
               <RouterLink :to="{ name: 'home' }">
                  <img :src="currentUser?.tenant?.logo" alt="" class="size-10  lg:w-auto w-10 rounded-md ">
               </RouterLink>
               <div class="lg:text-sm text-xs flex flex-col truncate">
                  <RouterLink :to="{ name: 'home' }" >{{ currentUser?.tenant?.name }} </RouterLink>
                  <span class="lg:text-xs text-xs text-yellow-400 font-thin mt-0.5">
                     <RouterLink :to="{ name: 'subscription' }" class="!text-xs inline-flex items-center gap-x-2 bg-blue-600 hover:bg-blue-700 text-white lg:px-2 px-1.5 lg:py-0.5 py-1 rounded-md font-thin">
                        <svg viewBox="0 0 24 24" class="size-4" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.609 13.5616L21.8382 11.1263C22.0182 9.2137 22.1082 8.25739 21.781 7.86207C21.604 7.64823 21.3633 7.5172 21.106 7.4946C20.6303 7.45282 20.0329 8.1329 18.8381 9.49307C18.2202 10.1965 17.9113 10.5482 17.5666 10.6027C17.3757 10.6328 17.1811 10.6018 17.0047 10.5131C16.6865 10.3529 16.4743 9.91812 16.0499 9.04851L13.8131 4.46485C13.0112 2.82162 12.6102 2 12 2C11.3898 2 10.9888 2.82162 10.1869 4.46486L7.95007 9.04852C7.5257 9.91812 7.31351 10.3529 6.99526 10.5131C6.81892 10.6018 6.62434 10.6328 6.43337 10.6027C6.08872 10.5482 5.77977 10.1965 5.16187 9.49307C3.96708 8.1329 3.36968 7.45282 2.89399 7.4946C2.63666 7.5172 2.39598 7.64823 2.21899 7.86207C1.8918 8.25739 1.9818 9.2137 2.16181 11.1263L2.391 13.5616C2.76865 17.5742 2.95748 19.5805 4.14009 20.7902C5.32271 22 7.09517 22 10.6401 22H13.3599C16.9048 22 18.6773 22 19.8599 20.7902C21.0425 19.5805 21.2313 17.5742 21.609 13.5616Z" stroke="currentColor" stroke-width="1.5"></path> <path opacity="0.5" d="M9 18H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>

                        {{ currentUser?.tenant?.plan?.label }} 
                     </RouterLink>
                  </span>
               </div> 
            </div>
         <!---<RouterLink :to="{ name: 'orders' }"  title="الطلبات" class="text-white flex p-1 px-2 gap-x-2 items-center justify-center shrink-0 rounded-lg ms-4 lg:ms-8" activeClass="bg-black/40">
            <svg viewBox="0 0 24 24" class="size-5 text-white" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M22 10.5V12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2H13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> <circle cx="19" cy="5" r="3" stroke="currentColor" stroke-width="1.5"></circle> <path d="M7 14H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> <path d="M7 17.5H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
            <span class="text-sm hidden lg:block">
               الطلبات والتفاعل
            </span>
            <span class="text-sm block lg:hidden">
               الطلبات
            </span>
         </RouterLink>-->
      </div>

      <div class="flex items-center gap-4">
         <a :href="currentUser?.tenant?.storefront_url" target="_blank"  class="btn btn-primary btn-sm flex items-center gap-x-3">
            <span class="text-sm hidden lg:flex">
               معاينة الصفحة
            </span>
            <span class="text-sm flex lg:hidden">
               معاينة 
            </span>
            <svg viewBox="0 0 24 24" fill="none" class="size-5 -rotate-90" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M13 11L22 2M22 2H16.6562M22 2V7.34375" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="0.5" d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>

         </a>
   

         <!--<div class="dropdown dropdown-bottom dropdown-end">
            <div tabindex="0" role="button" class="cursor-pointer flex items-center gap-x-2">
               <img src="https://ui-avatars.com/api/?background=219EBD&amp;color=fff&amp;name=Ahmad" alt="" class="object-cover rounded-full size-8 border-2 border-black/10 hover:border-black/20">
               <span>
                  <svg class="h-4 inline-block size-5 w-4 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                     <path d="M6 9l6 6l6 -6"></path>
                  </svg>
               </span>
            </div>
            <ul tabindex="-1" class="mt-4 dropdown-content menu bg-base-100 text-base-content rounded-b-box z-1 w-52 p-2 shadow-sm">
               <div class="text-gray-500 p-2 mb-1">
                     <h1 class="font-medium text-sm  text-gray-700">{{ currentUser?.user?.name }}</h1>
                     <div class="text-gray-500 text-sm [*+&amp;]:mt-2">
                        {{ currentUser?.user?.email }}
                     </div>
                  </div>
               <li>
                  <RouterLink :to="{ name: 'account' }">
                        <span>
                           <svg class="@if-&amp;&amp; !@if-$label @endif !h-5 !w-5 inline-block size-5 ltr:-ml-1 rtl:-mr-1 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                              <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                           </svg>
                        </span>
                        <span>
                        حسابي
                        </span>
                     </RouterLink>
                  </li>
                     <li>
                        <RouterLink :to="{ name: 'account' }">
                        <span>
                           <svg class="@if-&amp;&amp; !@if-$label @endif !h-5 !w-5 inline-block size-5 ltr:-ml-1 rtl:-mr-1 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                              <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                           </svg>
                        </span>
                        <span>
                        حسابي
                        </span>
                     </RouterLink>
                     </li>
                     <li>
                     <a href="/" >
                        <span>
                           <svg class="@if-&amp;&amp; !@if-$label @endif !h-5 !w-5 inline-block size-5 ltr:-ml-1 rtl:-mr-1 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                              <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                              <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                           </svg>
                        </span>
                        <span>
                        بروشور
                        </span>
                     </a>
                     </li>
                     <li>
                     <a href="/logout" >
                        <span>
                           <svg class="@if-&amp;&amp; !@if-$label @endif !h-5 !w-5 inline-block size-5 ltr:-ml-1 rtl:-mr-1 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                              <path d="M9 12h12l-3 -3"></path>
                              <path d="M18 15l3 -3"></path>
                           </svg>
                        </span>
                        <span>
                        خروج
                        </span>
                    </a>
                    </li>
            </ul>
         </div>-->

         <div class="relative" ref="dropdownRef">
            <div class="cursor-pointer flex items-center gap-x-2" @click="toggleDropdown" icon:trailing="chevron-down">
               <img :src="currentUser?.user?.image" alt="" class="object-cover rounded-full size-8 border-2 border-black/10 hover:border-black/20">
               <span>
                  <svg class="h-4 inline-block size-5 w-4 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                     <path d="M6 9l6 6l6 -6"></path>
                  </svg>
               </span>
            </div>
            <div v-show="openDropdown" class="absolute mt-3 z-40 left-0" x-transition="" >
               <div class="p-0.5 bg-white rounded-b-md mt-px w-48 text-sm">
                  <div class="text-gray-500 p-2 mb-1">
                     <h1 class="font-medium text-sm  text-gray-500 truncate">{{ currentUser?.user?.name }}</h1>
                     <div class="text-gray-500/75 text-xs mt-2 truncate">
                        {{ currentUser?.user?.email }}
                     </div>
                  </div>
                  <div class="grid gap-y-px" @click="toggleDropdown">
                     <RouterLink :to="{ name: 'account' }" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 cursor-pointer gap-2 h-9 inline-flex bg-black/10 bg-gray-100 px-4 py-2 text-sm transition-all transition-colors duration-300 items-center justify-center justify-start whitespace-nowrap rounded-md hover:bg-black/20 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none" wire:navigate="">
                        <span>
                           <svg class="@if-&amp;&amp; !@if-$label @endif !h-5 !w-5 inline-block size-5 ltr:-ml-1 rtl:-mr-1 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                              <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                           </svg>
                        </span>
                        <span>
                        حسابي
                        </span>
                     </RouterLink>
                     <RouterLink :to="{ name: 'account' }" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 cursor-pointer gap-2 h-9 inline-flex bg-black/10 bg-gray-100 px-4 py-2 text-sm transition-all transition-colors duration-300 items-center justify-center justify-start whitespace-nowrap rounded-md hover:bg-black/20 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none" wire:navigate="">
                        <span>
                           <svg viewBox="0 0 24 24" class="inline-block size-5 ltr:-ml-1 rtl:-mr-1 dark:text-gray-500" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.609 13.5616L21.8382 11.1263C22.0182 9.2137 22.1082 8.25739 21.781 7.86207C21.604 7.64823 21.3633 7.5172 21.106 7.4946C20.6303 7.45282 20.0329 8.1329 18.8381 9.49307C18.2202 10.1965 17.9113 10.5482 17.5666 10.6027C17.3757 10.6328 17.1811 10.6018 17.0047 10.5131C16.6865 10.3529 16.4743 9.91812 16.0499 9.04851L13.8131 4.46485C13.0112 2.82162 12.6102 2 12 2C11.3898 2 10.9888 2.82162 10.1869 4.46486L7.95007 9.04852C7.5257 9.91812 7.31351 10.3529 6.99526 10.5131C6.81892 10.6018 6.62434 10.6328 6.43337 10.6027C6.08872 10.5482 5.77977 10.1965 5.16187 9.49307C3.96708 8.1329 3.36968 7.45282 2.89399 7.4946C2.63666 7.5172 2.39598 7.64823 2.21899 7.86207C1.8918 8.25739 1.9818 9.2137 2.16181 11.1263L2.391 13.5616C2.76865 17.5742 2.95748 19.5805 4.14009 20.7902C5.32271 22 7.09517 22 10.6401 22H13.3599C16.9048 22 18.6773 22 19.8599 20.7902C21.0425 19.5805 21.2313 17.5742 21.609 13.5616Z" stroke="currentColor" stroke-width="1.5"></path> <path opacity="0.5" d="M9 18H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>

                        </span>
                        <span>
                        باقة الاشتراك
                        </span>
                     </RouterLink>
                     <a href="/" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 cursor-pointer gap-2 h-9 inline-flex bg-black/10 bg-gray-100 px-4 py-2 text-sm transition-all transition-colors duration-300 items-center justify-center justify-start whitespace-nowrap rounded-md hover:bg-black/20 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none">
                        <span>
                           <svg class="inline-block size-5 ltr:-ml-1 rtl:-mr-1 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                              <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                              <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                           </svg>
                        </span>
                        <span>
                        بروشور
                        </span>
                     </a>
                     <a href="/logout" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 cursor-pointer gap-2 h-9 inline-flex bg-black/10 bg-gray-100 px-4 py-2 text-sm transition-all transition-colors duration-300 items-center justify-center justify-start whitespace-nowrap rounded-md hover:bg-black/20 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none">
                        <span>
                           <svg class="@if-&amp;&amp; !@if-$label @endif !h-5 !w-5 inline-block size-5 ltr:-ml-1 rtl:-mr-1 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                              <path d="M9 12h12l-3 -3"></path>
                              <path d="M18 15l3 -3"></path>
                           </svg>
                        </span>
                        <span>
                        خروج
                        </span>
                    </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useAuthStore } from '@/stores/auth';

const openDropdown = ref(false);
let dropdownRef = ref(null);
const currentUser = useAuthStore();
 

const toggleDropdown = () => {
    openDropdown.value = !openDropdown.value;
};

const closeDropdown = () => {
    openDropdown.value = false;
};

const handleClickOutside = (event) => {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        closeDropdown();
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>