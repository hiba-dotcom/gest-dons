<!-- Course Details Section -->
 @extends('admin/adminLayout')
@section('coursDetails')
<div class="p-4">
    <!-- Header with Back Button -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <button onclick="history.back()" class="w-10 h-10 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center justify-center transition-colors">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </button>
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-play text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ $cours->name ?? 'Détails du Cours' }}</h1>
                        <p class="text-gray-600 text-sm">Par {{ $cours->user->firstname}} {{ $cours->user->lastname}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Video Player Section -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Video Player -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="aspect-video bg-gray-900 relative">
                    @if($cours->video ?? null)
                        <video 
                            id="course-video" 
                            class="w-full h-full object-cover" 
                            controls 
                            poster="{{ asset('images/video-placeholder.png') }}"
                        >
                            <source src="{{ Storage::url($cours->video) }}" type="video/mp4">
                            <p class="text-white p-4">Votre navigateur ne supporte pas la lecture vidéo.</p>
                        </video>
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="text-center text-gray-400">
                                <i class="fas fa-video text-4xl mb-3"></i>
                                <p>Aucune vidéo disponible</p>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Video Controls -->
                <div class="p-4 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button id="play-pause-btn" class="w-10 h-10 bg-blue-100 hover:bg-blue-200 rounded-lg flex items-center justify-center transition-colors">
                                <i class="fas fa-play text-blue-600"></i>
                            </button>
                            <div class="flex items-center space-x-2 text-sm text-gray-600">
                                <span id="current-time">0:00</span>
                                <span>/</span>
                                <span id="duration">0:00</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center justify-center transition-colors">
                                <i class="fas fa-volume-up text-gray-600 text-sm"></i>
                            </button>
                            <button class="w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center justify-center transition-colors">
                                <i class="fas fa-expand text-gray-600 text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Description -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Description du Cours</h3>
                <div class="prose prose-sm max-w-none">
                    <p class="text-gray-600 leading-relaxed">
                        {{ $cours->description ?? 'Aucune description disponible pour ce cours.' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Course Information Panel -->
        <div class="space-y-6">
            <!-- Course Stats -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informations</h3>
                <div class="space-y-4">
                    <!-- Category -->
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tag text-purple-600 text-sm"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Catégorie</span>
                        </div>
                        <span class="text-sm text-gray-900 font-semibold">
                            {{ $cours->categorie ?? 'Non définie' }}
                        </span>
                    </div>

                    <!-- Instructor -->
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-tie text-green-600 text-sm"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Enseignant</span>
                        </div>
                        <span class="text-sm text-gray-900 font-semibold">
                            {{ $cours->user->firstname }} {{ $cours->user->lastname}}
                        </span>
                    </div>

                    <!-- Date Added -->
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar text-blue-600 text-sm"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Date d'ajout</span>
                        </div>
                        <span class="text-sm text-gray-900 font-semibold">
                            {{ $cours->created_at ? $cours->created_at->format('d M Y') : 'Non définie' }}
                        </span>
                    </div>

                    <!-- Video Status -->
                    <div class="flex items-center justify-between py-2">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-video text-amber-600 text-sm"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-700">Statut Vidéo</span>
                        </div>
                        @php
                            $statusConfig = [
                            'pending' => ['text' => 'En attente', 'class' => 'bg-yellow-500'],
                            'validé' => ['text' => 'Validée', 'class' => 'bg-green-500'],
                            'refusé' => ['text' => 'Refusée', 'class' => 'bg-red-500']
                            ];
                            $config = $statusConfig[$cours->statut] ?? $statusConfig['pending'];
                            @endphp
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $config['class'] }} text-white">
                                {{ $config['text'] }}
                            </span>
                    </div>
                </div>
            </div>

            
            <!-- File Information -->
            @if($cours->video ?? null)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Fichier Vidéo</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Nom du fichier:</span>
                        <span class="text-gray-900 font-medium">{{ basename($cours->video) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Format:</span>
                        <span class="text-gray-900 font-medium">{{ strtoupper(pathinfo($cours->video, PATHINFO_EXTENSION)) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Taille:</span>
                        <span class="text-gray-900 font-medium" id="file-size">Calcul...</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('course-video');
    const playPauseBtn = document.getElementById('play-pause-btn');
    const currentTimeSpan = document.getElementById('current-time');
    const durationSpan = document.getElementById('duration');

    if (video) {
        // Video controls
        playPauseBtn?.addEventListener('click', function() {
            if (video.paused) {
                video.play();
                this.innerHTML = '<i class="fas fa-pause text-blue-600"></i>';
            } else {
                video.pause();
                this.innerHTML = '<i class="fas fa-play text-blue-600"></i>';
            }
        });

        // Update time display
        video.addEventListener('timeupdate', function() {
            if (currentTimeSpan) {
                currentTimeSpan.textContent = formatTime(video.currentTime);
            }
        });

        video.addEventListener('loadedmetadata', function() {
            if (durationSpan) {
                durationSpan.textContent = formatTime(video.duration);
            }
        });

        // Get file size (approximate)
        video.addEventListener('loadstart', function() {
            const fileSizeElement = document.getElementById('file-size');
            if (fileSizeElement) {
                // This is an approximation since we can't get exact file size from video element
                fileSizeElement.textContent = 'Chargement...';
            }
        });
    }

    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
    }

    // Delete confirmation
    window.confirmDelete = function(courseName) {
        if (confirm(`Êtes-vous sûr de vouloir supprimer "${courseName}" ? Cette action est irréversible.`)) {
            // Add your delete logic here
            window.location.href = '/cours'; // Redirect after deletion
        }
    };

    // Edit course
    document.getElementById('edit-course-btn')?.addEventListener('click', function() {
        // Add your edit logic here or redirect to edit page
        window.location.href = `/cours/{{ $cours->id ?? 'edit' }}/edit`;
    });
});
</script>
@endsection