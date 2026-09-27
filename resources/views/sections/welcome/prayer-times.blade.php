<section id="prayer-times" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12 section-title mx-auto">{{ __('messages.prayer_times_title') }}</h2>
        
        <div class="prayer-times p-6 max-w-4xl mx-auto">
            <!-- Current Date Section with Animated Icon -->
            <div class="bg-white p-4 rounded-lg mb-6 flex items-center justify-between relative overflow-hidden">
                <div class="flex items-center z-10">
                    <!-- Animated Calendar Icon -->
                    <div class="mr-4 text-2xl text-indigo-500 animate-float">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                        <h3 class="font-bold">{{ __('messages.current_date') }}</h3>
                        <p id="current-date" class="text-gray-600">{{ date('l, d F Y') }}</p>
                    </div>
                </div>
                <!-- Decorative Element -->
                <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-gradient-to-tr from-blue-50 to-transparent rounded-full opacity-70 animate-pulse-slow"></div>
            </div>
            
            <!-- Hijri Calendar Section -->
            <div class="bg-white p-4 rounded-lg mb-6 relative overflow-hidden">
                <div class="flex items-center justify-between z-10 relative">
                    <!-- Animated Star Icon -->
                    <div class="flex items-center">
                        <div class="mr-4 text-2xl text-amber-500 animate-twinkle">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <h3 class="font-bold">{{ __('messages.hijri_date') }}</h3>
                            <p id="hijri-date" class="text-gray-600">
                                <span class="text-base font-medium">{{ __('messages.loading') }}</span>
                                <span class="animate-ellipsis">...</span>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Decorative Dots -->
                <div class="absolute top-0 right-0 w-full h-full">
                    <div class="absolute top-2 right-2 w-2 h-2 bg-amber-200 rounded-full animate-spin-slow"></div>
                    <div class="absolute top-6 right-8 w-1 h-1 bg-amber-300 rounded-full animate-spin-slow delay-300"></div>
                    <div class="absolute top-12 right-4 w-1.5 h-1.5 bg-amber-100 rounded-full animate-spin-slow delay-700"></div>
                </div>
            </div>
            
            <!-- Current Prayer Section -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 rounded-lg mb-6 relative overflow-hidden transform transition-transform hover:translate-y-[-5px]">
                <div class="flex items-center justify-between z-10 relative">
                    <div class="flex items-center">
                        <div class="relative mr-4">
                            <!-- Pulsing Circle -->
                            <div class="absolute inset-0 bg-emerald-300 rounded-full animate-ping opacity-25"></div>
                            <div class="relative z-10 text-2xl text-emerald-600">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold">{{ __('messages.current_prayer') }}</h3>
                            <p id="current-prayer" class="text-gray-600">
                                <span class="text-base font-medium">{{ __('messages.loading') }}</span>
                                <span class="animate-ellipsis">...</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">{{ __('messages.next_prayer') }}:</p>
                        <p id="next-prayer-countdown" class="font-mono text-emerald-600">
                            <span class="text-base font-medium">{{ __('messages.loading') }}</span>
                            <span class="animate-pulse">...</span>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Prayer Times Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Fajr Prayer -->
                <div class="prayer-time-item transition-all duration-300 hover:bg-indigo-50 hover:border hover:border-indigo-200 group">
                    <div class="flex items-center mb-2">
                        <!-- Indigo Scintillating Icon for Fajr -->
                        <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3 text-indigo-600 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 animate-twinkle">
                            <i class="fas fa-sun text-xl" style="text-shadow: 0 0 10px rgba(99, 102, 241, 0.5);"></i>
                        </div>
                        <h4 class="font-bold">{{ __('messages.fajr') }}</h4>
                    </div>
                    <p id="fajr-time" class="text-xl font-medium text-gray-700">
                        <span class="text-base font-medium">{{ __('messages.loading') }}</span>
                        <span class="animate-pulse">...</span>
                    </p>
                </div>
                
                <!-- Sunrise Prayer -->
                <div class="prayer-time-item transition-all duration-300 hover:bg-orange-50 hover:border hover:border-orange-200 group">
                    <div class="flex items-center mb-2">
                        <!-- Orange Sunrise Animation Icon -->
                        <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3 text-orange-500 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 animate-sunrise">
                            <i class="fas fa-sun text-xl" style="text-shadow: 0 0 10px rgba(249, 115, 22, 0.5);"></i>
                        </div>
                        <h4 class="font-bold">{{ __('messages.sunrise') }}</h4>
                    </div>
                    <p id="sunrise-time" class="text-xl font-medium text-gray-700">
                        <span class="text-base font-medium">{{ __('messages.loading') }}</span>
                        <span class="animate-pulse">...</span>
                    </p>
                </div>
                
                <!-- Dhuhr Prayer -->
                <div class="prayer-time-item transition-all duration-300 hover:bg-amber-50 hover:border hover:border-amber-200 group">
                    <div class="flex items-center mb-2">
                        <!-- Amber Pulsing Icon for Dhuhr -->
                        <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3 text-amber-500 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 animate-pulse">
                            <i class="fas fa-sun text-xl" style="text-shadow: 0 0 10px rgba(245, 158, 11, 0.5);"></i>
                        </div>
                        <h4 class="font-bold">{{ __('messages.dhuhr') }}</h4>
                    </div>
                    <p id="dhuhr-time" class="text-xl font-medium text-gray-700">
                        <span class="text-base font-medium">{{ __('messages.loading') }}</span>
                        <span class="animate-pulse">...</span>
                    </p>
                </div>
                
                <!-- Asr Prayer -->
                <div class="prayer-time-item transition-all duration-300 hover:bg-emerald-50 hover:border hover:border-emerald-200 group">
                    <div class="flex items-center mb-2">
                        <!-- Emerald Rotating Icon for Asr -->
                        <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3 text-emerald-500 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 animate-spin-slow">
                            <i class="fas fa-sun text-xl" style="text-shadow: 0 0 10px rgba(16, 185, 129, 0.5);"></i>
                        </div>
                        <h4 class="font-bold">{{ __('messages.asr') }}</h4>
                    </div>
                    <p id="asr-time" class="text-xl font-medium text-gray-700">
                        <span class="text-base font-medium">{{ __('messages.loading') }}</span>
                        <span class="animate-pulse">...</span>
                    </p>
                </div>
                
                <!-- Maghrib Prayer -->
                <div class="prayer-time-item transition-all duration-300 hover:bg-red-50 hover:border hover:border-red-200 group">
                    <div class="flex items-center mb-2">
                        <!-- Red Sunset Animation Icon for Maghrib -->
                        <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3 text-red-500 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 animate-sunset">
                            <i class="fas fa-sun text-xl" style="text-shadow: 0 0 10px rgba(239, 68, 68, 0.5);"></i>
                        </div>
                        <h4 class="font-bold">{{ __('messages.maghrib') }}</h4>
                    </div>
                    <p id="maghrib-time" class="text-xl font-medium text-gray-700">
                        <span class="text-base font-medium">{{ __('messages.loading') }}</span>
                        <span class="animate-pulse">...</span>
                    </p>
                </div>
                
                <!-- Isha Prayer -->
                <div class="prayer-time-item transition-all duration-300 hover:bg-purple-50 hover:border hover:border-purple-200 group">
                    <div class="flex items-center mb-2">
                        <!-- Purple Floating Icon for Isha -->
                        <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3 text-purple-500 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300 animate-float">
                            <i class="fas fa-moon text-xl" style="text-shadow: 0 0 10px rgba(139, 92, 246, 0.5);"></i>
                        </div>
                        <h4 class="font-bold">{{ __('messages.isha') }}</h4>
                    </div>
                    <p id="isha-time" class="text-xl font-medium text-gray-700">
                        <span class="text-base font-medium">{{ __('messages.loading') }}</span>
                        <span class="animate-pulse">...</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
