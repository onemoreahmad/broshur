
<footer class="py-12 bg-white  ">
    <div class="px-4 mx-auto container sm:px-6 lg:px-8">
    
        <div class="lg:flex lg:items-center lg:justify-between  ">
            <div class="flex items-center gap-x-4">
                <img class="w-auto h-8 mx-auto lg:mx-0" src="{{ asset('assets/images/broshur-logo-shape.webp') }}" alt="" />
                <img class="w-auto h-8 mx-auto lg:mx-0" src="{{ asset('assets/images/logo.webp') }}" alt="" />
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
