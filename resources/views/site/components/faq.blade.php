    <section class="py-16 bg-gray-200 lg:py-20 xl:py-32">
        <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-6xl">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl lg:text-5xl font-camel"> الأسئلة المتكررة  </h2>
                <p class="mt-4 text-base font-normal leading-7 text-gray-600/60 lg:text-lg lg:mt-6 lg:leading-8"> هنا قائمة بإجاباتنا على أكثر الأسئلة تكراراً، إذا لم تجد إجابة لسؤالك <a href="{{route('site.page.contact')}}" wire:navigate class="text-primary-700 hover:text-primary-600"> تواصل معنا</a> في أي وقت.</p>
            </div>
    
            <div x-cloak class="max-w-5xl bg-white mx-auto mt-12 overflow-hidden border border-gray-200 divide-y divide-gray-200 sm:mt-16 rounded-xl" x-data="{ active: 1 }">
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