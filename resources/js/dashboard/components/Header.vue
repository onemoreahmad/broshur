<template>
<div class="bg-white py-2 px-2 xl:px-0 !bg-purple-700 bg-gradient-to-r from-primary-900 via-primary-800 to-indigo-700 !p-3 text-white" wire:ignore="">
   <div class="max-w-7xl mx-auto flex items-center justify-between">
      <div class="flex items-center">
         <RouterLink :to="{ name: 'home' }" class="inline-flex items-center gap-2" wire:navigate="">
            <img src="/assets/images/logo-shape-white.svg" alt="" class="size-6 !w-auto">
            <div>
               <span class="font-bold"></span>
            </div>
         </RouterLink>
         <RouterLink :to="{ name: 'home' }" class="inline-flex items-center gap-2" wire:navigate="">
            <img src="/assets/images/logo-white.webp" alt="" class="size-6 !w-auto">
            <div>
               <span class="font-bold"></span>
            </div>
         </RouterLink>
         <RouterLink :to="{ name: 'orders' }"  title="الطلبات" class="text-white flex p-1 px-2 gap-x-2 items-center justify-center shrink-0 ms-12 rounded-lg" activeClass="bg-black/40">
            <svg viewBox="0 0 24 24" class="size-5 text-white" fill="none" xmlns="http://www.w3.org/2000/svg">
               <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
               <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
               <g id="SVGRepo_iconCarrier">
                  <path opacity="0.5" d="M22 10.5V12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2H13.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                  <circle cx="19" cy="5" r="3" stroke="currentColor" stroke-width="1.5"></circle>
                  <path d="M7 14H16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                  <path d="M7 17.5H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
               </g>
            </svg>
            <span class="text-sm hidden lg:block">
            التفاعل والطلبات
            </span>
            <span class="text-sm block lg:hidden">
            الطلبات
            </span>
         </RouterLink>
      </div>
      <div class="flex items-center gap-4">
         <RouterLink :to="{ name: 'preview' }" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 text-white !hidden cursor-pointer gap-2 h-9 inline-flex !bg-green-600 px-4 py-2 text-sm transition-all transition-colors bg-transparent duration-300 items-center justify-center whitespace-nowrap rounded-md hover:!bg-green-700 hover:bg-black/10 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none lg:!block" wire:current="!bg-white/10" target="_blank" icon:trailing="arrow-up-left">
            <span>
               <svg class="@if-&amp;&amp; !@if-$label @endif !h-5 !w-5 inline-block size-5 ltr:-ml-1 rtl:-mr-1 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M9 15l6 -6"></path>
                  <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path>
                  <path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"></path>
               </svg>
            </span>
            <span>
            معاينة البروشور
            </span>
            <span>
               <svg class="!h-5 !w-5 inline-block size-5 rtl:-ml-1 ltr:-mr-1 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M7 7l10 10"></path>
                  <path d="M16 7l-9 0l0 9"></path>
               </svg>
            </span>
         </RouterLink>
         <RouterLink :to="{ name: 'preview' }" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 text-white !block cursor-pointer gap-2 h-9 inline-flex !bg-green-600 px-4 py-2 text-sm transition-all transition-colors bg-transparent duration-300 items-center justify-center whitespace-nowrap rounded-md hover:!bg-green-700 hover:bg-black/10 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none lg:!hidden" wire:current="!bg-white/10" target="_blank" icon:trailing="arrow-up-left">
            <span>
               <svg class="!h-5 !w-5 inline-block size-5 rtl:-ml-1 ltr:-mr-1 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M7 7l10 10"></path>
                  <path d="M16 7l-9 0l0 9"></path>
               </svg>
            </span>
         </RouterLink>
         <div class="relative" ref="dropdownRef">
            <div class="cursor-pointer flex items-center gap-x-2" @click="toggleDropdown" icon:trailing="chevron-down">
               <img src="https://ui-avatars.com/api/?background=219EBD&amp;color=fff&amp;name=Ahmad" alt="" class="object-cover rounded-full size-8 border-2 border-black/10 hover:border-black/20">
               <span>
                  <svg class="h-4 inline-block size-5 w-4 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                     <path d="M6 9l6 6l6 -6"></path>
                  </svg>
               </span>
            </div>
            <div v-show="openDropdown" class="absolute [*+&amp;]:mt-2 z-40 left-0" x-transition="" >
               <div class="p-0.5 bg-white rounded-b-md mt-px w-48 text-sm">
                  <div class="text-gray-500 p-2 mb-1">
                     <h1 class="font-medium text-sm [&amp;:has(+[*])]:mb-2 [*+&amp;]:mt-4 text-gray-500">Ahmad</h1>
                     <div class="text-gray-500 text-sm [*+&amp;]:mt-2 dark:text-white/70">
                        contact@ahmad.tech
                     </div>
                  </div>
                  <div class="grid gap-y-px">
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
                     <RouterLink :to="{ name: 'preview' }" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 cursor-pointer gap-2 h-9 inline-flex bg-black/10 bg-gray-100 px-4 py-2 text-sm transition-all transition-colors duration-300 items-center justify-center justify-start whitespace-nowrap rounded-md hover:bg-black/20 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none">
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
                     </RouterLink>
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

const openDropdown = ref(false);
let dropdownRef = ref(null);

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