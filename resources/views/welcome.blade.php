@extends('layout')
@section('welcome')

<style>
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

    .section-title {
        color: var(--primary-color);
        border-bottom: 2px solid var(--accent-color);
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
        display: inline-block;
    }

    .card {
        transition: all 0.3s ease;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
    }



    .islamic-pattern {
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1NiIgaGVpZ2h0PSIxMDAiPgo8cmVjdCB3aWR0aD0iNTYiIGhlaWdodD0iMTAwIiBmaWxsPSIjZjhkZmNkIj48L3JlY3Q+CjxwYXRoIGQ9Ik0yOCA2NkwwIDUwTDAgMTZMMjggMEw1NiAxNkw1NiA1MEwyOCA2NkwyOCAxMDAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iI2ZmZiIgc3Ryb2tlLW9wYWNpdHk9IjAuMDUiIHN0cm9rZS13aWR0aD0iMiI+PC9wYXRoPgo8cGF0aCBkPSJNMjggMEwyOCAzNEw1NiA1MEw1NiAxNiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utb3BhY2l0eT0iMC4wMiIgc3Ryb2tlLXdpZHRoPSIyIj48L3BhdGg+Cjwvc3ZnPg==');
        opacity: 0.1;
    }






    .prayer-times {
        background-color: var(--accent-light);
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .prayer-time-item {
        background-color: white;
        border-radius: 0.5rem;
        padding: 0.75rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .font-arabic {
        font-family: 'Traditional Arabic', 'Scheherazade', serif;
    }

    .highlight {
        color: var(--accent-color);
    }

    .gold-text {
        color: var(--gold);
    }

    .decorative-divider {
        height: 4px;
        background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
        width: 100px;
        margin: 1rem auto;
        border-radius: 2px;
    }

    .mosque-icon {
        color: var(--accent-color);
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .testimonial {
        background-color: white;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .testimonial::before {
        content: '"';
        position: absolute;
        top: 1rem;
        left: 1.5rem;
        font-size: 4rem;
        color: var(--accent-light);
        font-family: serif;
        line-height: 1;
    }

    .feature-icon {
        background-color: var(--accent-light);
        color: var(--accent-color);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }


    /* Styles pour le sélecteur de langue (nouveau design) */
    .language-switcher {
        position: relative;
    }

    .language-button {
        position: relative;
        padding: 0.35rem 0.25rem;
        border-radius: 0.25rem;
        transition: all 0.3s ease;
    }

    .language-button:hover .world-icon {
        animation: spin 4s linear infinite;
    }

    .world-icon {
        color: var(--accent-color);
        font-size: 1.25rem;
        margin-right: 0.25rem;
        transition: all 0.3s ease;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .language-menu {
        border-top: 3px solid var(--accent-color);
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.2s ease-out;
        pointer-events: none;
    }

    .language-menu.active {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .language-flag-box {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .language-flag {
        width: 100%;
        height: 100%;
        background-size: cover;
        transition: transform 0.5s ease;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .language-flag-fr {
        background: linear-gradient(to right, #0055a4 33%, #ffffff 33%, #ffffff 67%, #ef4135 67%);
    }

    .language-flag-ar {
        /* Drapeau de l'Arabie Saoudite - version améliorée */
        position: relative;
        background-color: #006C35;
        /* Vert saoudien */
        overflow: hidden;
    }

    .language-flag-ar::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 70%;
        height: 26%;
        transform: translate(-50%, -50%);
        background-color: white;
        mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 30'%3E%3Cpath d='M2,15 L90,15 M60,2 L60,28 M30,5 Q40,15,30,25 M70,5 Q80,15,70,25'/%3E%3C/svg%3E");
        mask-size: contain;
        mask-repeat: no-repeat;
        mask-position: center;
        -webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 30'%3E%3Cpath fill='none' stroke='white' stroke-width='4' d='M2,15 L90,15 M60,2 L60,28 M30,5 Q40,15,30,25 M70,5 Q80,15,70,25'/%3E%3C/svg%3E");
        -webkit-mask-size: contain;
        -webkit-mask-repeat: no-repeat;
        -webkit-mask-position: center;
    }

    .language-flag-ar::after {
        content: '';
        position: absolute;
        top: 15%;
        left: 25%;
        width: 50%;
        height: 25%;
        background-color: white;
        mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 30'%3E%3Ctext x='50%' y='50%' font-family='Arial' font-size='20' fill='white' text-anchor='middle' dominant-baseline='middle' style='font-weight:bold;'%3Eلا إله إلا الله%3C/text%3E%3C/svg%3E");
        mask-size: contain;
        mask-repeat: no-repeat;
        mask-position: center;
        -webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 30'%3E%3Ctext x='50%' y='50%' font-family='Arial' font-size='20' fill='white' text-anchor='middle' dominant-baseline='middle' style='font-weight:bold;'%3Eلا إله إلا الله%3C/text%3E%3C/svg%3E");
        -webkit-mask-size: contain;
        -webkit-mask-repeat: no-repeat;
        -webkit-mask-position: center;
    }

    .language-flag-en {
        /* Drapeau des États-Unis */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 60'%3E%3Crect width='100' height='60' fill='%23fff'/%3E%3Cg fill='%23bf0a30'%3E%3Crect y='0' width='100' height='5'/%3E%3Crect y='10' width='100' height='5'/%3E%3Crect y='20' width='100' height='5'/%3E%3Crect y='30' width='100' height='5'/%3E%3Crect y='40' width='100' height='5'/%3E%3Crect y='50' width='100' height='5'/%3E%3C/g%3E%3Crect width='50' height='30' fill='%23002868'/%3E%3Cg fill='%23fff'%3E%3Cpath d='M0,0 L1,0 L1,1 L0,1 z' transform='scale(5)' /%3E%3Cpath d='M2,0 L3,0 L3,1 L2,1 z' transform='scale(5)' /%3E%3Cpath d='M4,0 L5,0 L5,1 L4,1 z' transform='scale(5)' /%3E%3Cpath d='M6,0 L7,0 L7,1 L6,1 z' transform='scale(5)' /%3E%3Cpath d='M8,0 L9,0 L9,1 L8,1 z' transform='scale(5)' /%3E%3Cpath d='M1,1 L2,1 L2,2 L1,2 z' transform='scale(5)' /%3E%3Cpath d='M3,1 L4,1 L4,2 L3,2 z' transform='scale(5)' /%3E%3Cpath d='M5,1 L6,1 L6,2 L5,2 z' transform='scale(5)' /%3E%3Cpath d='M7,1 L8,1 L8,2 L7,2 z' transform='scale(5)' /%3E%3Cpath d='M0,2 L1,2 L1,3 L0,3 z' transform='scale(5)' /%3E%3Cpath d='M2,2 L3,2 L3,3 L2,3 z' transform='scale(5)' /%3E%3Cpath d='M4,2 L5,2 L5,3 L4,3 z' transform='scale(5)' /%3E%3Cpath d='M6,2 L7,2 L7,3 L6,3 z' transform='scale(5)' /%3E%3Cpath d='M8,2 L9,2 L9,3 L8,3 z' transform='scale(5)' /%3E%3Cpath d='M1,3 L2,3 L2,4 L1,4 z' transform='scale(5)' /%3E%3Cpath d='M3,3 L4,3 L4,4 L3,4 z' transform='scale(5)' /%3E%3Cpath d='M5,3 L6,3 L6,4 L5,4 z' transform='scale(5)' /%3E%3Cpath d='M7,3 L8,3 L8,4 L7,4 z' transform='scale(5)' /%3E%3Cpath d='M0,4 L1,4 L1,5 L0,5 z' transform='scale(5)' /%3E%3Cpath d='M2,4 L3,4 L3,5 L2,5 z' transform='scale(5)' /%3E%3Cpath d='M4,4 L5,4 L5,5 L4,5 z' transform='scale(5)' /%3E%3Cpath d='M6,4 L7,4 L7,5 L6,5 z' transform='scale(5)' /%3E%3Cpath d='M8,4 L9,4 L9,5 L8,5 z' transform='scale(5)' /%3E%3Cpath d='M1,5 L2,5 L2,6 L1,6 z' transform='scale(5)' /%3E%3Cpath d='M3,5 L4,5 L4,6 L3,6 z' transform='scale(5)' /%3E%3Cpath d='M5,5 L6,5 L6,6 L5,6 z' transform='scale(5)' /%3E%3Cpath d='M7,5 L8,5 L8,6 L7,6 z' transform='scale(5)' /%3E%3C/g%3E%3C/svg%3E");
        background-size: cover;
        background-position: center;
    }

    .language-option:hover .language-flag {
        transform: scale(1.1);
    }

    /* Sélecteur de langue flottant */
    .floating-language-switcher {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 100;
    }

    /* Sélecteur de rôle flottant */
    .floating-role-switcher {
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 100;
    }

    .floating-language-button,
    .floating-role-button {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background-color: var(--secondary-color);
        color: white;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        outline: none;
    }

    .floating-language-button:hover,
    .floating-role-button:hover {
        background-color: #1d4ed8;
        transform: translateY(-2px);
    }

    .floating-language-icon,
    .floating-role-icon {
        font-size: 1.25rem;
    }

    .floating-language-menu {
        position: absolute;
        bottom: 100%;
        right: 0;
        margin-bottom: 10px;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        width: 200px;
        opacity: 0;
        transform: translateY(10px);
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 101;
    }

    .floating-language-menu.show {
        opacity: 1;
        transform: translateY(0);
        visibility: visible;
    }
</style>
</head>

<body>
    <!-- Hero Section -->
    <header class="header-section relative py-24">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ __('messages.welcome') }} <span class="text-green-400">Chafaf</span></h1>
                <div class="decorative-divider"></div>
                <p class="text-xl md:text-2xl mb-8 opacity-90">
                    {{ __('messages.welcome_subtitle') }}
                </p>
                <div class="flex flex-col md:flex-row justify-center gap-4">
                    <a href="#cours" class="btn-primary px-6 py-3 rounded-full text-lg font-medium">
                        <i class="fas fa-book-open mr-2"></i>
                        {{ __('messages.discover_courses') }}
                    </a>
                    <a href="#mosquees" class="btn-secondary px-6 py-3 rounded-full text-lg font-medium hover:bg-blue-100 transition duration-300">
                        <i class="fas fa-mosque mr-2"></i> {{ __('messages.find_mosque') }}
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Événements Section -->
    <section id="evenements" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-blue-900">{{ __('messages.event') }}</h2>
                <div class="decorative-divider"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Découvrez les événements récents organisés par nos associations.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($evenements as $evenement)
                <div class="card bg-white rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    @if($evenement->image)
                    <img src="{{ asset('storage/' . $evenement->image) }}" alt="{{ $evenement->nom }}" class="w-full h-48 object-cover">
                    @else
                    <div class="bg-blue-100 w-full h-48 flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-4xl text-blue-600"></i>
                    </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-blue-900">{{ $evenement->nom }}</h3>

                        <div class="mb-4">
                            
                            <p class="text-gray-700"><strong>Date :</strong> {{ \Carbon\Carbon::parse($evenement->dateDebut)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($evenement->dateFin)->format('d/m/Y') }}</p>

                            <p class="text-gray-700"><strong>Adresse :</strong><br>
                                @if($evenement->adresse)
                                {{ $evenement->adresse->boulevard }}, <br>
                                {{ $evenement->adresse->ville }}, <br>
                                {{ $evenement->adresse->pays }}
                                @else
                                Adresse non renseignée
                                @endif
                            </p><br>
                            <hr><br>
                            <p class="text-gray-700"><strong>Déscription :</strong> {{ $evenement->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($evenements->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-500">Aucun événement récent pour le moment.</p>
            </div>
            @endif

            <div class="text-center mt-12">
                <a href="{{ route('evenements.liste') }}" class="btn-primary px-6 py-3 rounded-full inline-block">
                    <i class="fas fa-calendar-alt mr-2"></i> Voir tous les événements
                </a>
            </div>
        </div>
    </section>


    <!-- Featured Courses Section -->
    <section id="cours" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-blue-900">{{ __('messages.courses_title') }}</h2>
                <div class="decorative-divider"></div>
                <p class="text-gray-600 max-w-2xl mx-auto"> {{ __('messages.courses_subtitle') }} </p>
            </div>
            <!-- Featured Courses Section -->
<section id="cours" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Contenu des onglets -->
        <div id="cours-content" class="tab-content active">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                @forelse($cours as $course)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 course-card">
                    <!-- Course Thumbnail -->
                    <div class="relative h-48 bg-gradient-to-br from-blue-500 to-purple-600">
                        @if($course->video)
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                    <i class="fas fa-play text-white text-xl"></i>
                                </div>
                            </div>
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <i class="fas fa-video text-4xl mb-2 opacity-60"></i>
                                    <p class="text-sm opacity-80">Vidéo bientôt disponible</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Course Status Badge -->
                        <div class="absolute top-4 right-4">
                            @php
                                $statusConfig = [
                                    'pending' => ['text' => 'En attente', 'class' => 'bg-yellow-500'],
                                    'validé' => ['text' => 'Disponible', 'class' => 'bg-green-500'],
                                    'refusé' => ['text' => 'Indisponible', 'class' => 'bg-red-500']
                                ];
                                $config = $statusConfig[$course->statut] ?? $statusConfig['pending'];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $config['class'] }} text-white">
                                {{ $config['text'] }}
                            </span>
                        </div>

                        <!-- Category Badge -->
                        @if($course->categorie)
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white bg-opacity-20 text-white backdrop-blur-sm">
                                <i class="fas fa-tag mr-1"></i>
                                {{ $course->categorie }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Course Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                            {{ $course->name ?? 'Titre du cours' }}
                        </h3>

                        <div class="flex items-center mb-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user-tie text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">
                                    {{ $course->user->firstname ?? 'Prénom' }} {{ $course->user->lastname ?? 'Nom' }}
                                </p>
                                <p class="text-xs text-gray-500">{{$course->user->role}}</p>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit($course->description ?? 'Description du cours disponible bientôt...', 100) }}
                        </p>

                        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                <span>{{ $course->created_at ? $course->created_at->format('d M Y') : 'Date inconnue' }}</span>
                            </div>
                            @if($course->video)
                            <div class="flex items-center">
                                <i class="fas fa-video mr-1"></i>
                                <span>Vidéo disponible</span>
                            </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            @if($course->statut === 'validé')
                                <a href="{{route('cours.show' , $course->id)}}" 
                                   class="flex-1 bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-lg font-medium text-sm text-center hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-play mr-2"></i>
                                    Voir le cours
                                </a>
                            @else
                                <button disabled 
                                        class="flex-1 bg-gray-300 text-gray-500 px-4 py-2 rounded-lg font-medium text-sm text-center cursor-not-allowed">
                                    <i class="fas fa-clock mr-2"></i>
                                    Bientôt disponible
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-4">
                        <i class="fas fa-graduation-cap text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Aucun cours disponible</h3>
                    <p class="text-gray-500 max-w-md mx-auto">
                        Les cours seront bientôt disponibles. Revenez plus tard pour découvrir notre contenu éducatif.
                    </p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="text-center mt-12">
                <a href="/cours" class="btn-primary px-6 py-3 rounded-full inline-block">
                    <i class="fas fa-graduation-cap mr-2"></i> Voir tous les cours
                </a>
            </div>
    </div>
</section>

                

                


    <!-- Mosquées Section -->
    <section id="mosquees" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-blue-900">Mosquées</h2>
                <div class="decorative-divider"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Trouvez des mosquées près de chez vous, consultez leurs
                    horaires de prière et découvrez les services qu'elles proposent.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($mosquees as $mosquee)
                <div class="card bg-white rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Image de la mosquée -->
                    @if($mosquee->image)
                    <img src="{{ asset($mosquee->image) }}" alt="{{ $mosquee->name }}" class="w-full h-48 object-cover">
                    @else
                    <div class="bg-blue-100 w-full h-48 flex items-center justify-center">
                        <i class="fas fa-mosque text-4xl text-blue-600"></i>
                    </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-blue-900">{{ $mosquee->name }}</h3>

                        <div class="mb-4">
                            <!-- Chef de mosquée -->
                            <p class="text-gray-700 flex items-center">
                                <i class="fas fa-user-tie text-blue-800 mr-2"></i>
                                <span class="font-semibold">Chef de Mosquée :&nbsp;</span>
                                <span class="">{{ $mosquee->chef ? $mosquee->chef->firstname . ' ' . $mosquee->chef->lastname : 'Non attribué' }}</span>
                            </p>

                            <!-- Adresse -->
                            <p class="text-gray-700 flex items-center mt-1">
                                <i class="fas fa-map-marker-alt text-blue-800 mr-2"></i>
                                <span class="font-semibold">Adresse :&nbsp;</span>
                                @if($mosquee->adresse) <br>
                                {{ $mosquee->adresse->boulevard }}, <br>
                                {{ $mosquee->adresse->ville }},<br>
                                {{ $mosquee->adresse->pays }}
                                @else
                                Adresse non renseignée
                                @endif
                            </p>
                        </div>
                        <hr> <br>
                        <!-- Description-->
                        <div class="flex justify-center text-center">
                            <p class="text-gray-700 mb-4">
                                {{ $mosquee->description ?? 'Mosquée accueillante proposant des services religieux et communautaires.' }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($mosquees->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-500">Aucune mosquée disponible pour le moment.</p>
            </div>
            @endif

            <div class="text-center mt-12">
                <a href="{{ route('voir_mosquees') }}" class="btn-primary px-6 py-3 rounded-full inline-block">
                    <i class="fas fa-mosque mr-2"></i> Voir toutes les mosquées
                </a>
            </div>
        </div>
    </section>

    <!-- Quran Section -->
    <section id="coran" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-8 lg:mb-0 lg:pr-12">
                    <h2 class="text-3xl font-bold mb-6 text-blue-900">Le Saint Coran</h2>
                    <div class="h-1 w-24 bg-green-500 mb-6 rounded"></div>
                    <p class="text-gray-700 mb-6">Accédez au Saint Coran en ligne avec traduction en français et
                        translittération. Écoutez les récitations des meilleurs récitateurs du monde.</p>
                    <p class="text-gray-700 mb-6">Notre plateforme vous permet de:</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <div class="bg-green-100 p-1 rounded-full mr-3">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                            <span>Lire le Coran en arabe avec traduction française et en anglais.</span>
                        </li>
                        <li class="flex items-center">
                            <div class="bg-green-100 p-1 rounded-full mr-3">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                            <span>Profitez de la récitation audio verset par verset pour une immersion complète.</span>
                        </li>
                        <li class="flex items-center">
                            <div class="bg-green-100 p-1 rounded-full mr-3">
                                <i class="fas fa-check text-green-600"></i>
                            </div>
                            <span>Rechercher rapidement une sourate grâce à la barre de recherche intégrée</span>
                        </li>
                    </ul>
                    <a href="coran" class="btn-primary px-6 py-3 rounded-full inline-block">
                        <i class="fas fa-book-open mr-2"></i> Explorer le Coran
                    </a>
                </div>
                <div class="lg:w-1/2">
                    <div class="relative">

                        <img src="https://www.ahmadiyya-islam.org/altaqwa/wp-content/uploads/sites/19/2011/04/photo5951597643505447362.jpg" alt="Coran" class="rounded-lg shadow-lg w-full">
                        <div class="absolute -bottom-4 -right-4 bg-white p-4 rounded-lg shadow-md">
                            <p class="text-gray-800 text-xl font-arabic">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                            <p class="text-gray-600 italic text-sm">Au nom d'Allah, le Tout Miséricordieux, le Très
                                Miséricordieux</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>








    <!-- About Section -->
    <section id="apropos" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-blue-900">À propos de Chafaf</h2>
                <div class="decorative-divider"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Découvrez notre mission et notre équipe dédiée à fournir des
                    ressources islamiques de qualité.</p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="flex flex-col md:flex-row gap-12 items-center">
                    <div class="md:w-1/2">
                        <img src="https://images.unsplash.com/photo-1512632578888-169bbbc7efb7?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="À propos de Chafaf" class="rounded-lg shadow-lg w-full">
                    </div>
                    <div class="md:w-1/2">
                        <h3 class="text-2xl font-bold mb-4 text-blue-900">Notre Mission</h3>
                        <p class="text-gray-700 mb-4">
                            @if (isset($aboutContent))
                            {!! $aboutContent !!}
                            @else
                            Chafaf est né de la volonté de créer une plateforme islamique <span class="text-blue-800 font-semibold">transparente</span>, accessible et fiable pour
                            la communauté musulmane francophone. Notre nom, qui signifie "transparent" en arabe,
                            reflète notre engagement envers la clarté et l'authenticité dans la transmission du
                            savoir islamique.
                            @endif
                        </p>
                        <p class="text-gray-700 mb-6">Nous nous efforçons de:</p>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center">
                                <div class="bg-blue-100 p-1 rounded-full mr-3">
                                    <i class="fas fa-check text-blue-800"></i>
                                </div>
                                <span>Fournir un accès facile aux enseignements islamiques authentiques</span>
                            </li>
                            <li class="flex items-center">
                                <div class="bg-blue-100 p-1 rounded-full mr-3">
                                    <i class="fas fa-check text-blue-800"></i>
                                </div>
                                <span>Connecter la communauté avec les mosquées et les imams locaux</span>
                            </li>
                            <li class="flex items-center">
                                <div class="bg-blue-100 p-1 rounded-full mr-3">
                                    <i class="fas fa-check text-blue-800"></i>
                                </div>
                                <span>Offrir des outils pratiques pour la vie quotidienne des musulmans</span>
                            </li>
                            <li class="flex items-center">
                                <div class="bg-blue-100 p-1 rounded-full mr-3">
                                    <i class="fas fa-check text-blue-800"></i>
                                </div>
                                <span>Promouvoir une compréhension correcte et modérée de l'Islam</span>
                            </li>
                        </ul>
                        <a href="#" class="btn-primary px-6 py-3 rounded-full inline-block">
                            <i class="fas fa-envelope mr-2"></i> Contactez-nous
                        </a>
                    </div>
                </div>

                
            </div>
        </div>
    </section>
    <!-- Header Section -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-emerald-600 rounded-full mb-6">
            <i class="fas fa-question-circle text-white text-2xl"></i>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
            Questions aux Imams
        </h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Vous avez des questions sur l'Islam, la pratique religieuse ou besoin de conseils spirituels ?
            Nos imams qualifiés sont là pour vous accompagner et répondre à vos interrogations.
        </p>
    </div>

    <!-- Features Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="text-center">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-clock text-white text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Réponse rapide</h3>
            <p class="text-gray-600 text-sm">Nos imams s'efforcent de répondre dans les plus brefs délais</p>
        </div>

        <div class="text-center">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-shield text-white text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Confidentialité</h3>
            <p class="text-gray-600 text-sm">Vos questions restent privées et confidentielles</p>
        </div>

        <div class="text-center">
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-graduation-cap text-white text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Expertise</h3>
            <p class="text-gray-600 text-sm">Conseils basés sur les sources authentiques de l'Islam</p>
        </div>
    </div>
    <!-- Newsletter Section -->
    <section class="py-12 bg-blue-800 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-4">Restez informé</h2>
                <div class="h-1 w-24 bg-yellow-400 mx-auto mb-6 rounded"></div>
                <p class="text-lg mb-8 opacity-90">Inscrivez-vous à notre newsletter pour recevoir les dernières
                    actualités, les horaires de prière et les événements à venir.</p>

                <form action="#" method="POST" class="flex flex-col sm:flex-row gap-4 justify-center">
                    <input type="email" name="email" placeholder="Votre adresse email" class="px-4 py-3 rounded-full text-gray-800 w-full sm:w-auto flex-grow max-w-md" required>
                    <button type="submit" class="bg-white text-blue-800 px-6 py-3 rounded-full font-medium hover:bg-blue-100 transition duration-300">
                        <i class="fas fa-paper-plane mr-2"></i> S'abonner
                    </button>
                </form>

                @if (session('success'))
                <div class="mt-4 bg-green-500 bg-opacity-20 border border-green-300 rounded-md p-3">
                    {{ session('success') }}
                </div>
                @endif
            </div>
        </div>
    </section>






    <script>
        // Sélecteur de langue (nouveau design)
        const languageToggle = document.getElementById('language-toggle');
        const languageMenu = document.getElementById('language-menu');
        const currentLanguage = document.getElementById('current-language');
        const chevronIcon = languageToggle ? languageToggle.querySelector('.fa-chevron-down') : null;

        if (languageToggle && languageMenu) {
            // Ouvrir/fermer le menu de langue
            languageToggle.addEventListener('click', function() {
                languageMenu.classList.toggle('hidden');
                languageMenu.classList.toggle('active');

                // Rotation de l'icône de flèche
                if (chevronIcon) {
                    chevronIcon.style.transform = languageMenu.classList.contains('active') ?
                        'rotate(180deg)' :
                        'rotate(0deg)';
                }
            });

            // Fermer le menu quand on clique ailleurs
            document.addEventListener('click', function(e) {
                if (!languageToggle.contains(e.target) && !languageMenu.contains(e.target) &&
                    !languageMenu.classList.contains('hidden')) {
                    languageMenu.classList.add('hidden');
                    languageMenu.classList.remove('active');

                    if (chevronIcon) {
                        chevronIcon.style.transform = 'rotate(0deg)';
                    }
                }
            });
        }

        // Fonction pour changer de langue
        window.changeLanguage = function(lang) {
            // Stocker la langue sélectionnée dans localStorage
            localStorage.setItem('preferred_language', lang);

            // Mettre à jour l'affichage du bouton
            if (currentLanguage) {
                currentLanguage.textContent = lang.toUpperCase();
            }

            // Fermer le menu
            languageMenu.classList.add('hidden');
            languageMenu.classList.remove('active');

            if (chevronIcon) {
                chevronIcon.style.transform = 'rotate(0deg)';
            }

            // On pourrait ici ajouter du code pour changer réellement la langue
            // Par exemple, recharger la page avec le paramètre de langue
            console.log('Langue changée pour: ' + lang);

            // Montrer une confirmation
            showLanguageNotification(lang);
        };

        // Afficher une notification lors du changement de langue
        function showLanguageNotification(lang) {
            // Supprimer toute notification existante
            const existingNotifications = document.querySelectorAll('.language-notification');
            existingNotifications.forEach(n => n.remove());

            // Créer une notification
            const notification = document.createElement('div');

            // Texte selon la langue sélectionnée
            let message = '';
            let icon = '';

            switch (lang) {
                case 'fr':
                    message = 'Langue changée en Français';
                    icon = '<div class="w-5 h-5 mr-2 rounded overflow-hidden"><div class="language-flag language-flag-fr w-full h-full"></div></div>';
                    break;
                case 'ar':
                    message = 'تم تغيير اللغة إلى العربية';
                    icon = '<div class="w-5 h-5 mr-2 rounded overflow-hidden"><div class="language-flag language-flag-ar w-full h-full"></div></div>';
                    break;
                case 'en':
                    message = 'Language changed to English';
                    icon = '<div class="w-5 h-5 mr-2 rounded overflow-hidden"><div class="language-flag language-flag-en w-full h-full"></div></div>';
                    break;
            }

            // Styles de la notification
            notification.className = 'language-notification fixed top-20 right-4 bg-white text-gray-800 py-2 px-4 rounded-lg shadow-lg z-50 border-l-4 border-blue-800';
            notification.innerHTML = `<div class="flex items-center">${icon} ${message}</div>`;
            document.body.appendChild(notification);

            // Animation d'entrée
            notification.style.transform = 'translateX(100%)';
            notification.style.opacity = '0';
            notification.style.transition = 'all 0.3s ease-out';

            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
                notification.style.opacity = '1';
            }, 10);

            // Supprimer après 3 secondes
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Restaurer la langue préférée au chargement
        const savedLanguage = localStorage.getItem('preferred_language');
        if (savedLanguage && currentLanguage) {
            currentLanguage.textContent = savedLanguage.toUpperCase();
        }

        // Zakaat calculator
        const calculateZakaatButton = document.querySelector('.bg-blue-50 button');
        if (calculateZakaatButton) {
            calculateZakaatButton.addEventListener('click', function(e) {
                e.preventDefault();

                // Get all input values
                const inputs = document.querySelectorAll('.bg-blue-50 input');
                let total = 0;

                inputs.forEach(function(input, index) {
                    const value = parseFloat(input.value) || 0;

                    // Subtract debts to pay (last input)
                    if (index === inputs.length - 1) {
                        total -= value;
                    } else {
                        total += value;
                    }
                });

                // Calculate 2.5% of the total
                const zakaat = Math.max(0, total * 0.025);

                // Update the display
                const zakaatDisplay = document.querySelector('.text-xl.font-bold.text-blue-800');
                if (zakaatDisplay) {
                    zakaatDisplay.textContent = zakaat.toFixed(2) + ' €';
                }
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
    </script>

    <!-- Sélecteur de langue flottant -->
    <div class="floating-language-switcher">
        <button id="floating-language-toggle" class="floating-language-button">
            <i class="fas fa-globe floating-language-icon"></i>
            <span id="floating-current-language" class="font-medium">{{ strtoupper(app()->getLocale()) }}</span>
            <i class="fas fa-chevron-up text-xs transition-transform duration-300"></i>
        </button>
        <div id="floating-language-menu" class="floating-language-menu">
            <a href="{{ route('language.switch', 'fr') }}" class="language-option flex items-center w-full text-left px-4 py-3 text-gray-800 hover:bg-gray-100">
                <div class="language-flag-box flex-shrink-0 mr-3">
                    <div class="language-flag language-flag-fr"></div>
                </div>
                <div>
                    <div class="font-medium">Français</div>
                    <div class="text-xs text-gray-500">Langue Française</div>
                </div>
            </a>
            <a href="{{ route('language.switch', 'ar') }}" class="language-option flex items-center w-full text-left px-4 py-3 text-gray-800 hover:bg-gray-100">
                <div class="language-flag-box flex-shrink-0 mr-3">
                    <div class="language-flag language-flag-ar"></div>
                </div>
                <div>
                    <div class="font-medium font-arabic">العربية</div>
                    <div class="text-xs text-gray-500">اللغة العربية</div>
                </div>
            </a>
            <a href="{{ route('language.switch', 'en') }}" class="language-option flex items-center w-full text-left px-4 py-3 text-gray-800 hover:bg-gray-100">
                <div class="language-flag-box flex-shrink-0 mr-3">
                    <div class="language-flag language-flag-en"></div>
                </div>
                <div>
                    <div class="font-medium">English</div>
                    <div class="text-xs text-gray-500">English language</div>
                </div>
            </a>
        </div>
    </div>

   
    <script>
        // Script pour le sélecteur de langue flottant
        document.addEventListener('DOMContentLoaded', function() {
            const floatingToggle = document.getElementById('floating-language-toggle');
            const floatingMenu = document.getElementById('floating-language-menu');
            const chevronIcon = floatingToggle.querySelector('.fa-chevron-up');

            if (floatingToggle && floatingMenu) {
                // Toggle menu visibility
                floatingToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    floatingMenu.classList.toggle('show');
                    if (chevronIcon) {
                        chevronIcon.style.transform = floatingMenu.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0)';
                    }
                });

                // Close menu when clicking outside
                document.addEventListener('click', function(event) {
                    if (!floatingToggle.contains(event.target) && !floatingMenu.contains(event.target)) {
                        floatingMenu.classList.remove('show');
                        if (chevronIcon) {
                            chevronIcon.style.transform = 'rotate(0)';
                        }
                    }
                });

                // Handle language selection
                const languageOptions = floatingMenu.querySelectorAll('.language-option');
                languageOptions.forEach(option => {
                    option.addEventListener('click', function(e) {
                        const lang = this.getAttribute('href').split('/').pop();
                        const currentLang = document.getElementById('floating-current-language');

                        if (currentLang) {
                            currentLang.textContent = lang.toUpperCase();
                        }

                        // Show notification
                        showLanguageNotification(lang);
                    });
                });
            }

            // Show language change notification
            function showLanguageNotification(lang) {
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in';

                let message = '';
                switch (lang) {
                    case 'fr':
                        message = 'Langue changée en Français';
                        break;
                    case 'ar':
                        message = 'تم تغيير اللغة إلى العربية';
                        break;
                    case 'en':
                        message = 'Language changed to English';
                        break;
                }

                notification.textContent = message;
                document.body.appendChild(notification);

                // Remove notification after 3 seconds
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateY(-20px)';
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }
        });
    </script>

    @endsection