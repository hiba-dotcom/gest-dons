@extends('./layout')

@section('coran')
<!-- Header Section -->
<section class="header-section py-20">
    <div class="container mx-auto px-4 text-center">
        <div class="mb-8">
            <i class="fas fa-book-open text-6xl mb-4 text-white opacity-90"></i>
            <h1 class="text-5xl font-bold mb-4">{{ __('messages.quran_page_title') }}</h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto">
                {{ __('messages.quran_page_subtitle') }}

            </p>
        </div>
    </div>
</section>

<div class="container mx-auto mt-12 px-4 pb-16">
    <!-- Formulaire de recherche -->
    <div class="max-w-4xl mx-auto mb-12">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">
                <i class="fas fa-search mr-2 text-blue-600"></i>
                {{ __('messages.rechercher') }}
            </h2>
            <form action="{{ route('quran.search') }}" method="GET" class="relative">
                <div class="flex rounded-full overflow-hidden shadow-lg">
                    <input type="text" id="search-input" name="query" class="flex-grow border-0 px-6 py-4 text-lg focus:outline-none focus:ring-0 bg-gray-50" placeholder="{{ __('messages.rechercherSourate') }}" value="{{ $queryText ?? '' }}" autocomplete="off" />
                    <button class="btn-primary px-8 py-4 text-lg font-semibold border-0 rounded-none">
                        <i class="fas fa-search mr-2"></i>
                        {{ __('messages.btnRechercher') }}

                    </button>
                </div>
                <ul id="suggestions" class="absolute z-50 w-full bg-white border border-gray-200 rounded-xl max-h-52 overflow-y-auto mt-2 shadow-xl"></ul>
            </form>
        </div>
    </div>


    <!-- Bouton retour -->
    @if((isset($sourate) && !empty($sourate)) || (isset($queryText) && !empty($queryText)))
    <a href="{{ url('/coran') }}" class="inline-block mb-6 text-blue-600 hover:underline">&larr; {{ __('messages.retour_liste_sourates') }}</a>

    @endif

    <!-- Liste des sourates -->
    @if(isset($sourates) && count($sourates) > 0 && !isset($sourate))
    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">
            <i class="fas fa-list-ul mr-2 text-blue-600"></i>
            {{ __('messages.les_114_sourates') }}

        </h2>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach($sourates as $s)
            <a href="{{ url('/sourate/'.$s['number']) }}" class="group bg-white border border-gray-200 rounded-xl p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold mr-3">
                            {{ $s['number'] }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                                {{ $s['englishName'] }} ({{ $s['name'] }})
                            </h3>
                            <p class="text-sm text-gray-500">{{ ucfirst($s['revelationType']) }}</p>
                        </div>
                    </div>
                    <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $s['numberOfAyahs'] }} {{ __('messages.versets') }}

                    </span>
                </div>
                <!-- <div class="text-right">
                    <p class="text-lg text-gray-700" style="font-family: 'Scheherazade', serif;">
                        {{ $s['englishNameTranslation'] }}
                    </p>
                </div> -->
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Affichage d'une sourate -->
    @if(isset($sourate) && !empty($sourate))
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 text-white rounded-full text-2xl font-bold mb-4">
                    {{ $sourate['number'] }}
                </div>
                <h2 class="text-4xl font-bold mb-2 text-gray-800">
                    {{ $sourate['englishName'] }} ({{ $sourate['name'] }})
                </h2>
                <!-- <h3 class="text-3xl mb-4 text-gray-600" style="font-family: 'Scheherazade', serif;">
                    {{ $sourate['englishNameTranslation'] }}
                </h3> -->
                <div class="flex justify-center items-center space-x-6 text-gray-600">
                    <span class="flex items-center">
                        <i class="fas fa-list-ol mr-2"></i>
                        {{ $sourate['numberOfAyahs'] }} versets
                    </span>
                </div>
            </div>

            <!-- Sélecteur langue traduction -->
            <div class="flex justify-end mb-6">
                <label for="translation-lang" class="mr-2 font-semibold text-gray-700">Traduction :</label>
                <select id="translation-lang" class="border border-gray-300 rounded px-3 py-1">
                    <option value="fr" selected>Français</option>
                    <option value="en">Anglais</option>
                </select>
            </div>

            <div class="space-y-8" id="versets-container">
                @foreach($versets as $v)
                <div class="bg-white p-6 rounded-lg shadow-md mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="inline-block bg-blue-600 text-white px-3 py-1 rounded-full text-sm">{{ $v['numberInSurah'] }}</span>
                        <!-- Bouton audio -->
                        @if(!empty($v['audio']))
                        <button class="play-audio-btn text-blue-600 hover:text-blue-800" data-audio="{{ $v['audio'] }}" aria-label="{{ __('messages.lire_verset') }} {{ $v['numberInSurah'] }}">
                            <i class="fas fa-play"></i> {{ __('messages.ecouter') }}

                        </button>
                        @endif
                    </div>
                    <p class="text-lg text-right font-semibold mb-2" dir="rtl">{{ $v['text_arabic'] }}</p>
                    <p class="text-gray-700 translation-text" data-lang-fr="{{ $v['text_french'] }}" data-lang-en="{{ $v['text_english'] }}">
                        {{ $v['text_french'] }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Audio player invisible (joué via JS) -->
    <audio id="audio-player" class="hidden"></audio>

       @endif

   <!-- Résultats de recherche -->
   @if(isset($results) && count($results) > 0)
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <h2 class="text-3xl font-bold text-center text-gray-800">
                <i class="fas fa-search mr-2 text-blue-600"></i>
                {{ __('messages.resultats_recherche') }}
            </h2>
            <p class="text-center text-gray-600 mt-2">
                {{ __('messages.recherche_pour') }} <span class="font-semibold text-blue-600">"{{ $queryText }}"</span>

            </p>
        </div>

        <div class="space-y-6">
            @foreach($results as $verset)
            <div class="bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-4">
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $verset['verse_key'] }}
                    </span>
                </div>
                <div class="text-right mb-4">
                    <p class="text-2xl leading-relaxed text-gray-800" dir="rtl" style="font-family: 'Scheherazade', serif; line-height: 2.2;">
                        {{ $verset['text_uthmani'] }}
                    </p>
                </div>
                <div class="border-t pt-4">
                    <p class="text-lg text-gray-700 leading-relaxed">
                        {{ $verset['translation'] }}
                    </p>
                    @if(isset($verset['audio_url']))
                    <audio controls class="mt-3 w-full">
                        <source src="{{ $verset['audio_url'] }}" type="audio/mpeg">
                    </audio>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Scheherazade:wght@400;700&display=swap');

    .suggestions-item {
        transition: all 0.2s ease;
    }

    .suggestions-item:hover {
        background-color: var(--accent-light);
        transform: translateX(4px);
    }

    /* Animation pour les cartes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .bg-white {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('search-input');
        const suggestions = document.getElementById('suggestions');

        function fetchSuggestions(query) {
            fetch('/sourates/search?q=' + encodeURIComponent(query))
                .then(res => res.json())
                .then(data => {
                    suggestions.innerHTML = '';

                    if (data.length === 0) {
                        const li = document.createElement('li');
                        li.innerHTML = '<i class="fas fa-info-circle mr-2 text-gray-400"></i>Aucune suggestion';
                        li.classList.add('px-6', 'py-3', 'text-gray-500');
                        suggestions.appendChild(li);
                        return;
                    }

                    data.forEach(sourate => {
                        const li = document.createElement('li');
                        li.innerHTML = `
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold mr-3">
                ${sourate.number}
            </div>
            <div>
                <span class="font-medium">${sourate.englishName}</span>
                <span class="text-gray-500 ml-2">(${sourate.name})</span>
            </div>
        </div>
        <i class="fas fa-arrow-right text-gray-400"></i>
    </div>
`;

                        li.classList.add('px-6', 'py-3', 'cursor-pointer', 'hover:bg-blue-50', 'suggestions-item', 'border-b', 'border-gray-100', 'last:border-b-0');
                        li.onclick = () => window.location.href = '/sourate/' + sourate.number;
                        suggestions.appendChild(li);
                    });
                })
                .catch(() => {
                    suggestions.innerHTML = '';
                });
        }

        input.addEventListener('input', function() {
            const query = this.value.trim();
            if (query.length > 0) {
                fetchSuggestions(query);
            } else {
                suggestions.innerHTML = '';
            }
        });

        input.addEventListener('focus', function() {
            if (this.value.trim().length === 0) {
                fetchSuggestions('');
            }
        });

        document.addEventListener('click', function(e) {
            if (!input.contains(e.target) && !suggestions.contains(e.target)) {
                suggestions.innerHTML = '';
            }
        });

        // Smooth scroll to top when navigating
        window.addEventListener('beforeunload', function() {
            window.scrollTo(0, 0);
        });
    });

    // Pause other audios when one plays
    document.addEventListener('play', function(e) {
        let audios = document.getElementsByTagName('audio');
        for (let i = 0; i < audios.length; i++) {
            if (audios[i] != e.target) {
                audios[i].pause();
            }
        }
    }, true);
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion du changement de langue
        const selectLang = document.getElementById('translation-lang');
        const translations = document.querySelectorAll('.translation-text');

        selectLang.addEventListener('change', function() {
            const lang = this.value;
            translations.forEach(el => {
                el.textContent = el.getAttribute(`data-lang-${lang}`) || '';
            });
        });

        // Gestion du player audio
        const audioPlayer = document.getElementById('audio-player');
        const buttons = document.querySelectorAll('.play-audio-btn');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const audioSrc = btn.getAttribute('data-audio');
                if (audioPlayer.src !== audioSrc) {
                    audioPlayer.src = audioSrc;
                }
                audioPlayer.play();
            });
        });

        // Pause les autres audios si besoin (au cas où tu as d'autres players)
        audioPlayer.addEventListener('play', () => {
            document.querySelectorAll('audio').forEach(audio => {
                if (audio !== audioPlayer) audio.pause();
            });
        });
    });
    </script>
 
@endsection