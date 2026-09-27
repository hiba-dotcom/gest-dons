@extends('imam/imamLayout')
@section('articles')
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
<!-- Articles Section -->
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Articles</h1>
        <p class="text-gray-600">Gérez et consultez tous les articles</p>
    </div>

    <!-- Search and Actions Bar -->
    <div class="card p-4 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Rechercher un article..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

            </div>
            <button id="add-article-btn" class="btn-primary px-6 py-2 rounded-lg font-medium">
                <i class="fas fa-plus mr-2"></i>
                Nouvel Article
            </button>
        </div>
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($articles as $article)
        <div class="card overflow-hidden">
            <div class="p-4">
                <div class="flex items-center justify-between mb-3">
                    <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-medium">Article</span>
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-calendar mr-1"></i>
                        {{ $article->created_at->format('d M Y') }}
                    </div>
                </div>
                <h3 class="font-semibold text-lg mb-2 text-gray-800">{{ $article->name }}</h3>
                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                    {{ Str::limit($article->description ?? $article->description, 100) }}
                </p>
                
            </div>
            <div class="relative">
                <img src="{{ asset('storage/articles/' . $article->image) }}"
                    alt="{{ $article->name }}" class="w-full h-48 object-cover">
            </div>
            <div class="p-4">
                <div class="flex space-x-2">
                    <a href="{{ route('articles.show', $article->id) }}" class="btn-primary px-3 py-1 rounded text-sm flex-1 text-center">
                        <i class="fas fa-eye mr-1"></i>
                        Voir
                    </a>
                    <button onclick="openUpdateModal({{ $article->id }}, '{{ addslashes($article->name) }}', '{{ addslashes($article->description) }}')" class="btn-warning px-3 py-1 rounded text-sm bg-yellow-500 text-white hover:bg-yellow-600">
                        <i class="fas fa-edit"></i>
                        Modifier
                    </button>
                    <form action="{{ route('articles.destroy', $article->id) }}" method="post" class="inline"
                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger px-3 py-1 rounded text-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
    <div class="mt-6">
        {{ $articles->links() }}
    </div>
    @endif

    <!-- Empty State -->
    @if($articles->isEmpty())
    <div class="text-center py-12">
        <i class="fas fa-newspaper text-gray-300 text-6xl mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">Aucun article trouvé</h3>
        <p class="text-gray-500 mb-4">Commencez par créer votre premier article</p>
        <button id="empty-add-article-btn" class="btn-primary px-6 py-2 rounded-lg font-medium">
            <i class="fas fa-plus mr-2"></i>
            Créer un article
        </button>
    </div>
    @endif
</div>

<!-- Add Article Modal -->
<div id="add-article-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Nouvel Article</h2>
            <button id="close-modal" class="text-gray-400 hover:text-gray-600 text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre de l'article</label>
                <input type="text" id="title" name="name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Entrez le titre de l'article">
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                    <input type="file" id="image" name="image" accept="image/*" class="hidden">
                    <div id="upload-area" class="cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600">Cliquez pour télécharger une image</p>
                        <p class="text-sm text-gray-500">PNG, JPG, JPEG jusqu'à 5MB</p>
                    </div>
                    <div id="image-preview" class="hidden">
                        <img src="/placeholder.svg" alt="Preview" class="max-h-32 mx-auto rounded">
                        <p class="text-sm text-gray-600 mt-2">Image sélectionnée</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Contenu</label>
                <textarea id="content" name="description" rows="8" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Rédigez le contenu de votre article..."></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <button type="button" id="cancel-btn" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Annuler
                </button>
                <button type="submit" class="btn-primary px-6 py-2 rounded-lg font-medium">
                    <i class="fas fa-save mr-2"></i>
                    Créer l'article
                </button>
            </div>
        </form>
    </div>
</div>

<!-- UPDATE ARTICLE MODAL - HERE IT IS! -->
<div id="update-article-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Modifier l'Article</h2>
            <button id="close-update-modal" class="text-gray-400 hover:text-gray-600 text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="update-article-form" method="POST" action="{{route('articles.edit')}}">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label for="update-title" class="block text-sm font-medium text-gray-700 mb-2">Titre de l'article</label>
                <input type="text" id="update-title" name="name" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Entrez le titre de l'article">
            </div>
            <div class="mb-4">
                <input type="hidden"  name="article_id" value="{{$article->id}}">
            </div>

            <!-- Content -->
            <div class="mb-6">
                <label for="update-content" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea id="update-content" name="description" rows="8" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Rédigez le contenu de votre article..."></textarea>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <button type="button" id="cancel-update-btn" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Annuler
                </button>
                <button type="submit" class="btn-primary px-6 py-2 rounded-lg font-medium">
                    <i class="fas fa-save mr-2"></i>
                    Mettre à jour l'article
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('add-article-modal');
        const updateModal = document.getElementById('update-article-modal');
        const addArticleBtn = document.getElementById('add-article-btn');
        const emptyAddArticleBtn = document.getElementById('empty-add-article-btn');
        const closeModal = document.getElementById('close-modal');
        const closeUpdateModal = document.getElementById('close-update-modal');
        const cancelBtn = document.getElementById('cancel-btn');
        const cancelUpdateBtn = document.getElementById('cancel-update-btn');
        const imageInput = document.getElementById('image');
        const uploadArea = document.getElementById('upload-area');
        const imagePreview = document.getElementById('image-preview');

        // Open add modal
        function openModal() {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Close add modal
        function closeModalFunc() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.querySelector('#add-article-modal form').reset();
            uploadArea.classList.remove('hidden');
            imagePreview.classList.add('hidden');
        }

        // Close update modal
        function closeUpdateModalFunc() {
            updateModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.querySelector('#update-article-form').reset();
        }

        // Event listeners for add modal
        if (addArticleBtn) {
            addArticleBtn.addEventListener('click', openModal);
        }
        if (emptyAddArticleBtn) {
            emptyAddArticleBtn.addEventListener('click', openModal);
        }
        closeModal.addEventListener('click', closeModalFunc);
        cancelBtn.addEventListener('click', closeModalFunc);

        // Event listeners for update modal
        closeUpdateModal.addEventListener('click', closeUpdateModalFunc);
        cancelUpdateBtn.addEventListener('click', closeUpdateModalFunc);

        // Close modals when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModalFunc();
            }
        });

        updateModal.addEventListener('click', function(e) {
            if (e.target === updateModal) {
                closeUpdateModalFunc();
            }
        });

        // Image upload handling
        uploadArea.addEventListener('click', function() {
            imageInput.click();
        });

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.querySelector('img').src = e.target.result;
                    uploadArea.classList.add('hidden');
                    imagePreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        imagePreview.addEventListener('click', function() {
            imageInput.click();
        });

        // Global function to open update modal
        window.openUpdateModal = function(id, name, description) {
            console.log('Opening update modal for article:', id, name, description);
            document.getElementById('update-title').value = name;
            document.getElementById('update-content').value = description;
            updateModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        };
    });
</script>

@endsection