@extends('layout')
@section('cours')

<!-- Section Cours -->
<section id="cours" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Header avec titre -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Découvrez Nos Contenus</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Explorez nos cours, khutbah et articles pour enrichir vos connaissances islamiques
            </p>
        </div>


        <!-- Onglets de navigation -->
        <div class="flex justify-center mb-12">
            <div class="bg-white rounded-xl shadow-lg p-2 inline-flex">
                <button 
                    class="tab-button active px-6 py-3 rounded-lg font-semibold text-sm transition-all duration-300 focus:outline-none"
                    data-tab="cours">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Cours
                </button>
                <button 
                    class="tab-button px-6 py-3 rounded-lg font-semibold text-sm transition-all duration-300 focus:outline-none"
                    data-tab="khutbah">
                    <i class="fas fa-mosque mr-2"></i>
                    Khutbah
                </button>
                <button 
                    class="tab-button px-6 py-3 rounded-lg font-semibold text-sm transition-all duration-300 focus:outline-none"
                    data-tab="articles">
                    <i class="fas fa-newspaper mr-2"></i>
                    Articles
                </button>
            </div>
        </div>

        <!-- Contenu des onglets -->
        
        <!-- Onglet Cours -->
        <div id="cours-content" class="tab-content active">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $coursFiltered = $cours->where('categorie', '!=', 'khutbah');
                @endphp
                @forelse($coursFiltered as $course)
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

        <!-- Onglet Khutbah -->
        <div id="khutbah-content" class="tab-content">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $khutbahFiltered = $cours->where('categorie', 'khutbah');
                @endphp
                @forelse($khutbahFiltered as $khutbah)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 course-card">
                    <!-- Khutbah Thumbnail -->
                    <div class="relative h-48 bg-gradient-to-br from-green-500 to-teal-600">
                        @if($khutbah->video)
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                    <i class="fas fa-play text-white text-xl"></i>
                                </div>
                            </div>
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <i class="fas fa-mosque text-4xl mb-2 opacity-60"></i>
                                    <p class="text-sm opacity-80">Khutbah bientôt disponible</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 right-4">
                            @php
                                $statusConfig = [
                                    'pending' => ['text' => 'En attente', 'class' => 'bg-yellow-500'],
                                    'validé' => ['text' => 'Disponible', 'class' => 'bg-green-500'],
                                    'refusé' => ['text' => 'Indisponible', 'class' => 'bg-red-500']
                                ];
                                $config = $statusConfig[$khutbah->statut] ?? $statusConfig['pending'];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $config['class'] }} text-white">
                                {{ $config['text'] }}
                            </span>
                        </div>

                        <!-- Khutbah Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white bg-opacity-20 text-white backdrop-blur-sm">
                                <i class="fas fa-mosque mr-1"></i>
                                Khutbah
                            </span>
                        </div>
                    </div>

                    <!-- Khutbah Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                            {{ $khutbah->name ?? 'Titre de la khutbah' }}
                        </h3>

                        <div class="flex items-center mb-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user-tie text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">
                                    {{ $khutbah->user->firstname ?? 'Prénom' }} {{ $khutbah->user->lastname ?? 'Nom' }}
                                </p>
                                <p class="text-xs text-gray-500">{{$khutbah->user->role}}</p>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit($khutbah->description ?? 'Description de la khutbah disponible bientôt...', 100) }}
                        </p>

                        <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                <span>{{ $khutbah->created_at ? $khutbah->created_at->format('d M Y') : 'Date inconnue' }}</span>
                            </div>
                            @if($khutbah->video)
                            <div class="flex items-center">
                                <i class="fas fa-video mr-1"></i>
                                <span>Vidéo disponible</span>
                            </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-between">
                            @if($khutbah->statut === 'validé')
                                <a href="{{route('cours.show' , $khutbah->id)}}" 
                                   class="flex-1 bg-gradient-to-r from-green-500 to-teal-600 text-white px-4 py-2 rounded-lg font-medium text-sm text-center hover:from-green-600 hover:to-teal-700 transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-play mr-2"></i>
                                    Écouter la khutbah
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
                        <i class="fas fa-mosque text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Aucune khutbah disponible</h3>
                    <p class="text-gray-500 max-w-md mx-auto">
                        Les khutbah seront bientôt disponibles. Revenez plus tard pour découvrir nos prêches.
                    </p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Onglet Articles -->
        <div id="articles-content" class="tab-content">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 course-card">
                    <!-- Article Image -->
                    <div class="relative h-48 overflow-hidden">
                        @if($article->image)
                            <img src="{{ asset('storage/articles/' . $article->image) }}" 
                                 alt="{{ $article->name }}" 
                                 class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <i class="fas fa-newspaper text-4xl mb-2 opacity-60"></i>
                                    <p class="text-sm opacity-80">Image bientôt disponible</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Article Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white bg-opacity-90 text-purple-600 backdrop-blur-sm">
                                <i class="fas fa-newspaper mr-1"></i>
                                Article
                            </span>
                        </div>
                        
                        <!-- Reading Time -->
                        <div class="absolute bottom-4 right-4">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-black bg-opacity-50 text-white backdrop-blur-sm">
                                <i class="fas fa-clock mr-1"></i>
                                5 min
                            </span>
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">
                            {{ $article->name ?? 'Titre de l\'article' }}
                        </h3>

                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-semibold text-sm">
                                    {{ substr($article->user->firstname ?? 'U', 0, 1) }}{{ substr($article->user->lastname ?? 'N', 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">
                                    {{ $article->imam->firstname ?? 'Prénom' }} {{ $article->imam->lastname ?? 'Nom' }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $article->created_at ? $article->created_at->format('d M Y') : 'Date inconnue' }}
                                </p>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm mb-6 line-clamp-3">
                            {{ Str::limit($article->description ?? 'Description de l\'article disponible bientôt...', 120) }}
                        </p>

                        <div class="flex items-center justify-between">
                            <a href="{{route('article.details' , $article->id)}}" 
                               class="flex-1 bg-gradient-to-r from-purple-500 to-pink-600 text-white px-4 py-2 rounded-lg font-medium text-sm text-center hover:from-purple-600 hover:to-pink-700 transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-book-open mr-2"></i>
                                Lire l'article
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-4">
                        <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Aucun article disponible</h3>
                    <p class="text-gray-500 max-w-md mx-auto">
                        Les articles seront bientôt disponibles. Revenez plus tard pour découvrir nos publications.
                    </p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Section Questions aux Imams -->
<section id="questions-imams" class="py-16 bg-gray-50 border-t border-gray-200">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <i class="fas fa-mosque text-blue-600 text-4xl mb-4 floating-icon"></i>
            <h2 class="text-3xl font-bold text-gray-800 mb-3">Besoin de conseils spirituels ?</h2>
            <p class="text-gray-600 max-w-xl mx-auto text-sm sm:text-base">
                Nos imams sont à votre écoute pour toute question liée à la religion, la spiritualité ou la vie quotidienne selon les principes de l’Islam.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 mb-12">
            <a href="{{ route('messages.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                <i class="fas fa-question-circle mr-3"></i>
                Poser une question
            </a>
        </div>

        <!-- Popular Topics -->
        <div>
            <h3 class="text-xl font-semibold text-gray-800 mb-6 text-center">Sujets fréquemment abordés</h3>
            <div class="flex flex-wrap justify-center gap-3">
                @php
                $topics = [
                ['icon' => 'fa-pray', 'text' => 'Prière (Salah)', 'bg' => 'bg-blue-100', 'textColor' => 'text-blue-800'],
                ['icon' => 'fa-moon', 'text' => 'Ramadan & Jeûne', 'bg' => 'bg-purple-100', 'textColor' => 'text-purple-800'],
                ['icon' => 'fa-hand-holding-heart', 'text' => 'Zakat & Charité', 'bg' => 'bg-green-100', 'textColor' => 'text-green-800'],
                ['icon' => 'fa-kaaba', 'text' => 'Hajj & Omra', 'bg' => 'bg-yellow-100', 'textColor' => 'text-yellow-800'],
                ['icon' => 'fa-heart', 'text' => 'Mariage & Famille', 'bg' => 'bg-red-100', 'textColor' => 'text-red-800'],
                ['icon' => 'fa-book', 'text' => 'Lecture du Coran', 'bg' => 'bg-indigo-100', 'textColor' => 'text-indigo-800'],
                ];
                @endphp

                @foreach ($topics as $topic)
                <span class="inline-flex items-center px-4 py-2 {{ $topic['bg'] }} {{ $topic['textColor'] }} rounded-full text-sm font-medium shadow-sm">
                    <i class="fas {{ $topic['icon'] }} mr-2"></i>{{ $topic['text'] }}
                </span>
                @endforeach
            </div>
        </div>
    </div>
</section>


<!-- Styles supplémentaires -->
<style>
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Styles pour les onglets */
    .tab-button {
        background: transparent;
        color: #6B7280;
        position: relative;
    }

    .tab-button.active {
        background: linear-gradient(135deg, #3B82F6, #8B5CF6);
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .tab-button:hover:not(.active) {
        background: #F3F4F6;
        color: #374151;
    }

    /* Contenu des onglets */
    .tab-content {
        display: none;
        animation: fadeInUp 0.5s ease-out;
    }

    .tab-content.active {
        display: block;
    }

    /* Animation pour les cartes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .course-card {
        animation: fadeInUp 0.6s ease-out;
    }

    .course-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .course-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .course-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .course-card:nth-child(4) {
        animation-delay: 0.4s;
    }

    .course-card:nth-child(5) {
        animation-delay: 0.5s;
    }

    .course-card:nth-child(6) {
        animation-delay: 0.6s;
    }

    /* Style pour les images d'articles */
    .course-card img {
        transition: transform 0.3s ease;
    }

    .course-card:hover img {
        transform: scale(1.05);
    }

    /* Effet de survol pour les badges */
    .status-badge {
        position: relative;
        overflow: hidden;
    }

    .status-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .status-badge:hover::before {
        left: 100%;
    }

    /* Animations pour la section Questions aux Imams */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .floating-icon {
        animation: float 3s ease-in-out infinite;
    }

    /* Effet de pulsation pour les boutons CTA */
    @keyframes pulse {

        0%,
        100% {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
        }

        50% {
            box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
        }
    }

    .pulse-green {
        animation: pulse 2s infinite;
    }
</style>


<script>

document.addEventListener('DOMContentLoaded', function() {
    // Gestion des onglets
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Retirer la classe active de tous les boutons et contenus
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Ajouter la classe active au bouton cliqué
            this.classList.add('active');
            
            // Afficher le contenu correspondant
            const targetContent = document.getElementById(targetTab + '-content');
            if (targetContent) {
                targetContent.classList.add('active');
            }
        });
    });

    // Animation des cartes au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('course-card');
                }
            });
        }, observerOptions);

        // Observer toutes les cartes de cours
        document.querySelectorAll('.bg-white.rounded-xl.shadow-lg').forEach(card => {
            observer.observe(card);
        });


    // Observer toutes les cartes
    document.querySelectorAll('.bg-white.rounded-xl.shadow-lg').forEach(card => {
        observer.observe(card);
    });

    // Smooth scroll pour les liens d'ancrage
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endsection