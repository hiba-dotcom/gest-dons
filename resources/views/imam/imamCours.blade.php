@extends('imam/imamLayout')

<!-- Course Management Section -->
@section('cours')
@if(session('success'))
<div class="bg-green-100 text-green-800 border border-green-300 rounded-lg px-4 py-2 text-sm">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="bg-red-100 text-red-800 border border-red-300 rounded-lg px-4 py-2 text-sm">
    <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="p-4">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Mes Cours</h1>
                    <p class="text-gray-600 text-sm">Gérez vos cours islamiques</p>
                </div>
            </div>
            <button id="add-course-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                <i class="fas fa-plus"></i>
                <span>Nouveau Cours</span>
            </button>
        </div>
    </div>



    <!-- Courses Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-100">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Liste de vos Cours</h3>

            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cours</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($cours as $cour)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-book text-blue-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{$cour->name}}</div>
                                    <div class="text-xs text-gray-500">{{$cour->categorie}}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <p class="text-sm text-gray-600 max-w-xs truncate">
                                {{$cour->description}}
                            </p>
                        </td>
                        <td class="px-4 py-4">
                            @php
                            $statusConfig = [
                            'pending' => ['text' => 'En attente', 'class' => 'bg-yellow-500'],
                            'validé' => ['text' => 'Validée', 'class' => 'bg-green-500'],
                            'refusé' => ['text' => 'Refusée', 'class' => 'bg-red-500']
                            ];
                            $config = $statusConfig[$cour->statut] ?? $statusConfig['pending'];
                            @endphp
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $config['class'] }} text-white">
                                {{ $config['text'] }}
                            </span>

                        </td>
                        <td class="px-4 py-4">
                            <div class="text-sm text-gray-900"> {{ $cour->created_at->format('d M Y') }}</div>

                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{route ('cours.detail' , ['id' => $cour->id])}}" class="w-7 h-7 bg-blue-100 hover:bg-blue-200 rounded-md flex items-center justify-center">
                                    <i class="fas fa-eye text-blue-600 text-xs"></i>
                                </a>
                                <button class="w-7 h-7 bg-amber-100 hover:bg-amber-200 rounded-md flex items-center justify-center">
                                    <i class="fas fa-edit text-amber-600 text-xs"></i>
                                </button>
                                <button class="w-7 h-7 bg-red-100 hover:bg-red-200 rounded-md flex items-center justify-center"
                                    onclick="confirmDelete('Les Fondements de l\'Islam')">
                                    <i class="fas fa-trash text-red-600 text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 border-t border-gray-100">
            <!-- Version responsive -->
            <div class="flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0">
                <!-- Informations de pagination -->
                <div class="text-sm text-gray-700">
                    @if($cours->count() > 0)
                    Affichage de
                    <span class="font-medium text-gray-900">{{ $cours->firstItem() }}</span>
                    à
                    <span class="font-medium text-gray-900">{{ $cours->lastItem() }}</span>
                    sur
                    <span class="font-medium text-gray-900">{{ $cours->total() }}</span>
                    cours
                    @else
                    <span class="text-gray-500">Aucun cours trouvé</span>
                    @endif
                </div>

                <!-- Liens de pagination -->
                <div class="flex items-center space-x-2">
                    @if($cours->hasPages())
                    <div class="flex items-center">
                        {{ $cours->appends(request()->query())->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Compact Modal -->
<div id="course-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden opacity-0 transition-opacity duration-300">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full transform scale-95 transition-transform duration-300" id="modal-content">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4 rounded-t-xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white">Nouveau Cours</h3>
                    <button id="close-modal" class="w-8 h-8 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-times text-white text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form class="p-6 space-y-4" method="post" action="{{route('cours.store')}}" enctype="multipart/form-data">
                @csrf
                <!-- Course Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nom du Cours <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Ex: Les Fondements de l'Islam">
                </div>

                <!-- Course Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea rows="3" name="description" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                        placeholder="Décrivez le contenu du cours..."></textarea>
                </div>

                <!-- Video Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Vidéo du Cours <span class="text-red-500">*</span>
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-500 hover:bg-blue-50 transition-colors" id="upload-area">
                        <input type="file" name="video" accept="video/*" required class="hidden" id="video-input">
                        <div id="upload-placeholder">
                            <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                            <p class="text-sm text-gray-600">Cliquez pour sélectionner</p>
                            <p class="text-xs text-gray-500">MP4, AVI, MOV (Max: 100MB)</p>
                        </div>
                        <div id="file-preview" class="hidden">
                            <i class="fas fa-video text-2xl text-green-600 mb-2"></i>
                            <p id="file-name" class="text-sm font-medium text-gray-800"></p>
                            <button type="button" id="remove-file" class="text-red-500 hover:text-red-700 text-xs mt-1">
                                <i class="fas fa-trash mr-1"></i>Supprimer
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                    <select name="categorie" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $categorie)
                        <option value="{{$categorie}}">{{$categorie}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" id="cancel-btn"
                        class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition-colors">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm flex items-center space-x-1 transition-colors">
                        <i class="fas fa-save text-xs"></i>
                        <span>Enregistrer</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('course-modal');
        const modalContent = document.getElementById('modal-content');
        const addBtn = document.getElementById('add-course-btn');
        const closeBtn = document.getElementById('close-modal');
        const cancelBtn = document.getElementById('cancel-btn');
        const uploadArea = document.getElementById('upload-area');
        const videoInput = document.getElementById('video-input');
        const uploadPlaceholder = document.getElementById('upload-placeholder');
        const filePreview = document.getElementById('file-preview');
        const fileName = document.getElementById('file-name');
        const removeBtn = document.getElementById('remove-file');

        // Modal controls
        addBtn?.addEventListener('click', openModal);
        closeBtn?.addEventListener('click', closeModal);
        cancelBtn?.addEventListener('click', closeModal);
        modal?.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        function openModal() {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
                resetForm();
            }, 300);
        }

        // File upload
        uploadArea?.addEventListener('click', () => videoInput?.click());
        videoInput?.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                fileName.textContent = file.name;
                uploadPlaceholder.classList.add('hidden');
                filePreview.classList.remove('hidden');
            }
        });

        removeBtn?.addEventListener('click', () => {
            videoInput.value = '';
            uploadPlaceholder.classList.remove('hidden');
            filePreview.classList.add('hidden');
        });

        function resetForm() {
            modal.querySelector('form')?.reset();
            uploadPlaceholder?.classList.remove('hidden');
            filePreview?.classList.add('hidden');
        }

        // Delete confirmation
        window.confirmDelete = function(courseName) {
            if (confirm(`Supprimer "${courseName}" ?`)) {
                console.log(`Deleting: ${courseName}`);
            }
        };
    });
</script>
@endsection