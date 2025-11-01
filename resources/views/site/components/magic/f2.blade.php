<div class="relative min-h-screen bg-white overflow-hidden">
    <!-- Background with gradients and curved lines -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <!-- Left radial gradient (pinkish-orange) -->
        <div class="absolute left-0 top-0 w-[600px] h-[600px] bg-gradient-radial from-orange-200/30 via-pink-200/20 to-transparent rounded-full blur-3xl"></div>
        <!-- Right radial gradient (purplish) -->
        <div class="absolute right-0 top-0 w-[600px] h-[600px] bg-gradient-radial from-purple-200/30 via-blue-200/20 to-transparent rounded-full blur-3xl"></div>
        <!-- Curved lines -->
        <svg class="absolute inset-0 w-full h-full opacity-30" viewBox="0 0 1440 900" preserveAspectRatio="none">
            <path d="M0,200 Q200,150 400,200 T800,180 T1200,200 T1440,190" stroke="#d1d5db" fill="none" stroke-width="2"/>
            <path d="M0,300 Q300,250 600,300 T1200,280 T1440,290" stroke="#d1d5db" fill="none" stroke-width="2"/>
            <path d="M0,500 Q150,450 300,500 T600,480 T900,500 T1440,490" stroke="#d1d5db" fill="none" stroke-width="2"/>
            <path d="M0,700 Q250,650 500,700 T1000,680 T1440,690" stroke="#d1d5db" fill="none" stroke-width="2"/>
        </svg>
    </div>

    <!-- Content Container -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
        <!-- Top Navigation -->
        <div class="flex justify-center items-center gap-4 mb-16">
            <button class="rounded-xl bg-blue-600 text-white px-6 py-3 font-semibold shadow-sm hover:bg-blue-700 transition-colors">
                Get Started
            </button>
            <button class="rounded-xl bg-white text-gray-700 px-6 py-3 font-semibold border border-gray-300 shadow-sm hover:bg-gray-50 transition-colors">
                Learn More
            </button>
        </div>

        <!-- Main Hero Content -->
        <div class="relative max-w-6xl mx-auto">
            <!-- Left Side Elements -->
            <div class="absolute left-0 top-1/2 -translate-y-1/2 space-y-6 hidden lg:block">
                <!-- Instant Transfers Bubble -->
                <div class="relative">
                    <div class="absolute -top-3 -right-2 z-10">
                        <!-- Lightning Bolt Icon -->
                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"/>
                        </svg>
                        <!-- Arrow pointing to bubble -->
                        <div class="absolute top-4 left-3 w-8 h-0.5 bg-gray-300"></div>
                        <div class="absolute top-6 left-9 w-0.5 h-3 bg-gray-300"></div>
                    </div>
                    <div class="bg-gradient-to-r from-orange-400 to-pink-400 rounded-full px-6 py-3 text-white font-medium shadow-lg">
                        Instant Transfers
                    </div>
                </div>

                <!-- Credit Limit Card -->
                <div class="bg-white rounded-2xl p-5 shadow-lg w-56">
                    <h3 class="text-gray-700 text-sm font-medium mb-3">Credit Limit</h3>
                    <div class="text-2xl font-bold text-green-600 mb-3">$ 53,224</div>
                    <div class="relative w-full h-2 bg-gray-200 rounded-full overflow-hidden mb-2">
                        <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-purple-600" style="width: 48%"></div>
                    </div>
                    <div class="text-sm text-gray-600">48%</div>
                </div>

                <!-- Transfer Success Card -->
                <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl p-5 shadow-lg w-56">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                    <div class="text-white font-semibold">Transfer Success!</div>
                </div>

                <!-- User Avatar -->
                <div class="absolute top-64 left-32 bg-white rounded-full p-1 shadow-lg">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-yellow-200 to-orange-200 flex items-center justify-center overflow-hidden">
                        <!-- Simple avatar representation -->
                        <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="8" r="4" fill="#fbbf24"/>
                            <path d="M6 21c0-4 2.686-7 6-7s6 3 6 7" stroke="#fbbf24" stroke-width="2" fill="#fbbf24" fill-opacity="0.5"/>
                            <circle cx="10" cy="8" r="1" fill="white"/>
                            <circle cx="14" cy="8" r="1" fill="white"/>
                            <path d="M10 11c.5 1 1.5 1 3 0" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Central Credit Card -->
            <div class="relative mx-auto w-full max-w-xs lg:max-w-sm z-20">
                <div class="relative bg-gradient-to-b from-purple-700 via-purple-600 to-pink-500 rounded-3xl p-8 shadow-2xl transform rotate-0">
                    <!-- Card Content -->
                    <div class="flex justify-between items-start mb-12">
                        <div class="text-white text-xl font-semibold">Basic</div>
                        <!-- EMV Chip -->
                        <div class="w-12 h-10 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-md flex items-center justify-center">
                            <div class="grid grid-cols-2 gap-0.5 w-8 h-6">
                                <div class="bg-yellow-700 rounded-sm"></div>
                                <div class="bg-yellow-800 rounded-sm"></div>
                                <div class="bg-yellow-800 rounded-sm"></div>
                                <div class="bg-yellow-700 rounded-sm"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-end mt-auto">
                        <div class="text-white">
                            <div class="text-lg font-medium">John D.</div>
                            <div class="text-sm opacity-80">02/30</div>
                        </div>
                        <!-- Butterfly/Abstract Icon -->
                        <div class="w-12 h-12 opacity-50">
                            <svg class="w-full h-full text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C8 2 4.5 4.5 4.5 8.5c0 2 1 3.7 2.5 4.8V14c0 2.2 1.8 4 4 4s4-1.8 4-4v-.7c1.5-1.1 2.5-2.8 2.5-4.8C17.5 4.5 16 2 12 2zm0 2c2.8 0 5 2.2 5 5 0 1.5-.7 2.8-1.8 3.5-.3.2-.5.5-.7.8-.2-.3-.4-.6-.7-.8-1.1-.7-1.8-2-1.8-3.5 0-2.8 2.2-5 5-5zm-5 5c0-1.5.7-2.8 1.8-3.5.3-.2.5-.5.7-.8.2.3.4.6.7.8 1.1.7 1.8 2 1.8 3.5 0 2.8-2.2 5-5 5-2.8 0-5-2.2-5-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side Elements -->
            <div class="absolute right-0 top-1/2 -translate-y-1/2 space-y-6 hidden lg:block">
                <!-- Zero Fees Bubble -->
                <div class="relative">
                    <div class="absolute -top-3 -left-2 z-10">
                        <!-- Shield Icon -->
                        <div class="relative">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white text-xs font-bold">$</div>
                        </div>
                        <!-- Arrow pointing to bubble -->
                        <div class="absolute top-4 right-3 w-8 h-0.5 bg-gray-300"></div>
                        <div class="absolute top-6 right-9 w-0.5 h-3 bg-gray-300"></div>
                    </div>
                    <div class="bg-blue-600 rounded-2xl px-6 py-3 text-white font-medium shadow-lg">
                        Zero Fees
                    </div>
                </div>

                <!-- Investment Target Card -->
                <div class="bg-white rounded-2xl p-5 shadow-lg w-56">
                    <h3 class="text-gray-400 text-sm font-medium mb-3">Investment Target</h3>
                    <div class="text-4xl font-bold text-gray-800">76%</div>
                </div>

                <!-- Balance Card -->
                <div class="bg-white rounded-2xl p-5 shadow-lg w-64">
                    <h3 class="text-gray-700 text-sm font-medium mb-3">Balance</h3>
                    <div class="text-3xl font-bold text-gray-800 mb-4">$ 45,324</div>
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Income Card -->
                        <div class="bg-gradient-to-br from-purple-400 to-purple-500 rounded-xl p-3">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                                <span class="text-white text-xs font-medium">Income</span>
                            </div>
                            <div class="text-white font-semibold">$ 48,000</div>
                        </div>
                        <!-- Expenses Card -->
                        <div class="bg-gradient-to-br from-orange-400 to-pink-400 rounded-xl p-3">
                            <div class="flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                </svg>
                                <span class="text-white text-xs font-medium">Expenses</span>
                            </div>
                            <div class="text-white font-semibold">$ 2,321</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Responsive Layout -->
    <div class="lg:hidden relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-12">
        <div class="flex flex-col items-center space-y-8">
            <!-- Top Navigation -->
            <div class="flex justify-center items-center gap-4">
                <button class="rounded-xl bg-blue-600 text-white px-6 py-3 font-semibold shadow-sm">
                    Get Started
                </button>
                <button class="rounded-xl bg-white text-gray-700 px-6 py-3 font-semibold border border-gray-300 shadow-sm">
                    Learn More
                </button>
            </div>

            <!-- Credit Card (Centered on Mobile) -->
            <div class="relative w-full max-w-xs">
                <div class="relative bg-gradient-to-b from-purple-700 via-purple-600 to-pink-500 rounded-3xl p-8 shadow-2xl">
                    <div class="flex justify-between items-start mb-12">
                        <div class="text-white text-xl font-semibold">Basic</div>
                        <div class="w-12 h-10 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-md flex items-center justify-center">
                            <div class="grid grid-cols-2 gap-0.5 w-8 h-6">
                                <div class="bg-yellow-700 rounded-sm"></div>
                                <div class="bg-yellow-800 rounded-sm"></div>
                                <div class="bg-yellow-800 rounded-sm"></div>
                                <div class="bg-yellow-700 rounded-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-end">
                        <div class="text-white">
                            <div class="text-lg font-medium">John D.</div>
                            <div class="text-sm opacity-80">02/30</div>
                        </div>
                        <div class="w-12 h-12 opacity-50">
                            <svg class="w-full h-full text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C8 2 4.5 4.5 4.5 8.5c0 2 1 3.7 2.5 4.8V14c0 2.2 1.8 4 4 4s4-1.8 4-4v-.7c1.5-1.1 2.5-2.8 2.5-4.8C17.5 4.5 16 2 12 2zm0 2c2.8 0 5 2.2 5 5 0 1.5-.7 2.8-1.8 3.5-.3.2-.5.5-.7.8-.2-.3-.4-.6-.7-.8-1.1-.7-1.8-2-1.8-3.5 0-2.8 2.2-5 5-5zm-5 5c0-1.5.7-2.8 1.8-3.5.3-.2.5-.5.7-.8.2.3.4.6.7.8 1.1.7 1.8 2 1.8 3.5 0 2.8-2.2 5-5 5-2.8 0-5-2.2-5-5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Cards Grid -->
            <div class="grid grid-cols-2 gap-4 w-full max-w-md">
                <!-- Credit Limit -->
                <div class="bg-white rounded-2xl p-4 shadow-lg">
                    <h3 class="text-gray-700 text-xs font-medium mb-2">Credit Limit</h3>
                    <div class="text-xl font-bold text-green-600 mb-2">$ 53,224</div>
                    <div class="relative w-full h-1.5 bg-gray-200 rounded-full overflow-hidden mb-1">
                        <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-purple-600" style="width: 48%"></div>
                    </div>
                    <div class="text-xs text-gray-600">48%</div>
                </div>

                <!-- Investment Target -->
                <div class="bg-white rounded-2xl p-4 shadow-lg">
                    <h3 class="text-gray-400 text-xs font-medium mb-2">Investment Target</h3>
                    <div class="text-3xl font-bold text-gray-800">76%</div>
                </div>

                <!-- Balance -->
                <div class="bg-white rounded-2xl p-4 shadow-lg col-span-2">
                    <h3 class="text-gray-700 text-xs font-medium mb-2">Balance</h3>
                    <div class="text-2xl font-bold text-gray-800 mb-3">$ 45,324</div>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="bg-gradient-to-br from-purple-400 to-purple-500 rounded-lg p-2">
                            <div class="flex items-center gap-1 mb-1">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                                <span class="text-white text-xs">Income</span>
                            </div>
                            <div class="text-white text-sm font-semibold">$ 48,000</div>
                        </div>
                        <div class="bg-gradient-to-br from-orange-400 to-pink-400 rounded-lg p-2">
                            <div class="flex items-center gap-1 mb-1">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                </svg>
                                <span class="text-white text-xs">Expenses</span>
                            </div>
                            <div class="text-white text-sm font-semibold">$ 2,321</div>
                        </div>
                    </div>
                </div>

                <!-- Instant Transfers -->
                <div class="bg-gradient-to-r from-orange-400 to-pink-400 rounded-2xl px-4 py-3 text-white font-medium shadow-lg col-span-2">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"/>
                        </svg>
                        Instant Transfers
                    </div>
                </div>

                <!-- Zero Fees -->
                <div class="bg-blue-600 rounded-2xl px-4 py-3 text-white font-medium shadow-lg col-span-2">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Zero Fees
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-radial {
            background: radial-gradient(circle, var(--tw-gradient-stops));
        }
    </style>
</div>
