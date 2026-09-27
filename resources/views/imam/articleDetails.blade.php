@extends('imam/imamLayout')
@section('articles')

<div class="article-page max-w-5xl mx-auto px-6 py-8">
    {{-- Navigation de retour --}}
    <nav class="mb-8">
        <a href="{{ route('imam.articles') }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            <span>Retour à la liste des articles</span>
        </a>
    </nav>

    {{-- En-tête de l'article --}}
    <header class="mb-8 bg-white rounded-lg shadow-sm p-6">
        {{-- Métadonnées --}}
        <div class="flex items-center gap-4 mb-4 text-sm text-gray-600">
            <div class="flex items-center">
                <i class="fas fa-calendar-alt mr-1"></i>
                <time datetime="{{ $article->created_at->format('Y-m-d') }}">
                    Publié le {{ $article->created_at->format('d F Y') }}
                </time>
            </div>
            
            

            @if($article->updated_at->gt($article->created_at))
                <span class="text-gray-300">|</span>
                <div class="flex items-center">
                    <i class="fas fa-edit mr-1"></i>
                    <span>Modifié le {{ $article->updated_at->format('d F Y') }}</span>
                </div>
            @endif
        </div>

        {{-- Titre principal --}}
        <h1 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">
            {{ $article->name }}
        </h1>

        {{-- Tags et statut --}}
        <div class="flex flex-wrap gap-2">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                <i class="fas fa-newspaper mr-1"></i>
                Article
            </span>
            
            @if($article->is_featured ?? false)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    <i class="fas fa-star mr-1"></i>
                    À la une
                </span>
            @endif
        </div>
    </header>

    {{-- Contenu principal --}}
    <main class="bg-white rounded-lg shadow-sm">
        {{-- Image de l'article --}}
        @if($article->image)
            <div class="mb-8">
                <figure class="text-center">
                    <img src="{{ asset('storage/articles/' . $article->image) }}" 
                         alt="{{ $article->name }}" 
                         class="w-full max-w-2xl mx-auto rounded-lg shadow-md object-cover"
                         loading="lazy">
                </figure>
            </div>
        @endif

        {{-- Contenu de l'article --}}
        <section class="p-6">
            <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                {!! nl2br(e($article->description)) !!}
            </div>
        </section>

        {{-- Actions sur l'article --}}
        <section class="px-6 pb-6 border-t border-gray-100 pt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions</h3>
            <div class="flex flex-wrap gap-3">
                <button onclick="openEditModal({{ $article->id }}, {{ json_encode($article->name) }}, {{ json_encode($article->description) }})" 
                        class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition-colors duration-200 shadow-sm">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier l'article
                </button>
                
                <button onclick="confirmDelete({{ $article->id }})" 
                        class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-200 shadow-sm">
                    <i class="fas fa-trash-alt mr-2"></i>
                    Supprimer l'article
                </button>
            </div>
        </section>
    </main>

    {{-- Articles similaires --}}
    @if(isset($relatedArticles) && $relatedArticles->count() > 0)
        <section class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Articles similaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedArticles as $relatedArticle)
                    <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                        <a href="{{ route('articles.show', $relatedArticle->id) }}" class="block">
                            <div class="p-5">
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                    {{ $relatedArticle->name }}
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-3 mb-3">
                                    {{ Str::limit(strip_tags($relatedArticle->description), 120) }}
                                </p>
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span>{{ $relatedArticle->created_at->format('d M Y') }}</span>
                                    <span class="text-blue-600 font-medium">Lire l'article →</span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</div>

{{-- Modal de modification --}}
<div id="edit-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4" role="dialog" aria-labelledby="edit-modal-title">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        {{-- En-tête du modal --}}
        <header class="flex items-center justify-between p-6 border-b border-gray-200">
            <h2 id="edit-modal-title" class="text-xl font-bold text-gray-900">
                Modifier l'article
            </h2>
            <button id="close-modal" class="text-gray-400 hover:text-gray-600 transition-colors duration-200" aria-label="Fermer le modal">
                <i class="fas fa-times text-xl"></i>
            </button>
        </header>

        {{-- Formulaire --}}
        <form id="edit-form" method="POST" action="{{ route('articles.edit') }}" class="p-6">
            @csrf
            @method('PUT')
            <input type="hidden" id="article-id" name="id">

            <div class="space-y-6">
                {{-- Titre --}}
                <div>
                    <label for="article-title" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-heading mr-1"></i>
                        Titre de l'article
                    </label>
                    <input type="text" 
                           id="article-title" 
                           name="name" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200"
                           placeholder="Saisissez le titre de votre article">
                </div>

                {{-- Description --}}
                <div>
                    <label for="article-description" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left mr-1"></i>
                        Contenu de l'article
                    </label>
                    <textarea id="article-description" 
                              name="description" 
                              rows="8" 
                              required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors duration-200 resize-vertical"
                              placeholder="Rédigez le contenu de votre article..."></textarea>
                </div>
            </div>

            {{-- Actions du formulaire --}}
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="button" 
                        id="cancel-edit" 
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    Annuler
                </button>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 shadow-sm">
                    <i class="fas fa-save mr-2"></i>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Formulaire de suppression masqué --}}
<form id="delete-form" method="POST" action="" class="hidden">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editModal = document.getElementById('edit-modal');
    const closeModalBtn = document.getElementById('close-modal');
    const cancelEditBtn = document.getElementById('cancel-edit');
    const deleteForm = document.getElementById('delete-form');

    // Fonctions de gestion du modal
    function openModal() {
        editModal.classList.remove('hidden');
        editModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        editModal.classList.add('hidden');
        editModal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Écouteurs d'événements
    closeModalBtn.addEventListener('click', closeModal);
    cancelEditBtn.addEventListener('click', closeModal);

    // Fermeture en cliquant en dehors du modal
    editModal.addEventListener('click', function(e) {
        if (e.target === editModal) {
            closeModal();
        }
    });

    // Fermeture avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !editModal.classList.contains('hidden')) {
            closeModal();
        }
    });

    // Fonction globale pour ouvrir le modal d'édition
    window.openEditModal = function(id, name, description) {
        document.getElementById('article-id').value = id;
        document.getElementById('article-title').value = name;
        document.getElementById('article-description').value = description;
        openModal();
    };

    // Fonction globale pour confirmer la suppression
    window.confirmDelete = function(articleId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cet article ? Cette action est irréversible.')) {
            deleteForm.action = `/articles/${articleId}`;
            deleteForm.submit();
        }
    };
});
</script>
@endpush

@endsection