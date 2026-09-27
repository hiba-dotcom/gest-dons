<x-app-layout>
    <x-slot name="header">
        <h2 class="font-amiri text-xl text-gray-800 leading-tight">

            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Prayer Times Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-gradient-to-r from-emerald-600 to-emerald-800 text-white">
                    <h3 class="text-2xl font-amiri mb-4">{{ __('Prayer Times') }}</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <div class="text-center p-4 bg-white/10 rounded-lg">
                            <div class="text-sm">{{ __('Fajr') }}</div>
                            <div class="text-xl font-bold">05:30</div>
                        </div>
                        <div class="text-center p-4 bg-white/10 rounded-lg">
                            <div class="text-sm">{{ __('Dhuhr') }}</div>
                            <div class="text-xl font-bold">13:15</div>
                        </div>
                        <div class="text-center p-4 bg-white/10 rounded-lg">
                            <div class="text-sm">{{ __('Asr') }}</div>
                            <div class="text-xl font-bold">16:45</div>
                        </div>
                        <div class="text-center p-4 bg-white/10 rounded-lg">
                            <div class="text-sm">{{ __('Maghrib') }}</div>
                            <div class="text-xl font-bold">19:30</div>
                        </div>
                        <div class="text-center p-4 bg-white/10 rounded-lg">
                            <div class="text-sm">{{ __('Isha') }}</div>
                            <div class="text-xl font-bold">21:00</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Quran Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-amiri text-gray-900">{{ __('Quran') }}</h3>
                                <p class="text-sm text-gray-600">{{ __('Read and explore the Holy Quran') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Zakat Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-amiri text-gray-900">{{ __('Zakat Calculator') }}</h3>
                                <p class="text-sm text-gray-600">{{ __('Calculate your Zakat') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Donations Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-amiri text-gray-900">{{ __('Donations') }}</h3>
                                <p class="text-sm text-gray-600">{{ __('Make a donation') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hijri Calendar Section -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-amiri text-gray-900 mb-4">{{ __('Islamic Calendar') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-emerald-50 p-4 rounded-lg">
                            <div class="text-center">
                                <div class="text-2xl font-amiri text-emerald-800">1445</div>
                                <div class="text-sm text-emerald-600">{{ __('Hijri Year') }}</div>
                            </div>
                        </div>
                        <div class="bg-emerald-50 p-4 rounded-lg">
                            <div class="text-center">
                                <div class="text-2xl font-amiri text-emerald-800">Ramadan</div>
                                <div class="text-sm text-emerald-600">{{ __('Current Month') }}</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout> 

