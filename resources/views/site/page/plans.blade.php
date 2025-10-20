<x-site::layout title="الأسعار">
 

 <div id="pricing" class="bg-gray-100 pt-20 lg:pt-40  ">

   <div class="mx-auto px-3 max-w-4xl text-center xl:px-0 font-camel">
      <h1 class="text-4xl font-bold leading-tight mb-6 md:text-5xl md:font-extrabold">الأسعار والباقات</h1>
       <h2 class="text-2xl font-semibold mb-4 text-gray-700"> إبدأ مجاناً اليوم، ثم قم بالترقية في أي وقت حسب إحتياجاتك.</h2>
        <p class="mt-4 text-base font-normal leading-7 text-gray-600 lg:text-lg lg:mt-6 lg:leading-8">
           سواء كنت تبدأ للتو أو لديك بيزنس متنامٍ، لدينا الباقة المثالية لاحتياجاتك. جميع الباقات تشمل استضافة مجانية وأمان كامل لصفحاتك.
        </p>
    </div>

<div class="mt-20 md:grid flex flex-col grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 px-3 xl:px-0 max-w-6xl mx-auto">

       
    <!-- باقة البداية (مجانية) -->
    <div class="border shadow-sm relative bg-white border-gray-200 rounded-3xl">
        <div class="px-5 pt-5 pb-6 border-b border-gray-200">
            <header class="flex items-start mb-2 gap-x-2">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">🎯</span>
                </div>
                <div>
                    <h3 class="text-lg text-gray-800 font-semibold"> مستكشف </h3>
                    <div class="text-xs mt-1 text-gray-500">
                        مثالية للتجربة والبدء السريع
                    </div>
                </div>
            </header>

            <div class="text-gray-800 text-4xl font-bold mt-6">
                <span class="inline-block text-green-600 text-xl" dir="rtl">
                    0 ريال / شهرياً
                    </span>
            </div>

            <p class="mt-6 text-sm text-gray-500">
                مجانية تماماً
            </p>

            <!-- CTA -->
            <a href="{{route('auth.register')}}?plan_id=1" class="shadow-sm mt-4 focus-visible:ring-2 text-white inline-flex w-full bg-green-600 border-gray-200 px-3 py-2 text-sm transition-all border-0 duration-200 font-medium items-center justify-center leading-7 max-w-xs ease-in-out rounded-full hover:border-gray-300 hover:bg-opacity-75 focus:outline-none">
                  مجاناً ابني صفحتك الآن ←
            </a>
        </div>

        <div class="px-5 pt-4 pb-5">
            <div class="text-gray-700 p-2 bg-gray-50 text-sm mb-5 mt-2 rounded-lg">
                <strong>مناسبة لـ:</strong><br>
                • المستقلين والفريلانسرز<br>
                • من يريد تجربة المنصة<br>
                • المشاريع الشخصية البسيطة
            </div>

                 <ul class="mt-8 space-y-4">
                    <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-green-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    صفحة واحدة نشطة
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-green-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    الوصول لجميع القوالب الأساسية  
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-green-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    استضافة مجانية وآمنة
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-green-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    استجابة كاملة للموبايل
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-green-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    نموذج تواصل واحد
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-green-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    ربط حسابات السوشيال ميديا (5 منصات)
                    </li>

                    <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-green-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    رابط فرعي broshur.com/yourname
                    </li>

                    <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-green-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    دعم فني أساسي عبر البريد الإلكتروني
                    </li>

                    <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-green-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    شعار بروشور في أسفل الصفحة
                    </li>

                    <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-green-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    تحليلات أساسية للزوار
                    </li>
                </ul>
        </div>
    </div>

    

    <!-- باقة المحترف -->
    <div class="border shadow-sm relative bg-white border-gray-200 rounded-3xl">
        <div class="px-5 pt-5 pb-6 border-b border-gray-200">
            <header class="flex items-start mb-2 gap-x-2">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">💼</span>
                </div>
                <div>
                    <h3 class="text-lg text-gray-800 font-semibold">باقة  مُستقل</h3>
                    <div class="text-xs mt-1 text-gray-500">
                        للجادين في بناء وجودهم الرقمي
                    </div>
                </div>
            </header>

            <div class="text-gray-800 text-4xl font-bold mt-6">
                <span class="inline-block" dir="rtl">
                    49 ريال / شهرياً
                    </span>
            </div>
            <p class="mt-6 text-sm text-gray-500">
                أو <span class="inline-block font-bold" dir="rtl">
                    490 ريال سنوياً
                    <span class="p-0.5 px-2 bg-cyan-100 text-xs text-cyan-600 rounded-full inline-block ms-2">
                        وفّر شهرين
                    </span>
                </span>
            </p>

            <!-- CTA -->
            <a href="{{route('auth.register')}}?plan_id=2" class="shadow-sm mt-4 focus-visible:ring-2 text-white inline-flex w-full bg-blue-600 border-gray-200 px-3 py-2 text-sm transition-all border-0 duration-200 font-medium items-center justify-center leading-7 max-w-xs ease-in-out rounded-full hover:border-gray-300 hover:bg-opacity-75 focus:outline-none">
                ابني صفحتك الآن ←
            </a>
        </div>

        <div class="px-5 pt-4 pb-5">
            <div class="text-gray-700 p-2 bg-gray-50 text-sm mb-5 mt-2 rounded-lg">
                <strong>مناسبة لـ:</strong><br>
                • الفريلانسرز المحترفين<br>
                • المتاجر الإلكترونية الناشئة<br>
                • وكالات التسويق
            </div>

            <div class="text-sm text-gray-600 mb-4">
                <strong>كل ميزات باقة البداية، بالإضافة إلى:</strong>
            </div>

            <ul class="mt-8 space-y-4">
                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-blue-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>5 صفحات نشطة</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-blue-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>الوصول لجميع القوالب المميزة  </strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-blue-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>رابط مخصص (Domain)</strong>
                </li>

        

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-blue-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>نماذج تواصل غير محدودة</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-blue-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>تكامل مع أدوات التسويق</strong><br>
                    {{-- Google Analytics, Facebook Pixel, WhatsApp Business --}}
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-blue-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>تحليلات متقدمة</strong><br>
                    {{-- مصادر الزوار، معدل التحويل، الصفحات الأكثر زيارة --}}
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-blue-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>نسخ احتياطي يومي تلقائي</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-blue-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>دعم أولوية عبر البريد والشات</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-blue-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>تصدير بيانات العملاء المحتملين (CSV)</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-blue-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>أكواد تتبع مخصصة</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-blue-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>حماية SSL مجانية</strong>
                </li>
            </ul>
        </div>
    </div>



    <!-- باقة الأعمال -->
    <div class="border shadow-sm relative bg-white border-gray-200 border-purple-500 border-4 rounded-3xl col-span-2 xl:col-span-1">
        <span class="-rotate-6 text-white absolute p-1 bg-purple-500 px-3 text-sm -mt-3 rounded-xl rtl:-left-3">
            الأكثر طلباً
            <span class="">🔥</span>
        </span>
       
        <div class="px-5 pt-5 pb-6 border-b border-gray-200">
            <header class="flex items-start mb-2 gap-x-2">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">🚀</span>
                </div>
                <div>
                    <h3 class="text-lg text-gray-800 font-semibold">باقة أعمال</h3>
                    <div class="text-xs mt-1 text-gray-500">
                        للشركات والمشاريع الكبيرة
                    </div>
                </div>
            </header>

            <div class="text-gray-800 text-4xl font-bold mt-6">
                <span class="inline-block" dir="rtl">
                    149 ريال / شهرياً
                    </span>
            </div>

            <p class="mt-6 text-sm text-gray-500">
                أو <span class="inline-block font-bold" dir="rtl">
                    1,490 ريال سنوياً
                    <span class="p-0.5 px-2 bg-cyan-100 text-xs text-cyan-600 rounded-full inline-block ms-2">
                        وفّر شهرين
                    </span>
                </span>
            </p>

            <!-- CTA -->
            <a href="{{route('auth.register')}}?plan_id=3" class="shadow-sm mt-4 focus-visible:ring-2 text-white flex w-full bg-purple-600 border-gray-200 px-3 py-2 text-sm transition-all border-0 duration-200 font-medium items-center justify-center leading-7 ease-in-out rounded-full hover:border-gray-300 hover:bg-opacity-75 focus:outline-none">
                ابني صفحتك الآن ←
            </a>
        </div>

        <div class="px-5 pt-4 pb-5">
            <div class="text-gray-700 p-2 bg-gray-50 text-sm mb-5 mt-2 rounded-lg">
                <strong>مناسبة لـ:</strong><br>
                • الشركات الصغيرة والمتوسطة<br>
                • الوكالات والمسوقين<br>
                • العلامات التجارية المتعددة<br>
                • من يحتاج تكامل متقدم
            </div>

            <div class="text-sm text-gray-600 mb-4">
                <strong>كل ميزات باقة المحترف، بالإضافة إلى:</strong>
            </div>

                   <ul class="mt-8 space-y-4">
                            <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>صفحات غير محدودة</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>فريق عمل (حتى 5 أعضاء)</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>3 روابط مخصصة مجاناً</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>أولوية في سرعة التحميل</strong>
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>إزالة شعار بروشور</strong>
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>قوالب حصرية للشركات</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>API للتكامل مع أنظمتك</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>تخصيص كامل للـ CSS</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>نماذج متقدمة</strong><br>
                    {{-- حقول مشروطة، تحميل ملفات، توقيع إلكتروني، خيارات دفع (قريباً) --}}
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>تكامل مع CRM</strong><br>
                    {{-- HubSpot, Salesforce, Zoho --}}
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <strong>إشعارات فورية (Email & SMS)</strong>
                </li>

                <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                    <strong>A/B Testing للصفحات</strong>
                            </li>
    
                            <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                    <strong>دعم مخصص 24/7 (شات حي + هاتف)</strong>
                            </li>
    
                            <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                    <strong>مدير حساب مخصص</strong>
                            </li>
    
                            <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                    <strong>تدريب وورش عمل مجانية</strong>
                            </li>
    
                            <li class="flex items-center">
                    <svg class="w-5 h-5 me-2 text-purple-600 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                    <strong>استشارة تصميم مجانية شهرياً</strong>
                            </li>
                        </ul>
        </div>
    </div>


</div>

<!-- ميزات مشتركة في جميع الباقات -->
<div class="bg-white py-16 mt-24">
    <div class="mx-auto px-3 max-w-4xl text-center xl:px-0">
        <h2 class="text-3xl font-bold mb-8 text-gray-800">🎁 ميزات مشتركة في جميع الباقات</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <span class="text-2xl me-3">✨</span>
                <span class="text-gray-700">استضافة آمنة وسريعة</span>
            </div>
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <span class="text-2xl me-3">✨</span>
                <span class="text-gray-700">شهادة SSL مجانية</span>
            </div>
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <span class="text-2xl me-3">✨</span>
                <span class="text-gray-700">نسخ احتياطي تلقائي</span>
            </div>
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <span class="text-2xl me-3">✨</span>
                <span class="text-gray-700">تحديثات مجانية دائمة</span>
            </div>
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <span class="text-2xl me-3">✨</span>
                <span class="text-gray-700">حماية من البريد المزعج</span>
            </div>
            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <span class="text-2xl me-3">✨</span>
                <span class="text-gray-700">ضمان استعادة الأموال خلال 30 يوم</span>
            </div>
        </div>
    </div>
</div>

<!-- الأسئلة الشائعة -->
<div class="bg-gray-50 py-16">
    <div class="mx-auto px-3 max-w-4xl xl:px-0">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">❓ الأسئلة المتكررة</h2>
        
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">هل يمكنني الترقية أو التخفيض في أي وقت؟</h3>
                <p class="text-gray-600">نعم، يمكنك تغيير باقتك في أي وقت. عند الترقية، ستدفع الفرق فقط عن الفترة المتبقية. عند التخفيض، سيُضاف الرصيد المتبقي لحسابك.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">هل الأسعار شاملة الضريبة؟</h3>
                <p class="text-gray-600">الأسعار المعروضة غير شاملة لضريبة القيمة المضافة (15%). ستُضاف الضريبة عند الدفع.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">ما هي طرق الدفع المتاحة؟</h3>
                <p class="text-gray-600">نقبل جميع البطاقات الائتمانية (Visa, Mastercard, Mada)، Apple Pay، STC Pay، وتحويل بنكي للباقات السنوية.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">هل يمكنني إلغاء الاشتراك؟</h3>
                <p class="text-gray-600">نعم، يمكنك إلغاء اشتراكك في أي وقت. لن تُفرض عليك أي رسوم إضافية، وستظل صفحاتك نشطة حتى نهاية فترة الاشتراك المدفوعة.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">ما هو ضمان استعادة الأموال؟</h3>
                <p class="text-gray-600">إذا لم تكن راضياً عن الخدمة خلال أول 30 يوم، سنعيد لك أموالك كاملة بدون أي أسئلة.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">هل هناك رسوم إعداد أو رسوم خفية؟</h3>
                <p class="text-gray-600">لا، لا توجد أي رسوم إضافية. السعر المعروض هو كل ما ستدفعه.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">كم عدد الزوار المسموح به؟</h3>
                <p class="text-gray-600">جميع الباقات تدعم زوار غير محدودين. لا نفرض أي قيود على عدد الزيارات لصفحاتك.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">هل يمكنني الحصول على خصم للدفع السنوي؟</h3>
                <p class="text-gray-600">نعم! عند الدفع السنوي، تحصل على خصم يعادل شهرين مجاناً في جميع الباقات المدفوعة.</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-[conic-gradient(at_top_left,_var(--tw-gradient-stops))] from-[#202040] via-[#543864] to-[#ff6363] py-16">
    <div class="mx-auto px-3 max-w-4xl text-center xl:px-0">
        <h2 class="text-3xl font-bold mb-4 text-white font-camel">💬 لست متأكداً من الباقة المناسبة؟</h2>
        <p class="text-xl mb-8 text-white/80">فريقنا هنا لمساعدتك! تواصل معنا وسنساعدك في اختيار الباقة المثالية لاحتياجاتك وميزانيتك.</p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-colors">
                تحدث مع فريق المبيعات
            </a>
            <a href="#" class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                احجز عرض توضيحي مجاني
            </a>
        </div>
        
        <p class="mt-8 text-blue-100 text-sm">
            <strong>جرّب بروشور بدون مخاطرة - ضمان استعادة الأموال خلال 30 يوم</strong>
        </p>
    </div>
</div>

</div>
 
    
</x-site::layout>


<?php 
new 
#[\Livewire\Attributes\Title('الخطط والأسعار')]
class extends \Livewire\Volt\Component { 
};