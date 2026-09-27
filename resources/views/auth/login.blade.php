<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Chafaf</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1E3A8A; /* Bleu plus profond */
            --secondary-color: #3B82F6; /* Bleu plus vif */
            --accent-color: #10B981; /* Vert émeraude */
            --accent-light: #D1FAE5; /* Vert clair */
            --background-light: #F8FAFC;
            --text-color: #1E293B;
            --gold: #F59E0B; /* Or pour les accents */
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background-color: var(--background-light);
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
        
        .header-section > div {
            position: relative;
            z-index: 2;
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
        
        .btn-secondary {
            background-color: white;
            color: var(--primary-color);
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .btn-secondary:hover {
            background-color: var(--accent-light);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
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
        
        .footer {
            background-color: var(--primary-color);
            color: white;
        }
        
        .decorative-divider {
            height: 4px;
            background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
            width: 100px;
            margin: 1rem auto;
            border-radius: 2px;
        }
        
        .login-form {
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .login-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .form-input {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            padding-left: 2.5rem; /* Espace pour l'icône à gauche */
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
            outline: none;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .input-icon-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
        }
        
        .primary-button {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .primary-button:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(59, 130, 246, 0.25);
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        
        .islamic-pattern {
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1NiIgaGVpZ2h0PSIxMDAiPgo8cmVjdCB3aWR0aD0iNTYiIGhlaWdodD0iMTAwIiBmaWxsPSIjZjhkZmNkIj48L3JlY3Q+CjxwYXRoIGQ9Ik0yOCA2NkwwIDUwTDAgMTZMMjggMEw1NiAxNkw1NiA1MEwyOCA2NkwyOCAxMDAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iI2ZmZiIgc3Ryb2tlLW9wYWNpdHk9IjAuMDUiIHN0cm9rZS13aWR0aD0iMiI+PC9wYXRoPgo8cGF0aCBkPSJNMjggMEwyOCAzNEw1NiA1MEw1NiAxNiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utb3BhY2l0eT0iMC4wMiIgc3Ryb2tlLXdpZHRoPSIyIj48L3BhdGg+Cjwvc3ZnPg==');
            opacity: 0.1;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-gray-800 flex items-center">
                        <img src="https://i.ibb.co/Jt8MZY5/islamic-logo.png" alt="Logo Chafaf" class="h-10 mr-3">
                        <span class="text-blue-800">Chafaf</span>
                    </a>
                </div>
                
                <div class="hidden md:flex space-x-6">
                    <a href="/" class="nav-link text-gray-700 hover:text-blue-800 font-medium">{{ __('messages.home') }}</a>
                    <a href="/#cours" class="nav-link text-gray-700 hover:text-blue-800 font-medium">{{ __('messages.courses') }}</a>
                    <a href="/#mosquees" class="nav-link text-gray-700 hover:text-blue-800 font-medium">{{ __('messages.mosques') }}</a>
                    <a href="/#coran" class="nav-link text-gray-700 hover:text-blue-800 font-medium">{{ __('messages.quran') }}</a>
                    <a href="/#zakaat" class="nav-link text-gray-700 hover:text-blue-800 font-medium">{{ __('messages.zakaat') }}</a>
                    <a href="/#adhan" class="nav-link text-gray-700 hover:text-blue-800 font-medium">{{ __('messages.prayer_times') }}</a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="#" class="btn-primary px-4 py-2 rounded-full text-sm font-medium">Connexion</a>
                    <a href="/register" class="border border-blue-800 text-blue-800 px-4 py-2 rounded-full text-sm font-medium hover:bg-blue-800 hover:text-white transition duration-300">Inscription</a>
                    
                    <div class="md:hidden">
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

    <!-- Login Section -->
    <section class="header-section relative py-16">
        <div class="absolute inset-0 islamic-pattern"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-md mx-auto">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold mb-2">Connexion à <span class="text-yellow-400">Chafaf</span></h1>
                    <div class="decorative-divider"></div>
                    <p class="text-white opacity-90">Veuillez entrer vos identifiants pour vous connecter.</p>
                </div>
                
                <div class="login-form">
                    <div class="login-header">
                        <div class="flex justify-center mb-4">
                            <div class="bg-white rounded-full p-3">
                                <i class="fas fa-user text-blue-800 text-2xl"></i>
                            </div>
                        </div>
                        <h2 class="text-xl font-bold">Connexion</h2>
                    </div>
                    
                    <div class="p-6">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Email Address -->
                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Adresse e-mail')" class="form-label" />
                                <div class="input-icon-wrapper">
                                    <i class="fas fa-envelope input-icon"></i>
                                    <x-text-input id="email" class="form-input text-black" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="error-message" />
                            </div>
                            
                            <!-- Password -->
                            <div class="mb-4">
                                <x-input-label for="password" :value="__('Mot de passe')" class="form-label" />
                                <div class="input-icon-wrapper">
                                    <i class="fas fa-lock input-icon"></i>
                                    <x-text-input id="password" class="form-input text-black" type="password" name="password" required autocomplete="current-password" />
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="error-message" />
                            </div>
                            
                            <!-- Remember Me -->
                            <div class="mb-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                                    <span class="ms-2 text-sm text-gray-600">Se souvenir de moi</span>
                                </label>
                            </div>
                            
                            <div class="flex items-center justify-between mt-6">
                                @if (Route::has('password.request'))
                                    <a class="text-sm text-blue-800 hover:underline" href="{{ route('password.request') }}">
                                        Mot de passe oublié ?
                                    </a>
                                @endif
                                
                                <x-primary-button class="primary-button">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Connexion
                                </x-primary-button>
                            </div>
                        </form>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                            <p class="text-sm text-gray-600">Vous n'avez pas de compte ?</p>
                            <a href="/register" class="mt-2 inline-block text-blue-800 font-medium hover:underline">Créer un compte</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-8">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <div class="flex items-center justify-center mb-4">
                    <img src="https://i.ibb.co/Jt8MZY5/islamic-logo.png" alt="Logo Chafaf" class="h-8 mr-2">
                    <h3 class="text-lg font-bold">Chafaf</h3>
                </div>
                <p class="opacity-80 text-sm">© {{ date('Y') }} Chafaf. Tous droits réservés.</p>
                <div class="flex justify-center space-x-4 mt-4">
                    <a href="#" class="text-white opacity-80 hover:opacity-100"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white opacity-80 hover:opacity-100"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white opacity-80 hover:opacity-100"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="fixed inset-0 bg-blue-900 bg-opacity-95 z-50 hidden">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center mb-8">
                <a href="/" class="text-2xl font-bold text-white flex items-center">
                    <img src="https://i.ibb.co/Jt8MZY5/islamic-logo.png" alt="Logo Chafaf" class="h-10 mr-3">
                    <span>Chafaf</span>
                </a>
                <button id="close-menu" class="text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <nav class="flex flex-col space-y-4">
                <a href="/" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.home') }}</a>
                <a href="/#cours" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.courses') }}</a>
                <a href="/#mosquees" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.mosques') }}</a>
                <a href="/#coran" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.quran') }}</a>
                <a href="/#zakaat" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.zakaat') }}</a>
                <a href="/#adhan" class="text-white text-xl py-2 border-b border-blue-800">{{ __('messages.prayer_times') }}</a>
            </nav>
            
            <div class="mt-8 flex flex-col space-y-4">
                <a href="#" class="bg-white text-blue-800 py-3 rounded-full text-center font-medium">Se connecter</a>
                <a href="/register" class="border border-white text-white py-3 rounded-full text-center font-medium">Créer un compte</a>
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
        });
    </script>
</body>
</html>