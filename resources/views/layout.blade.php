<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chafaf - Portail Islamique</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/hijri-date/lib/hijri-date.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #060854;
            --secondary-color: #50D894;
            --accent-color: #50D894;
            --accent-light: #6FDFA7;
            --background-light: #F8FAFC;
            --text-color: #060854;
            --gold: #F59E0B;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background-color: var(--background-light);
        }

        .btn-primary {
            background-color: var(--secondary-color);
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.25);
        }

        .btn-primary:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(59, 130, 246, 0.3);
        }

        .header-section {
            background-color: var(--primary-color);
            color: white;
            background-image: url('https://images.unsplash.com/photo-1564769625688-8654b7f90667?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
            position: relative;
        }

        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(30, 58, 138, 0.85);
            z-index: 1;
        }

        .header-section>div {
            position: relative;
            z-index: 2;
        }

        .footer {
            background-color: var(--primary-color);
            color: white;
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--accent-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Navigation -->

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    @auth
                    <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-gray-800 flex items-center">
                        <img src="{{ asset('images/logochafaf.png') }}" alt="Chafaf Logo" class="h-10 mr-3">
                        
                    </a>
                    @else
                    <a href="{{ route('welcome') }}" class="text-2xl font-bold text-gray-800 flex items-center">
                        <img src="{{ asset('images/logochafaf.png') }}" alt="Chafaf Logo" class="h-20 mr-3">
                      
                    </a>
                    @endauth
                </div>
                <div class="hidden lg:flex space-x-3 xl:space-x-4">

                    <a href="/" class="nav-link text-gray-700 hover:text-blue-800 font-medium text-sm xl:text-base">{{ __('messages.home') }}</a>
                    <a href="{{ route('cours') }}" class="nav-link text-gray-700 hover:text-blue-800 font-medium text-sm xl:text-base {{ request()->is('cours') ? 'text-blue-800 font-semibold' : '' }}">{{ __('messages.courses') }}</a>
                    <a href="{{ route('evenements.liste') }}" class="nav-link text-gray-700 hover:text-blue-800 font-medium text-sm xl:text-base">{{ __('messages.event') }}</a>
                    <a href="{{ route('voir_mosquees') }}" class="nav-link text-gray-700 hover:text-blue-800 font-medium text-sm xl:text-base">{{ __('messages.mosques') }}</a>
                    <a href="{{ route('associations')}}" class="nav-link text-gray-700 hover:text-blue-800 font-medium text-sm xl:text-base {{ request()->is('association') ? 'text-blue-800 font-semibold' : '' }}">{{ __('messages.associations') ?? 'Associations' }}</a>
                    <a href="{{ route ('quran.index')}}" class="nav-link text-gray-700 hover:text-blue-800 font-medium text-sm xl:text-base {{ request()->is('quran.index') ? 'text-blue-800 font-semibold' : '' }}">{{ __('messages.quran') }}</a>
                    <a href="{{ route('zakaat')}}" class="nav-link text-gray-700 hover:text-blue-800 font-medium text-sm xl:text-base {{ request()->is('zakaat') ? 'text-blue-800 font-semibold' : '' }}">{{ __('messages.zakaat') }}</a>
                    <a href="{{route ('aladhan')}}" class="nav-link text-gray-700 hover:text-blue-800 font-medium text-sm xl:text-base {{ request()->is('aladhan') ? 'text-blue-800 font-semibold' : '' }}">{{ __('messages.prayer_times') }}</a>
                    <a href="{{ route('calendrier')}}" class="nav-link text-gray-700 hover:text-blue-800 font-medium text-sm xl:text-base {{ request()->is('calendrier') ? 'text-blue-800 font-semibold' : '' }}">{{ __('messages.hijri_calendar') }}</a>
                    <a href="{{ route('donations') }}" class="nav-link text-gray-700 hover:text-blue-800 font-medium text-sm xl:text-base {{ request()->is('donations') ? 'text-blue-800 font-semibold' : '' }}">{{ __('messages.donate') }}</a>
                    
                </div>


                <div class="flex items-center space-x-1">
                    @if (Route::has('login'))
                    @auth
                    {{-- Display dashboard icon based on user role --}}
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-blue-800 p-2 rounded-lg hover:bg-gray-100 transition duration-200" title="Dashboard Admin">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </a>
                    @endif

                    @if(auth()->user()->role === 'imam')
                    <a href="{{ route('imam.dashboard') }}" class="text-gray-600 hover:text-blue-800 p-2 rounded-lg hover:bg-gray-100 transition duration-200" title="Dashboard Admin">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </a>
                    @endif

                    @auth
                    @if(Auth::user()->role === 'président')
                    <a href="{{ route('president.dashboard') }}" class="text-gray-600 hover:text-blue-800 p-2 rounded-lg hover:bg-gray-100 transition duration-200" title="Dashboard Admin">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </a>
                    @endif
                    @endauth

                    @auth
                    @if(Auth::user()->role === 'chefDeMosquee')
                    <a href="{{ route('chefmosque.dashboard') }}" class="text-gray-600 hover:text-blue-800 p-2 rounded-lg hover:bg-gray-100 transition duration-200" title="Dashboard Admin">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </a>
                    @endif
                    @endauth


                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            Déconnexion
                        </button>
                    </form>

                    @else
                    <a href="{{ route('login') }}" class="btn-primary px-4 py-2 rounded-full text-sm font-medium">Connexion</a>
                    <a href="{{ route('register') }}" class="border border-blue-800 text-blue-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-blue-800 hover:text-white transition duration-300">Inscription</a>
                    @if (Route::has('register'))
                    @endif
                    @endauth
                    @endif

                    <div class="lg:hidden">
                        <button type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none" id="mobile-menu-button">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @yield('post-imam')
    @yield('messages')
    @yield('event')
    @yield('voir_mosquees')
    @yield('PostulationImam')
    @yield('post')
    @yield('postulationschef')
    @yield('listMosquees')
    @yield('mosquees')
    @yield('coran')
    @yield('zakaat')
    @yield('welcome')
    @yield('sendZakaat')
    @yield('calendrier')
    @yield('aladhan')
    @yield('associations')
    @yield('AssociationPostulation')
    @yield('evenements')
    @yield('cours')
    @yield('coursDetails')
    @yield('articleDetails')

    @yield('scripts')

    <!-- Footer -->
    <footer class="footer py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                    <img src="{{ asset('images/logochafaf.png') }}" alt="Chafaf Logo" class="h-16 w-auto bg-white">
                    </div>
                    <p class="mb-4 opacity-80">Votre portail islamique transparent et fiable pour la communauté
                        musulmane francophone.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-white opacity-80 hover:opacity-100 hover:transform hover:scale-110 transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-white opacity-80 hover:opacity-100 hover:transform hover:scale-110 transition-all">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-white opacity-80 hover:opacity-100 hover:transform hover:scale-110 transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-white opacity-80 hover:opacity-100 hover:transform hover:scale-110 transition-all">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Liens Rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="opacity-80 hover:opacity-100 hover:translate-x-1 inline-block transition-transform">{{ __('messages.home') }}</a></li>
                        <li><a href="#cours" class="opacity-80 hover:opacity-100 hover:translate-x-1 inline-block transition-transform">{{ __('messages.courses') }}</a></li>
                        <li><a href="#mosquees" class="opacity-80 hover:opacity-100 hover:translate-x-1 inline-block transition-transform">{{ __('messages.mosques') }}</a></li>
                        <li><a href="{{ route('evenements') }}" class="opacity-80 hover:opacity-100 hover:translate-x-1 inline-block transition-transform">{{ __('messages.events') }}</a></li>
                        <li><a href="#coran" class="opacity-80 hover:opacity-100 hover:translate-x-1 inline-block transition-transform">{{ __('messages.quran') }}</a></li>
                        <li><a href="#zakaat" class="opacity-80 hover:opacity-100 hover:translate-x-1 inline-block transition-transform">{{ __('messages.zakaat') }}</a></li>
                        <li><a href="#adhan" class="opacity-80 hover:opacity-100 hover:translate-x-1 inline-block transition-transform">{{ __('messages.prayer_times') }}</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Ressources</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="opacity-80 hover:opacity-100 hover:translate-x-1 inline-block transition-transform">{{ __('messages.blog') }}</a></li>
                        <li><a href="#" class="opacity-80 hover:opacity-100 hover:translate-x-1 inline-block transition-transform">{{ __('messages.faq') }}</a></li>
                        <li><a href="#" class="opacity-80 hover:opacity-100 hover:translate-x-1 inline-block transition-transform">{{ __('messages.events') }}</a></li>
                        <li><a href="#" class="opacity-80 hover:opacity-100 hover:translate-x-1 inline-block transition-transform">{{ __('messages.downloads') }}</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Contact</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 opacity-80"></i>
                            <span class="opacity-80">{{ __('messages.address') }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3 opacity-80"></i>
                            <span class="opacity-80">{{ __('messages.phone') }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 opacity-80"></i>
                            <span class="opacity-80">{{ __('messages.email') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-blue-700 mt-12 pt-8 text-center opacity-80">
                <p>&copy; {{ date('Y') }} Chafaf. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="fixed inset-0 bg-blue-900 bg-opacity-95 z-50 hidden">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center mb-8">
                <a href="#" class="text-2xl font-bold text-white flex items-center">
                    <img src="https://i.ibb.co/Jt8MZY5/islamic-logo.png" alt="Chafaf Logo" class="h-10 mr-3">
                    <span>Chafaf</span>
                </a>
                <button id="close-menu" class="text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <nav class="flex flex-col space-y-4">
                <a href="#" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.home') }}</a>
                <a href="#cours" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.courses') }}</a>
                <a href="{{ route('evenements') }}" class="text-white text-xl py-2 border-b border-blue-800"><i class="fas fa-calendar-alt mr-2"></i>{{ __('messages.events') }}</a>
                <a href="#mosquees" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.mosques') }}</a>
                <a href="#coran" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.quran') }}</a>
                <a href="#zakaat" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.zakaat') }}</a>
                <a href="#adhan" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.prayer_times') }}</a>
                <a href="#calendrier" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.hijri_calendar') }}</a>
                <a href="{{ route('donation') }}" class="text-green-300 text-xl py-2 border-b border-green-500">{{ __('messages.donate') }}</a>

                <a href="#apropos" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.about') }}</a>
            </nav>

            <div class="mt-8 flex flex-col space-y-4">
                <a href="#connexion" class="bg-white text-blue-800 py-3 rounded-full text-center font-medium">Connexion</a>
                <a href="#inscription" class="border border-white text-white py-3 rounded-full text-center font-medium">Inscription</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const closeMenuButton = document.getElementById('close-menu');

            if (mobileMenuButton && mobileMenu && closeMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.remove('hidden');
                });

                closeMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.add('hidden');
                });
            }



            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Close mobile menu if open
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }

                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>