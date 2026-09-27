<header class="bg-white shadow">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <a href="#" class="text-2xl font-bold text-primary-color flex items-center">
            <span class="text-accent-color mr-2"><i class="fas fa-mosque"></i></span>
            Chafaf
        </a>
        
        <nav class="hidden md:flex space-x-8">
            <a href="#" class="nav-link">{{ __('messages.home') }}</a>
            <a href="#features" class="nav-link">{{ __('messages.features') }}</a>
            <a href="#prayer-times" class="nav-link">{{ __('messages.prayer_times') }}</a>
            <a href="#quran" class="nav-link">{{ __('messages.quran') }}</a>
            <a href="#community" class="nav-link">{{ __('messages.community') }}</a>
            <a href="#contact" class="nav-link">{{ __('messages.contact') }}</a>
            
            <div class="relative" id="language-dropdown">
                <button class="nav-link flex items-center" id="language-toggle">
                    <span class="mr-1">{{ strtoupper(app()->getLocale()) }}</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div class="language-menu absolute top-full right-0 mt-2 bg-white rounded-lg shadow-lg z-50 w-48 py-2" id="language-menu">
                    <a href="{{ route('language.switch', 'fr') }}" class="language-option block px-4 py-2 hover:bg-gray-100 flex items-center">
                        <div class="language-flag-box mr-3">
                            <div class="language-flag language-flag-fr"></div>
                        </div>
                        <span>Français</span>
                    </a>
                    <a href="{{ route('language.switch', 'en') }}" class="language-option block px-4 py-2 hover:bg-gray-100 flex items-center">
                        <div class="language-flag-box mr-3">
                            <div class="language-flag language-flag-en"></div>
                        </div>
                        <span>English</span>
                    </a>
                    <a href="{{ route('language.switch', 'ar') }}" class="language-option block px-4 py-2 hover:bg-gray-100 flex items-center">
                        <div class="language-flag-box mr-3">
                            <div class="language-flag language-flag-ar"></div>
                        </div>
                        <span>العربية</span>
                    </a>
                </div>
            </div>
        </nav>
        
        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-primary-color">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200 py-3 px-4">
        <nav class="flex flex-col space-y-3">
            <a href="#" class="nav-link">{{ __('messages.home') }}</a>
            <a href="#features" class="nav-link">{{ __('messages.features') }}</a>
            <a href="#prayer-times" class="nav-link">{{ __('messages.prayer_times') }}</a>
            <a href="#quran" class="nav-link">{{ __('messages.quran') }}</a>
            <a href="#community" class="nav-link">{{ __('messages.community') }}</a>
            <a href="#contact" class="nav-link">{{ __('messages.contact') }}</a>
            
            <div class="pt-2 border-t border-gray-200">
                <p class="text-sm text-gray-600 mb-2">{{ __('messages.language') }}</p>
                <div class="flex space-x-4">
                    <a href="{{ route('language.switch', 'fr') }}" class="language-option flex items-center">
                        <div class="language-flag-box">
                            <div class="language-flag language-flag-fr"></div>
                        </div>
                    </a>
                    <a href="{{ route('language.switch', 'en') }}" class="language-option flex items-center">
                        <div class="language-flag-box">
                            <div class="language-flag language-flag-en"></div>
                        </div>
                    </a>
                    <a href="{{ route('language.switch', 'ar') }}" class="language-option flex items-center">
                        <div class="language-flag-box">
                            <div class="language-flag language-flag-ar"></div>
                        </div>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>
