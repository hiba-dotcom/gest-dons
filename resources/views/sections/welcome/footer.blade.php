<footer id="contact" class="footer py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Column 1: About -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-white">{{ __('messages.about_us') }}</h3>
                <p class="text-white/80 mb-6">{{ __('messages.footer_about') }}</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-accent-color transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-white hover:text-accent-color transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-white hover:text-accent-color transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-white hover:text-accent-color transition">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            
            <!-- Column 2: Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-white">{{ __('messages.quick_links') }}</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="text-white/80 hover:text-accent-color transition">{{ __('messages.home') }}</a>
                    </li>
                    <li>
                        <a href="#prayer-times" class="text-white/80 hover:text-accent-color transition">{{ __('messages.prayer_times') }}</a>
                    </li>
                    <li>
                        <a href="#quran" class="text-white/80 hover:text-accent-color transition">{{ __('messages.quran') }}</a>
                    </li>
                    <li>
                        <a href="#community" class="text-white/80 hover:text-accent-color transition">{{ __('messages.community') }}</a>
                    </li>
                    <li>
                        <a href="#donation" class="text-white/80 hover:text-accent-color transition">{{ __('messages.donations') }}</a>
                    </li>
                </ul>
            </div>
            
            <!-- Column 3: Services -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-white">{{ __('messages.services') }}</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="text-white/80 hover:text-accent-color transition">{{ __('messages.prayer_calendar') }}</a>
                    </li>
                    <li>
                        <a href="#" class="text-white/80 hover:text-accent-color transition">{{ __('messages.quran_lessons') }}</a>
                    </li>
                    <li>
                        <a href="#" class="text-white/80 hover:text-accent-color transition">{{ __('messages.islamic_courses') }}</a>
                    </li>
                    <li>
                        <a href="#" class="text-white/80 hover:text-accent-color transition">{{ __('messages.community_events') }}</a>
                    </li>
                    <li>
                        <a href="#" class="text-white/80 hover:text-accent-color transition">{{ __('messages.charity_programs') }}</a>
                    </li>
                </ul>
            </div>
            
            <!-- Column 4: Contact -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-white">{{ __('messages.contact_us') }}</h3>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <span class="text-accent-color mr-3 mt-1"><i class="fas fa-map-marker-alt"></i></span>
                        <span class="text-white/80">123 Rue de la Mosquée, 75001 Paris, France</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-accent-color mr-3 mt-1"><i class="fas fa-phone-alt"></i></span>
                        <span class="text-white/80">+33 1 23 45 67 89</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-accent-color mr-3 mt-1"><i class="fas fa-envelope"></i></span>
                        <span class="text-white/80">contact@chafaf.com</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-blue-800 mt-12 pt-6 text-center text-white/70">
            <p>&copy; {{ date('Y') }} Chafaf. {{ __('messages.all_rights_reserved') }}</p>
        </div>
    </div>
</footer>
