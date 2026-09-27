@extends('layout')

@section('articleDetails')
<!-- Article Details Section -->
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li>
                    <a href="/" class="text-gray-500 hover:text-blue-800 transition-colors">
                        <i class="fas fa-home mr-2"></i>{{ __('messages.home') }}
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="{{ route('cours') }}" class="text-gray-500 hover:text-blue-800 transition-colors">{{ __('messages.courses') }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-700 font-medium">Détails de l'article</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Article Header -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-800 to-indigo-900 text-white p-8">
                <div class="flex items-center mb-4">
                    <div class="bg-white bg-opacity-20 rounded-full p-3 mr-4">
                        <i class="fas fa-book text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $article->name ?? 'Titre de l\'Article' }}</h1>
                        <div class="flex items-center text-blue-200">
                            <i class="fas fa-user-circle mr-2"></i>
                            <span class="text-lg">Par: <strong>{{ $article->imam->firstname }} {{ $article->imam->lastname  }}</strong></span>
                        </div>
                    </div>
                </div>
                
                <!-- Article Meta Info -->
                <div class="flex flex-wrap items-center gap-4 text-blue-200">
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>{{ isset($article->created_at) ? $article->created_at->format('d/m/Y') : 'Date de publication' }}</span>
                    </div>
                    
                    
                </div>
            </div>
        </div>

        <!-- Article Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-2">
                <!-- Article Description -->
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                    <div class="flex items-center mb-6">
                        <div class="bg-gradient-to-r from-blue-800 to-indigo-900 text-white rounded-full p-2 mr-3">
                            <i class="fas fa-align-left"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Contenu de l'Article</h2>
                    </div>
                    
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-700 leading-relaxed space-y-4">
                            {!!$article->description ?? 
                            '<p class="text-lg leading-8">Ceci est un exemple de description d\'article. Cette section contient le contenu principal de l\'article, incluant tous les détails importants que l\'imam souhaite partager avec la communauté.</p>
                            
                            <p class="leading-8">La description peut contenir plusieurs paragraphes expliquant en détail le sujet traité. Elle peut inclure des références coraniques, des hadiths, ou des enseignements islamiques pertinents.</p>
                            
                            <p class="leading-8">Cette approche permet aux lecteurs de se concentrer d\'abord sur le contenu textuel avant de voir l\'image illustrative, mettant ainsi l\'accent sur la valeur éducative de l\'article.</p>' 
                            !!}
                        </div>
                    </div>

                    <!-- Tags Section -->
                    @if(isset($article->tags) && $article->tags)
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Tags:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $article->tags) as $tag)
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ trim($tag) }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Article Image -->
                @if(isset($article->image) && $article->image)
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                    <div class="flex items-center mb-4">
                        <div class="bg-gradient-to-r from-green-600 to-emerald-700 text-white rounded-full p-2 mr-3">
                            <i class="fas fa-image"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Image Illustrative</h3>
                    </div>
                    <div class="relative overflow-hidden rounded-xl">
                        <img src="{{ asset('storage/articles/' . $article->image) }}" 
                             alt="{{ $article->name ?? 'Image de l\'article' }}" 
                             class="w-full h-auto max-h-96 object-cover transition-transform duration-300 hover:scale-105"
                             onerror="this.src='{{ asset('images/default-article.jpg') }}'; this.onerror=null;">
                        <div class="absolute inset-0 bg-gradient-to-t from-black from-0% to-transparent to-50% opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end">
                            <p class="text-white p-4 text-sm">{{ $article->name ?? 'Titre de l\'article' }}</p>
                        </div>
                    </div>
                </div>
                @else
                <!-- Placeholder Image -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                    <div class="flex items-center mb-4">
                        <div class="bg-gradient-to-r from-green-600 to-emerald-700 text-white rounded-full p-2 mr-3">
                            <i class="fas fa-image"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Image Illustrative</h3>
                    </div>
                    <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-blue-100 to-indigo-200 h-64 flex items-center justify-center">
                        <div class="text-center text-gray-600">
                            <i class="fas fa-image text-4xl mb-4 opacity-50"></i>
                            <p class="text-lg">Image de l'article</p>
                        </div>
                    </div>
                </div>
                @endif

                
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Imam Info Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                    <div class="text-center">
                        <div class="relative inline-block mb-4">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-800 to-indigo-900 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                                {{ isset($article->imam->name) ? strtoupper(substr($article->imam->name, 0, 1)) : 'I' }}
                            </div>
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $article->imam->firstname }} {{ $article->imam->lastname  }}</h3>
                        <p class="text-gray-600 mb-4">{{ $article->imam->title ?? 'Imam et Enseignant' }}</p>
                        <div class="flex justify-center space-x-3">
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>

                
                </div>

                
            </div>
        </div>

        <!-- Back to Articles Button -->
        <div class="text-center mt-12">
            <a href="{{ route('cours') }}" 
               class="btn-primary px-8 py-4 rounded-full font-medium text-lg transition-all duration-300 inline-flex items-center">
                <i class="fas fa-arrow-left mr-3"></i>
                Retour aux Articles
            </a>
        </div>
    </div>
</div>
@endsection