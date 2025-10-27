<template>
    <div>
 
        <div v-if="auth?.tenant" class="max-w-7xl mx-auto py-4 flex items-center gap-4 px-1 xl:px-0 mt-4">
            <img :src="auth?.tenant?.logo" alt="avatar" class="size-16 rounded-2xl">
            <div class="">
                <h1 class="text-2xl font-bold"> {{ auth?.tenant?.name  }} </h1> 
                <p class="text-sm text-gray-500"> {{ auth?.tenant?.handle  }} </p>
            </div>
        </div>

        <div class="lg:flex max-w-7xl mx-auto items-start px-1 xl:px-0 mt-3">
            <nav class="flex lg:flex-col lg:w-80 min-w-48 gap-px overflow-hidden mx-auto justify-between max-w-7xl overflow-x-auto text-start">
                <RouterLink :to="{ name: 'home' }" exactActiveClass="bg-white" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 flex flex-grow items-center gap-x-2 text-xs lg:rounded-s p-2.5 px-3 bg-gray-100/50">
                    <span class="text-lg inline-block -mt-1"> 
                        <svg viewBox="0 0 24 24" fill="none" class="size-5" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 16.0909V11.0975C21 6.80891 21 4.6646 19.682 3.3323C18.364 2 16.2426 2 12 2C7.75736 2 5.63604 2 4.31802 3.3323C3 4.6646 3 6.80891 3 11.0975V16.0909C3 19.1875 3 20.7358 3.73411 21.4123C4.08421 21.735 4.52615 21.9377 4.99692 21.9915C5.98402 22.1045 7.13673 21.0849 9.44216 19.0458C10.4612 18.1445 10.9708 17.6938 11.5603 17.5751C11.8506 17.5166 12.1494 17.5166 12.4397 17.5751C13.0292 17.6938 13.5388 18.1445 14.5578 19.0458C16.8633 21.0849 18.016 22.1045 19.0031 21.9915C19.4739 21.9377 19.9158 21.735 20.2659 21.4123C21 20.7358 21 19.1875 21 16.0909Z" stroke="#1C274D" stroke-width="1.5"></path> <path opacity="0.5" d="M15 6H9" stroke="#1C274D" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                        </span>
                    <span class="text-sm text-gray-500"> الترويسة (الهيدر) </span>
                </RouterLink>
                <RouterLink :to="{ name: 'blocks.cta' }" active-class="bg-white" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 lg:rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 bg-gray-100/50">
                    <span class="text-lg inline-block -mt-1"> 
                        <svg viewBox="0 0 24 24" fill="none" class="size-5" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.70399 3.5H17.5C18.9045 3.5 19.6067 3.5 20.1111 3.83706C20.3295 3.98298 20.517 4.17048 20.6629 4.38886C21 4.89331 21 5.59554 21 7C21 8.40446 21 9.10669 20.6629 9.61114C20.517 9.82952 20.3295 10.017 20.1111 10.1629C19.6067 10.5 18.9045 10.5 17.5 10.5H6.70399C6.04642 10.5 5.71764 10.5 5.41593 10.4018C5.28282 10.3585 5.15463 10.3013 5.03346 10.2312C4.75882 10.0723 4.53915 9.8277 4.09981 9.33844C3.24911 8.39107 2.82376 7.91738 2.72136 7.36381C2.67687 7.12331 2.67687 6.87669 2.72136 6.63619C2.82376 6.08262 3.24911 5.60894 4.09981 4.66156C4.53915 4.1723 4.75882 3.92767 5.03346 3.76879C5.15463 3.6987 5.28282 3.64152 5.41593 3.5982C5.71764 3.5 6.04642 3.5 6.70399 3.5Z" stroke="#1C274C" stroke-width="1.5"></path> <path d="M17.296 12.5H6.5C5.09554 12.5 4.39331 12.5 3.88886 12.8371C3.67048 12.983 3.48298 13.1705 3.33706 13.3889C3 13.8933 3 14.5955 3 16C3 17.4045 3 18.1067 3.33706 18.6111C3.48298 18.8295 3.67048 19.017 3.88886 19.1629C4.39331 19.5 5.09554 19.5 6.5 19.5H17.296C17.9536 19.5 18.2824 19.5 18.5841 19.4018C18.7172 19.3585 18.8454 19.3013 18.9665 19.2312C19.2412 19.0723 19.4608 18.8277 19.9002 18.3384C20.7509 17.3911 21.1762 16.9174 21.2786 16.3638C21.3231 16.1233 21.3231 15.8767 21.2786 15.6362C21.1762 15.0826 20.7509 14.6089 19.9002 13.6616C19.4608 13.1723 19.2412 12.9277 18.9665 12.7688C18.8454 12.6987 18.7172 12.6415 18.5841 12.5982C18.2824 12.5 17.9536 12.5 17.296 12.5Z" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M12.75 2C12.75 1.58579 12.4142 1.25 12 1.25C11.5858 1.25 11.25 1.58579 11.25 2H12.75ZM12.75 11C12.75 10.5858 12.4142 10.25 12 10.25C11.5858 10.25 11.25 10.5858 11.25 11H12.75ZM12.75 20C12.75 19.5858 12.4142 19.25 12 19.25C11.5858 19.25 11.25 19.5858 11.25 20H12.75ZM14 22.75C14.4142 22.75 14.75 22.4142 14.75 22C14.75 21.5858 14.4142 21.25 14 21.25V22.75ZM10 21.25C9.58579 21.25 9.25 21.5858 9.25 22C9.25 22.4142 9.58579 22.75 10 22.75V21.25ZM11.25 2V3H12.75V2H11.25ZM11.25 11V12H12.75V11H11.25ZM11.25 20V22H12.75V20H11.25ZM14 21.25H10V22.75H14V21.25Z" fill="#1C274C"></path> </g></svg>
                        </span>
                    <span class="text-sm text-gray-500"> أزرار الإجراءات </span>
                </RouterLink>
               
                <RouterLink :to="{ name: 'blocks.links' }" active-class="bg-white" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 lg:rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 bg-gray-100/50">
                    <span class="text-lg inline-block -mt-1"> 
                        <svg viewBox="0 0 24 24" class="size-5" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11.3357 5.47875L7.36344 9.00968C5.79482 10.404 5.0105 11.1012 5.0105 11.9993C5.0105 12.8975 5.79481 13.5946 7.36344 14.989L11.3357 18.5199C12.0517 19.1563 12.4098 19.4746 12.7049 19.342C13.0001 19.2095 13.0001 18.7305 13.0001 17.7725V15.4279C16.6001 15.4279 20.5001 17.1422 22.0001 19.9993C22.0001 10.8565 16.6668 8.57075 13.0001 8.57075V6.22616C13.0001 5.26817 13.0001 4.78917 12.7049 4.65662C12.4098 4.52407 12.0517 4.8423 11.3357 5.47875Z" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path opacity="0.5" d="M8.46129 4.5L3.24509 9.34362C2.45098 10.081 1.99976 11.1158 1.99976 12.1994C1.99976 13.3418 2.50097 14.4266 3.37087 15.1671L8.46129 19.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                    </span>
                    <span class="text-sm text-gray-500"> الحسابات الإجتماعية </span>
                </RouterLink>
                <RouterLink :to="{ name: 'blocks.about' }" active-class="bg-white" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 lg:rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 bg-gray-100/50">
                    <span class="text-lg inline-block -mt-1"> 
                        <svg viewBox="0 0 24 24" class="size-5" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M22 22L2 22" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M21 22V6C21 4.11438 21 3.17157 20.4143 2.58579C19.8285 2 18.8857 2 17 2H15C13.1144 2 12.1716 2 11.5858 2.58579C11.1143 3.05733 11.0223 3.76022 11.0044 5" stroke="#1C274C" stroke-width="1.5"></path> <path d="M15 22V9C15 7.11438 15 6.17157 14.4142 5.58579C13.8284 5 12.8856 5 11 5H7C5.11438 5 4.17157 5 3.58579 5.58579C3 6.17157 3 7.11438 3 9V22" stroke="#1C274C" stroke-width="1.5"></path> <path d="M9 22V19" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M6 8H12" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M6 11H12" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <path opacity="0.5" d="M6 14H12" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                    </span>
                    <span class="text-sm text-gray-500"> من نحن </span>
                </RouterLink>
 
                <RouterLink :to="{ name: 'blocks.features' }" active-class="bg-white" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 lg:rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 bg-gray-100/50">
                    <span class="text-lg inline-block -mt-1"> 
                        <svg viewBox="0 0 24 24" class="size-5" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12Z" stroke="#1C274C" stroke-width="1.5"></path> <path d="M10.125 8.875C10.125 7.83947 10.9645 7 12 7C13.0355 7 13.875 7.83947 13.875 8.875C13.875 9.56245 13.505 10.1635 12.9534 10.4899C12.478 10.7711 12 11.1977 12 11.75V13" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> <circle cx="12" cy="16" r="1" fill="#1C274C"></circle> </g></svg>
                    </span>
                    <span class="text-sm text-gray-500"> قائمة المزايا </span>
                </RouterLink>
              
                <RouterLink :to="{ name: 'blocks.faq' }" active-class="bg-white" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 lg:rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 bg-gray-100/50">
                    <span class="text-lg inline-block -mt-1"> 
                        <svg viewBox="0 0 24 24" fill="none" class="size-5" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M9.99088 16.5L9.01504 16.9741C7.0341 17.5217 6.04363 17.7955 5.50972 17.2192C4.97582 16.6429 5.25206 15.5982 5.80455 13.5087L5.94749 12.9682C6.10449 12.3744 6.18299 12.0775 6.14352 11.7831C6.10404 11.4887 5.95106 11.2301 5.6451 10.713L5.36655 10.2421C4.28985 8.4221 3.75151 7.51211 4.11106 6.78804C4.4706 6.06397 5.48992 6.00535 7.52857 5.88812L8.05599 5.85779C8.63531 5.82448 8.92497 5.80782 9.17756 5.67305C9.43014 5.53828 9.61705 5.30066 9.99088 4.82542L10.3312 4.39274C11.6467 2.72034 12.3045 1.88413 13.0606 2.01293C13.8167 2.14173 14.1705 3.15023 14.8779 5.16723L15.0609 5.68905C15.262 6.26222 15.3625 6.5488 15.5581 6.75991C15.7537 6.97102 16.0222 7.08275 16.5592 7.30622L17.048 7.50967C18.9378 8.29605 19.8826 8.68925 19.9904 9.49292C20.0823 10.1786 19.513 10.7756 18.3493 11.7831" stroke="#1C274C" stroke-width="1.5"></path> <path d="M15.2516 10.689C14.265 9.50847 13.7716 8.91821 13.2045 9.00913C12.6375 9.10004 12.3722 9.81193 11.8416 11.2357L11.7043 11.604C11.5535 12.0086 11.4781 12.2109 11.3314 12.3599C11.1848 12.509 10.9834 12.5878 10.5806 12.7456L10.214 12.8892C8.79667 13.4443 8.08803 13.7218 8.00721 14.2891C7.92639 14.8564 8.52692 15.3378 9.72797 16.3004L10.0387 16.5495C10.38 16.8231 10.5507 16.9599 10.6494 17.1471C10.7482 17.3343 10.7639 17.5508 10.7954 17.9837L10.824 18.3779C10.9347 19.9015 10.9901 20.6633 11.5072 20.923C12.0244 21.1827 12.6608 20.7683 13.9337 19.9395L14.263 19.7251C14.6247 19.4896 14.8056 19.3718 15.0133 19.3385C15.2211 19.3052 15.4322 19.3601 15.8543 19.47L16.2387 19.57C17.7244 19.9565 18.4673 20.1498 18.8677 19.743C19.2681 19.3362 19.061 18.5987 18.6466 17.1238L18.5394 16.7422C18.4216 16.3231 18.3628 16.1135 18.3924 15.9057C18.422 15.6979 18.5367 15.5154 18.7662 15.1503L18.9751 14.818C19.7826 13.5332 20.1864 12.8909 19.9167 12.3798C19.647 11.8687 18.8826 11.8273 17.3536 11.7446L16.958 11.7231C16.5235 11.6996 16.3063 11.6879 16.1168 11.5927C15.9274 11.4976 15.7872 11.3299 15.5068 10.9944L15.2516 10.689Z" stroke="#1C274C" stroke-width="1.5"></path> </g></svg>
                    </span>
                    <span class="text-sm text-gray-500"> الأسئلة المتكررة </span>
                </RouterLink>
            
 
                <RouterLink :to="{ name: 'blocks.reviews' }" active-class="bg-white" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 lg:rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 bg-gray-100/50">     
                    <span class="text-lg inline-block -mt-1"> 
                        <svg viewBox="0 0 24 24" fill="none" class="size-5" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M9.99088 16.5L9.01504 16.9741C7.0341 17.5217 6.04363 17.7955 5.50972 17.2192C4.97582 16.6429 5.25206 15.5982 5.80455 13.5087L5.94749 12.9682C6.10449 12.3744 6.18299 12.0775 6.14352 11.7831C6.10404 11.4887 5.95106 11.2301 5.6451 10.713L5.36655 10.2421C4.28985 8.4221 3.75151 7.51211 4.11106 6.78804C4.4706 6.06397 5.48992 6.00535 7.52857 5.88812L8.05599 5.85779C8.63531 5.82448 8.92497 5.80782 9.17756 5.67305C9.43014 5.53828 9.61705 5.30066 9.99088 4.82542L10.3312 4.39274C11.6467 2.72034 12.3045 1.88413 13.0606 2.01293C13.8167 2.14173 14.1705 3.15023 14.8779 5.16723L15.0609 5.68905C15.262 6.26222 15.3625 6.5488 15.5581 6.75991C15.7537 6.97102 16.0222 7.08275 16.5592 7.30622L17.048 7.50967C18.9378 8.29605 19.8826 8.68925 19.9904 9.49292C20.0823 10.1786 19.513 10.7756 18.3493 11.7831" stroke="#1C274C" stroke-width="1.5"></path> <path d="M15.2516 10.689C14.265 9.50847 13.7716 8.91821 13.2045 9.00913C12.6375 9.10004 12.3722 9.81193 11.8416 11.2357L11.7043 11.604C11.5535 12.0086 11.4781 12.2109 11.3314 12.3599C11.1848 12.509 10.9834 12.5878 10.5806 12.7456L10.214 12.8892C8.79667 13.4443 8.08803 13.7218 8.00721 14.2891C7.92639 14.8564 8.52692 15.3378 9.72797 16.3004L10.0387 16.5495C10.38 16.8231 10.5507 16.9599 10.6494 17.1471C10.7482 17.3343 10.7639 17.5508 10.7954 17.9837L10.824 18.3779C10.9347 19.9015 10.9901 20.6633 11.5072 20.923C12.0244 21.1827 12.6608 20.7683 13.9337 19.9395L14.263 19.7251C14.6247 19.4896 14.8056 19.3718 15.0133 19.3385C15.2211 19.3052 15.4322 19.3601 15.8543 19.47L16.2387 19.57C17.7244 19.9565 18.4673 20.1498 18.8677 19.743C19.2681 19.3362 19.061 18.5987 18.6466 17.1238L18.5394 16.7422C18.4216 16.3231 18.3628 16.1135 18.3924 15.9057C18.422 15.6979 18.5367 15.5154 18.7662 15.1503L18.9751 14.818C19.7826 13.5332 20.1864 12.8909 19.9167 12.3798C19.647 11.8687 18.8826 11.8273 17.3536 11.7446L16.958 11.7231C16.5235 11.6996 16.3063 11.6879 16.1168 11.5927C15.9274 11.4976 15.7872 11.3299 15.5068 10.9944L15.2516 10.689Z" stroke="#1C274C" stroke-width="1.5"></path> </g></svg>
                    </span>
                    <span class="text-sm text-gray-500"> آراء العملاء </span>
                </RouterLink>
                
             
                <RouterLink :to="{ name: 'blocks.gallery' }" active-class="bg-white" class="cursor-pointer lg:w-full w-fit shrink-0 hover:bg-gray-50 lg:rounded-s p-2.5 px-3 flex flex-grow items-center gap-x-2 bg-gray-100/50">
                    <span class="text-lg inline-block -mt-1"> 
                        <svg viewBox="0 0 24 24" class="size-5" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2.38351 13.793C1.93748 10.6294 1.71447 9.04765 2.66232 8.02383C3.61017 7 5.29758 7 8.67239 7H15.3276C18.7024 7 20.3898 7 21.3377 8.02383C22.2855 9.04765 22.0625 10.6294 21.6165 13.793L21.1935 16.793C20.8437 19.2739 20.6689 20.5143 19.7717 21.2572C18.8745 22 17.5512 22 14.9046 22H9.09536C6.44881 22 5.12553 22 4.22834 21.2572C3.33115 20.5143 3.15626 19.2739 2.80648 16.793L2.38351 13.793Z" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M19.5617 7C19.7904 5.69523 18.7863 4.5 17.4617 4.5H6.53788C5.21323 4.5 4.20922 5.69523 4.43784 7M17.4999 4.5C17.5283 4.24092 17.5425 4.11135 17.5427 4.00435C17.545 2.98072 16.7739 2.12064 15.7561 2.01142C15.6497 2 15.5194 2 15.2588 2H8.74099C8.48035 2 8.35002 2 8.24362 2.01142C7.22584 2.12064 6.45481 2.98072 6.45704 4.00434C6.45727 4.11135 6.47146 4.2409 6.49983 4.5" stroke="#1C274C" stroke-width="1.5"></path> <circle opacity="0.5" cx="16.5" cy="11.5" r="1.5" stroke="#1C274C" stroke-width="1.5"></circle> <path opacity="0.5" d="M19.9999 20L17.1157 17.8514C16.1856 17.1586 14.8004 17.0896 13.7766 17.6851L13.5098 17.8403C12.7984 18.2542 11.8304 18.1848 11.2156 17.6758L7.37738 14.4989C6.6113 13.8648 5.38245 13.8309 4.5671 14.4214L3.24316 15.3803" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                    </span>
                    <span class="text-sm text-gray-500"> معرض الأعمال </span>
                </RouterLink>
            </nav>
 
            <div class="bg-white truncate lg:rounded-lg rounded-b-lg lg:-mr-1.5 p-6 min-h-[60vh] w-full relative">
                <RouterView :key="$route.name" />
            </div>

            <div class="hidden lg:block lg:px-5">
                <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[10px] rounded-[2.5rem] h-[700px] w-[420px] [&amp;::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]" dir="ltr">
                    <!--<div class="h-[32px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[27px] top-[72px] rounded-s-lg"></div>
                    <div class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[124px] rounded-s-lg"></div>
                    <div class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[178px] rounded-s-lg"></div>
                    <div class="h-[64px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -end-[17px] top-[142px] rounded-e-lg"></div>-->
                    <div class="h-[672px] overflow-hidden w-[398px] bg-white overflow-y-scroll rounded-[2rem] dark:bg-gray-800">
                        <iframe id="linkinbio-iframe" src="https://broshur.test/wjeez/preview" class="w-full min-h-screen"></iframe> 
                    </div>
                </div>   
            </div>
        </div>
  
    </div>
</template>

<script setup>
    import { useAuthStore } from '@/stores/auth';
 
    const auth = useAuthStore()
    
</script>