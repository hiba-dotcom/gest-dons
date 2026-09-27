<!-- User Course Details Section -->
@extends('layout')
@section('coursDetails')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Breadcrumb -->
                <nav class="mb-6">
                    <ol class="flex items-center space-x-2 text-blue-100">
                        <li><a href="/" class="hover:text-white transition-colors">Accueil</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li><a href="{{ route('cours') }}" class="hover:text-white transition-colors">Cours</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li class="text-white">{{ $cours->name ?? 'Détails du cours' }}</li>
                    </ol>
                </nav>

                <!-- Course Header -->
                <div class="flex items-start space-x-6">
                    <div class="w-20 h-20 bg-white bg-opacity-20 backdrop-blur-lg rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-graduation-cap text-3xl text-white"></i>
                    </div>
                    <div class="flex-1">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">
                            {{ $cours->name ?? 'Titre du Cours' }}
                        </h1>
                        <div class="flex items-center space-x-6 text-blue-100">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user-tie"></i>
                                <span>{{ $cours->user->firstname }} {{ $cours->user->lastname }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-tag"></i>
                                <span>{{ $cours->categorie ?? 'Général' }}</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ $cours->created_at ? $cours->created_at->format('d M Y') : 'Récent' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
                <!-- Video and Description Section -->
                <div class="xl:col-span-3 space-y-8">
                    <!-- Video Player -->
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                        <div class="aspect-video bg-gradient-to-br from-gray-900 to-gray-800 relative">
                            @if($cours->video ?? null)
                                <video 
                                    id="main-video" 
                                    class="w-full h-full object-cover" 
                                    controls 
                                    poster="{{ asset('images/course-placeholder.jpg') }}"
                                >
                                    <source src="{{ Storage::url($cours->video) }}" type="video/mp4">
                                    <p class="text-white p-8 text-center">
                                        <i class="fas fa-exclamation-triangle text-yellow-400 text-2xl mb-4 block"></i>
                                        Votre navigateur ne supporte pas la lecture vidéo.
                                    </p>
                                </video>
                                <!-- Video Overlay Controls -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center opacity-0 hover:opacity-100">
                                    <button id="video-play-overlay" class="w-20 h-20 bg-white bg-opacity-90 rounded-full flex items-center justify-center transform hover:scale-110 transition-all">
                                        <i class="fas fa-play text-gray-800 text-2xl ml-1"></i>
                                    </button>
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="text-center text-gray-400">
                                        <i class="fas fa-video text-6xl mb-6 opacity-50"></i>
                                        <h3 class="text-2xl font-semibold mb-2">Vidéo en préparation</h3>
                                        <p class="text-lg">Le contenu sera bientôt disponible</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Enhanced Video Progress Bar -->
                        <div class="p-6 bg-gradient-to-r from-blue-50 to-purple-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <button id="main-play-btn" class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 rounded-full flex items-center justify-center transition-all transform hover:scale-105 shadow-lg">
                                        <i class="fas fa-play text-white"></i>
                                    </button>
                                    <div class="flex items-center space-x-3 text-gray-600">
                                        <span id="current-time" class="font-medium">0:00</span>
                                        <div class="w-px h-4 bg-gray-300"></div>
                                        <span id="total-duration" class="font-medium">0:00</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <button class="w-10 h-10 bg-white hover:bg-gray-50 rounded-full flex items-center justify-center transition-all shadow-md">
                                        <i class="fas fa-volume-up text-gray-600"></i>
                                    </button>
                                    <button class="w-10 h-10 bg-white hover:bg-gray-50 rounded-full flex items-center justify-center transition-all shadow-md">
                                        <i class="fas fa-cog text-gray-600"></i>
                                    </button>
                                    <button class="w-10 h-10 bg-white hover:bg-gray-50 rounded-full flex items-center justify-center transition-all shadow-md">
                                        <i class="fas fa-expand text-gray-600"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- Progress Bar -->
                            <div class="mt-4">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div id="progress-bar" class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 rounded-full transition-all" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Description -->
                    <div class="bg-white rounded-3xl shadow-xl p-8">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-blue-500 rounded-xl flex items-center justify-center">
                                <i class="fas fa-book-open text-white"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">À propos de ce cours</h2>
                        </div>
                        <div class="prose prose-lg max-w-none">
                            <p class="text-gray-600 leading-relaxed text-lg">
                                {{ $cours->description ?? 'Ce cours vous permettra d\'approfondir vos connaissances dans le domaine islamique. Un contenu riche et structuré vous attend pour enrichir votre parcours spirituel et intellectuel.' }}
                            </p>
                        </div>
                        
                        <!-- Course Tags -->
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Mots-clés</h3>
                            <div class="flex flex-wrap gap-3">
                                <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Islam</span>
                                <span class="px-4 py-2 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">Éducation</span>
                                <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">{{ $cours->categorie ?? 'Spiritualité' }}</span>
                                <span class="px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">Formation</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="xl:col-span-1 space-y-6">
                    <!-- Course Info Card -->
                    <div class="bg-white rounded-3xl shadow-xl p-6 sticky top-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Informations du cours</h3>
                        
                        <!-- Instructor -->
                        <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user-graduate text-white"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">Enseignant</p>
                                <p class="font-semibold text-gray-800">{{ $cours->user->firstname }} {{ $cours->user->lastname }}</p>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="flex items-center justify-between py-4 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-bookmark text-orange-600 text-sm"></i>
                                </div>
                                <span class="text-gray-700 font-medium">Catégorie</span>
                            </div>
                            <span class="text-gray-900 font-semibold">{{ $cours->categorie ?? 'Général' }}</span>
                        </div>

                        <!-- Date -->
                        <div class="flex items-center justify-between py-4 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-plus text-indigo-600 text-sm"></i>
                                </div>
                                <span class="text-gray-700 font-medium">Publié le</span>
                            </div>
                            <span class="text-gray-900 font-semibold">
                                {{ $cours->created_at ? $cours->created_at->format('d M Y') : 'Récemment' }}
                            </span>
                        </div>

                        <!-- Duration (if video exists) -->
                        @if($cours->video ?? null)
                        <div class="flex items-center justify-between py-4 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-clock text-green-600 text-sm"></i>
                                </div>
                                <span class="text-gray-700 font-medium">Durée</span>
                            </div>
                            <span class="text-gray-900 font-semibold" id="video-duration">Chargement...</span>
                        </div>
                        @endif

                       
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('main-video');
    const playBtn = document.getElementById('main-play-btn');
    const playOverlay = document.getElementById('video-play-overlay');
    const currentTimeSpan = document.getElementById('current-time');
    const durationSpan = document.getElementById('total-duration');
    const progressBar = document.getElementById('progress-bar');
    const videoDurationSpan = document.getElementById('video-duration');

    if (video && playBtn) {
        // Play/Pause functionality
        function togglePlayPause() {
            if (video.paused) {
                video.play();
                playBtn.innerHTML = '<i class="fas fa-pause text-white"></i>';
            } else {
                video.pause();
                playBtn.innerHTML = '<i class="fas fa-play text-white"></i>';
            }
        }

        playBtn.addEventListener('click', togglePlayPause);
        if (playOverlay) {
            playOverlay.addEventListener('click', togglePlayPause);
        }

        // Time updates
        video.addEventListener('timeupdate', function() {
            if (currentTimeSpan) {
                currentTimeSpan.textContent = formatTime(video.currentTime);
            }
            
            // Update progress bar
            if (progressBar && video.duration) {
                const progress = (video.currentTime / video.duration) * 100;
                progressBar.style.width = progress + '%';
            }
        });

        // Duration loaded
        video.addEventListener('loadedmetadata', function() {
            if (durationSpan) {
                durationSpan.textContent = formatTime(video.duration);
            }
            if (videoDurationSpan) {
                videoDurationSpan.textContent = formatTime(video.duration);
            }
        });

        // Video ended
        video.addEventListener('ended', function() {
            playBtn.innerHTML = '<i class="fas fa-play text-white"></i>';
            progressBar.style.width = '0%';
        });
    }

    function formatTime(seconds) {
        const hours = Math.floor(seconds / 3600);
        const mins = Math.floor((seconds % 3600) / 60);
        const secs = Math.floor(seconds % 60);
        
        if (hours > 0) {
            return `${hours}:${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        } else {
            return `${mins}:${secs.toString().padStart(2, '0')}`;
        }
    }

    // Smooth scroll to top when page loads
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>
@endsection