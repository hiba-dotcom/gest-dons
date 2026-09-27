<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Chafaf - Portail Islamique')</title>
    
    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @yield('additional-styles')
    
    <!-- Global Styles -->
    <style>
        :root {
            --primary-color: #1E3A8A;
            /* Bleu plus profond */
            --secondary-color: #3B82F6;
            /* Bleu plus vif */
            --accent-color: #10B981;
            /* Vert émeraude */
            --accent-light: #D1FAE5;
            /* Vert clair */
            --background-light: #F8FAFC;
            --text-color: #1E293B;
            --gold: #F59E0B;
            /* Or pour les accents */
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background-color: var(--background-light);
        }
    </style>
    
    @yield('styles')
    <!-- Language Styles -->
    @include('sections.welcome.language-styles')

</head>

<body>
    <!-- Header Navigation -->
    @yield('header')

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in">
                {{ session('error') }}
            </div>
        @endif

        @yield('hero-section')
        
        @yield('features-section')
        
        @yield('prayer-times-section')
        
        @yield('quran-section')

        @yield('mosquees-section')
        
        @yield('community-section')
        
        @yield('donation-section')
        
        @yield('testimonial-section')
        
        @yield('cta-section')
    </main>

    <!-- Footer -->
    @yield('footer')
    
    <!-- Language Switcher -->
    @yield('language-switcher')
    
    <!-- Role Switcher -->
    @yield('role-switcher')
    
    <!-- Scripts -->
    @yield('scripts')

    
    <!-- Language Scripts -->
    @include('sections.welcome.language-scripts')

</body>
</html>
