@extends('layout')
@section('welcome')
    <section id="donation" class="py-16 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="container mx-auto px-4 relative">
            <!-- Top-right button to go to donation list -->
            <a href="#donation-list"
                class="absolute right-4 top-4 inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-800 text-white font-semibold rounded-full shadow-lg transition duration-300 text-base gap-2 z-20">
                <i class="fas fa-list-alt"></i>
                {{ __('messages.my_donations') }}
            </a>
            <h2 class="text-3xl font-bold text-center mb-12 section-title mx-auto">{{ __('messages.donation_title') }}</h2>
            <div class="max-w-5xl mx-auto" x-data="donationComponent()">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Card 1: Small -->
                    <div @click="showForm = true; customAmount = false; amount = 10"
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all border-t-4 border-blue-400 hover:border-blue-600 flex flex-col items-center p-8 cursor-pointer text-center">
                        <div class="bg-blue-100 rounded-full p-4 mb-4">
                            <i class="fas fa-hand-holding-heart text-blue-500 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-2 w-full">{{ __('messages.donation_small') }}</h3>
                        <div class="text-2xl font-bold text-blue-600 mb-1 w-full">€10</div>
                        <div class="text-xs text-gray-400 mb-4 w-full">/ {{ __('messages.donation_once') }}</div>
                        <ul class="text-gray-600 text-sm mb-6 space-y-1 w-full flex flex-col items-center">
                            <li>{{ __('messages.donation_benefit_1') }}</li>
                            <li>{{ __('messages.donation_benefit_2') }}</li>
                        </ul>
                        <button type="button"
                            class="mt-auto w-full py-2 rounded-lg bg-blue-500 text-white font-medium hover:bg-blue-600 transition">{{ __('messages.donate_now') }}</button>
                    </div>
                    <!-- Card 2: Medium (Featured) -->
                    <div @click="showForm = true; customAmount = false; amount = 50"
                        class="group bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all border-t-4 border-yellow-400 hover:border-yellow-500 flex flex-col items-center p-8 relative cursor-pointer scale-105 z-10 text-center">
                        <div
                            class="absolute -top-5 left-1/2 -translate-x-1/2 bg-yellow-400 text-white px-4 py-1 rounded-full text-xs font-bold shadow">
                            {{ __('messages.popular') }}</div>
                        <div class="bg-yellow-100 rounded-full p-4 mb-4">
                            <i class="fas fa-star text-yellow-500 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-2 w-full">{{ __('messages.donation_medium') }}</h3>
                        <div class="text-2xl font-bold text-yellow-600 mb-1 w-full">€50</div>
                        <div class="text-xs text-gray-400 mb-4 w-full">/ {{ __('messages.donation_once') }}</div>
                        <ul class="text-gray-600 text-sm mb-6 space-y-1 w-full flex flex-col items-center">
                            <li>{{ __('messages.donation_benefit_1') }}</li>
                            <li>{{ __('messages.donation_benefit_2') }}</li>
                            <li>{{ __('messages.donation_benefit_3') }}</li>
                        </ul>
                        <button type="button"
                            class="mt-auto w-full py-2 rounded-lg bg-yellow-400 text-white font-medium hover:bg-yellow-500 transition">{{ __('messages.donate_now') }}</button>
                    </div>
                    <!-- Card 3: Large -->
                    <div @click="showForm = true; customAmount = false; amount = 100"
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all border-t-4 border-blue-900 hover:border-blue-700 flex flex-col items-center p-8 cursor-pointer text-center">
                        <div class="bg-blue-200 rounded-full p-4 mb-4">
                            <i class="fas fa-gem text-blue-900 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-2 w-full">{{ __('messages.donation_large') }}</h3>
                        <div class="text-2xl font-bold text-blue-900 mb-1 w-full">€100</div>
                        <div class="text-xs text-gray-400 mb-4 w-full">/ {{ __('messages.donation_once') }}</div>
                        <ul class="text-gray-600 text-sm mb-6 space-y-1 w-full flex flex-col items-center">
                            <li>{{ __('messages.donation_benefit_1') }}</li>
                            <li>{{ __('messages.donation_benefit_2') }}</li>
                            <li>{{ __('messages.donation_benefit_3') }}</li>
                            <li>{{ __('messages.donation_benefit_4') }}</li>
                        </ul>
                        <button type="button"
                            class="mt-auto w-full py-2 rounded-lg bg-blue-900 text-white font-medium hover:bg-blue-800 transition">{{ __('messages.donate_now') }}</button>
                    </div>
                    <!-- Card 4: Custom Amount -->
                    <div @click="showForm = true; customAmount = true; amount = null"
                        class="group bg-gradient-to-br from-gray-50 to-blue-100 rounded-2xl shadow-lg hover:shadow-2xl transition-all border-t-4 border-gray-300 hover:border-blue-400 flex flex-col items-center p-8 cursor-pointer text-center">
                        <div class="bg-white rounded-full p-4 mb-4 shadow">
                            <i class="fas fa-euro-sign text-gray-500 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold mb-2 w-full">{{ __('messages.donation_custom_amount') }}</h3>
                        <div class="text-2xl font-bold text-gray-700 mb-1 w-full">{{ __('messages.donation_custom') }}
                        </div>
                        <div class="text-xs text-gray-400 mb-4 w-full">{{ __('messages.donation_custom_desc') }}</div>
                        <button type="button"
                            class="mt-auto w-full py-2 rounded-lg bg-gray-300 text-gray-700 font-medium hover:bg-blue-400 hover:text-white transition flex items-center justify-center">
                            <i class="fas fa-heart mr-2"></i> {{ __('messages.donation_custom') }}
                        </button>
                    </div>
                </div>
                <!-- Donation Form (hidden by default, shown on card click) -->
                <div x-show="showForm" x-transition
                    class="max-w-4xl mx-auto mt-12 bg-gradient-to-br from-blue-100 via-white to-blue-50 rounded-3xl shadow-2xl p-10 border-2 border-blue-200 relative overflow-hidden"
                    x-cloak>
                    <!-- Decorative background shapes -->
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-blue-200 opacity-20 rounded-full z-0"></div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-300 opacity-10 rounded-full z-0"></div>
                    <h3 class="text-2xl font-extrabold mb-8 text-blue-900 text-center z-10 relative">
                        <i class="fas fa-donate text-blue-400 text-3xl block mb-2"></i>
                        {{ __('messages.donation_details') }}
                    </h3>
                    @auth
                        <form method="POST" action="{{ route('donations.submit') }}" class="space-y-8 z-10 relative"
                            x-data="{ valid: false, showSuccess: false }" @input="valid = $el.checkValidity()"
                            @submit.prevent="if(valid){ showSuccess = true; setTimeout(() => { $el.submit(); }, 1800); }">
                            @csrf
                            <!-- Display user info (readonly) -->
                            <div class="bg-blue-50 p-4 rounded-xl mb-6">
                                <h4 class="font-semibold text-blue-800 mb-2">{{ __('messages.your_information') }}</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">{{ __('messages.full_name') }}</p>
                                        <p class="font-medium">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Email</p>
                                        <p class="font-medium">{{ auth()->user()->email }}</p>
                                    </div>
                                    @if(auth()->user()->phone)
                                    <div>
                                        <p class="text-sm text-gray-600">{{ __('messages.phone') }}</p>
                                        <p class="font-medium">{{ auth()->user()->phone }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Association selector -->
                            <div class="mt-6">
                                <label for="association_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('messages.select_association') }}
                                </label>
                                <select id="association_id" name="association_id" required
                                    class="block w-full pl-3 pr-10 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="" disabled selected>{{ __('messages.choose_association') }}</option>
                                    @foreach($associations as $association)
                                        <option value="{{ $association->id }}">{{ $association->nom }}</option>
                                    @endforeach
                                </select>
                                @error('association_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Amount input -->
                            <div class="mt-6">
                                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('messages.amount') }} (€)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-euro-sign text-gray-400"></i>
                                    </div>
                                    <input type="number" id="amount" name="amount" x-model="amount"
                                        step="0.01" min="1" required
                                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="0.00">
                                </div>
                                @error('amount')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- Hidden fields for user data -->
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <!-- Submit button -->
                            <div class="mt-8">
                                <button type="submit" :disabled="!valid"
                                    :class="valid ? 'bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800' :
                                        'bg-gray-300 text-gray-400 cursor-not-allowed'"
                                    class="w-full py-4 rounded-xl text-white font-extrabold text-lg flex items-center justify-center gap-2 shadow-lg transition">
                                    <i class="fas fa-euro-sign mr-2"></i> {{ __('messages.donate_now') }}
                                </button>
                                <div x-show="showSuccess" x-transition class="flex flex-col items-center justify-center mt-8">
                                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-check-circle text-green-500 text-3xl animate-bounce"></i>
                                    </div>
                                    <h4 class="text-xl font-bold text-green-700">{{ __('messages.thank_you') }}!</h4>
                                    <p class="text-green-600">{{ __('messages.donation_processing') }}</p>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        {{ __('messages.please_login_to_donate') }}
                                        <a href="{{ route('login') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">
                                            {{ __('messages.login_here') }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
        <!-- Donation List Section -->
        <div id="donation-list" class="my-12">
            <div
                class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-6 border border-blue-100 donation-fadein group transition-all duration-500">
                <h2 class="text-2xl font-bold mb-6 text-blue-900">{{ __('messages.my_donations') }}</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-blue-100 via-blue-50 to-blue-100 text-blue-900">
                                <th class="px-6 py-3 text-left font-semibold border-b border-blue-100">
                                    {{ __('messages.amount') }}
                                </th>
                                <th class="px-6 py-3 text-left font-semibold border-b border-blue-100">
                                    {{ __('messages.association') }}
                                </th>
                                <th class="px-6 py-3 text-left font-semibold border-b border-blue-100">
                                    {{ __('messages.status') }}
                                </th>
                                <th class="px-6 py-3 text-left font-semibold border-b border-blue-100">
                                    {{ __('messages.date') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donations as $donation)
                                <tr class="hover:bg-blue-50 hover:scale-[1.01] transition-all duration-300">
                                    <td class="border-t px-6 py-4 text-lg font-semibold text-blue-700">
                                        {{ number_format($donation->amount, 2, ',', ' ') }} €
                                    </td>
                                    <td class="border-t px-6 py-4">
                                        {{ optional($donation->association)->name ?? '-' }}
                                    </td>
                                    <td class="border-t px-6 py-4">
                                        @if ($donation->status === 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ __('messages.pending') }}
                                            </span>
                                        @elseif($donation->status === 'validated')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                {{ __('messages.validated') }}
                                            </span>
                                        @elseif($donation->status === 'transferred')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-double mr-1"></i>
                                                {{ __('messages.transferred') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                                {{ $donation->status }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="border-t px-6 py-4 text-gray-600">
                                        <div class="flex items-center">
                                            <i class="far fa-calendar-alt mr-2 text-blue-400"></i>
                                            {{ $donation->created_at->format('d M Y') }}
                                        </div>
                                        <div class="text-sm text-gray-400">
                                            {{ $donation->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-blue-500 py-8 bg-blue-50 rounded-lg">
                                        <i class="fas fa-info-circle mr-2 animate-bounce text-2xl"></i>
                                        {{ __('messages.no_donations') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <style>
            html {
                scroll-behavior: smooth;
            }
            .donation-fadein {
                opacity: 0;
                transform: translateY(40px);
                transition: opacity 0.7s cubic-bezier(.4, 0, .2, 1), transform 0.7s cubic-bezier(.4, 0, .2, 1);
            }
            .donation-fadein.visible {
                opacity: 1;
                transform: none;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script>
            function donationComponent() {
                return {
                    showForm: false,
                    customAmount: false,
                    amount: null
                }
            }
            document.addEventListener('DOMContentLoaded', function() {
                var el = document.querySelector('.donation-fadein');
                if (!el) return;
                function onScroll() {
                    var rect = el.getBoundingClientRect();
                    if (rect.top < window.innerHeight - 100) {
                        el.classList.add('visible');
                        window.removeEventListener('scroll', onScroll);
                    }
                }
                window.addEventListener('scroll', onScroll);
                onScroll();
            });
        </script>
    </section>
@endsection
