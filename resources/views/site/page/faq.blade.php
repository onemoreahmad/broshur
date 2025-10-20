 <x-site::layout>

    <section class="py-16  lg:py-20 xl:py-32">
        <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-6xl">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-3xl font-semibold text-gray-900 sm:text-4xl lg:text-5xl font-camel"> الأسئلة الأكثر شيوعاً  </h2>
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
                            <span>   ما هو وجيز بالضبط ؟   </span>
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
                               وجيز عبارة عن منصة موحدة يندرج تحتها تطبيقات متعددة تساعدك على إدارة ونشر أعمالك وخدماتك بحساب واشتراك واحد. 
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
                           
                            <span>    ماهي التطبيقات التي يمكنني استخدمها بعد الإشتراك ؟   </span>
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
يمكنك استخدام كل التطبيقات الحالية والمستقبلية باشتراك وحيد، يمكنك تفعيل التطبيقات التي تريدها وتعطيل الأخرى التي لا تحتاجها. 
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
                           
                            <span>  كم موقع ومتجر يمكنني إنشائها في حسابي ؟  </span>
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
                                كل حساب له الصلاحية لإنشاء واحد من كل هذه الخدمات لمنشاة واحدة، يمكنك إنشاء موقع واحد وصفحة بروفايل واحدة وغيرها بحساب منشأتك، إذا أردت إنشاء موقع آخر أو متجر آخر تحتاج إلى اشتراك جديد لمنشأة جديدة. يمكنك أيضاً إدارة أكثر من منشأة في حساب واحد لسهولة التنقل بينهم. 

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
                                نعم، في الحسابات المدفوعة يمكنك ربط نطاقك الخاص لاستخدامه في كل التطبيقات، موقعك الإلكتروني، متجرك، صفحة البروفايل وغيرها. 
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
                            <span> ماهي الدول المسموح بها لاستخدام منصة وجيز ؟ </span>
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
                             لا توجد قيود على الدول. يمكنك استخدام كل تطبيقات وجيز من أي مكان به انترنت.
                             <br>
القيود ستكون عند تعاملك مع شركات الأطراف الخارجية مثل بوابات الدفع والمنصات الأخرى التي تود ربطها في مع وجيز. 

                            </p>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="max-w-5xl mx-auto mt-8 overflow-hidden bg-gray-200/50 sm:mt-12 rounded-xl">
                <div class="p-2">
                    <div class="max-w-sm mx-auto">
                        <h3 class="mt-12 text-2xl font-semibold text-gray-900"> ما حصلت على إجابة لأسئلتك ؟</h3>
                        <p class="mt-2 text-base font-normal text-gray-700/50"> إذا ما حصلت إجابة، تواصل معنا من هنا.</p>
                    </div>
                    <div class="mt-8">
                        
                         <livewire:site.contact-form />
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</x-site::layout>

<?php 
new 
#[\Livewire\Attributes\Title('الأسئلة المتكررة')]
class extends \Livewire\Volt\Component { 
};