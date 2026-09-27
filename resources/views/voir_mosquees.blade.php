@extends('./layout')
@section('voir_mosquees')

<style>
    :root {
        --primary-color: #060854;
            --secondary-color: #50D894;
            --accent-color: #50D894;
            --accent-light: #6FDFA7;
            --text-color: #060854;
        --border-color: #060854;
    }

    .decorative-divider {
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
        margin: 1rem auto;
        border-radius: 2px;
    }

    /* Header Section */
    .header-section {
        text-align: center;
        background: linear-gradient(135deg, var(--primary-color), #0f0f6b);
        position: relative;
        overflow: hidden;
        padding: 4rem 0;
        color: white;
        margin-bottom: 3rem;
    }

    .header-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M60 15 L75 35 L70 45 L60 35 L50 45 L45 35 Z'/%3E%3Ccircle cx='60' cy='50' r='8'/%3E%3Crect x='56' y='58' width='8' height='25'/%3E%3Crect x='20' y='75' width='80' height='8' rx='4'/%3E%3Crect x='25' y='83' width='70' height='20' rx='8'/%3E%3C/g%3E%3C/svg%3E");
        background-size: 180px 180px;
        background-repeat: repeat;
        animation: float 25s infinite linear;
    }

    @keyframes float {
        0% {
            transform: translateX(0px) translateY(0px);
        }

        25% {
            transform: translateX(-10px) translateY(-15px);
        }

        50% {
            transform: translateX(0px) translateY(-25px);
        }

        75% {
            transform: translateX(10px) translateY(-15px);
        }

        100% {
            transform: translateX(0px) translateY(0px);
        }
    }

    .header-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .section-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .section-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Carousel Styles */
    .mosque-carousel {
        position: relative;
        margin: 3rem 0;
        overflow: hidden;
    }

    .carousel-wrapper {
        overflow: hidden;
        width: 100%;
    }

    .carousel-container {
        align-items: center;
        display: flex;
        transition: transform 0.5s ease-in-out;
        gap: 1.5rem;
    }

    .carousel-controls {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        margin-top: 2rem;
    }

    .carousel-btn {
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        color: white;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .carousel-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
    }

    .carousel-btn:disabled {
        background: #e5e7eb;
        color: #9ca3af;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .carousel-indicators {
        display: flex;
        gap: 0.5rem;
        margin: 0 1rem;
    }

    .carousel-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #e5e7eb;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .carousel-dot.active {
        background: #3b82f6;
        transform: scale(1.2);
    }

    .mosquee-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        border: 1px solid rgba(59, 130, 246, 0.1);
        flex: 0 0 350px;
        height: 480px;
        display: flex;
        flex-direction: column;
    }

    .mosquee-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.15);
        border-color: var(--secondary-color);
    }

    .mosquee-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .mosquee-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .mosquee-card:hover .mosquee-image img {
        transform: scale(1.05);
    }

    .mosque-icon-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 200px;
        background: linear-gradient(135deg, var(--accent-light), rgba(59, 130, 246, 0.15));
        transition: all 0.4s ease;
    }

    .mosque-icon-placeholder i {
        font-size: 4rem;
        color: var(--secondary-color);
        transition: all 0.4s ease;
    }

    .mosquee-card:hover .mosque-icon-placeholder {
        background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
    }

    .mosquee-card:hover .mosque-icon-placeholder i {
        color: white;
        transform: scale(1.2);
    }

    .mosquee-content {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .mosquee-title {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 1rem;
        transition: color 0.2s ease;
        line-height: 1.3;
    }

    .mosquee-card:hover .mosquee-title {
        color: var(--secondary-color);
    }

    .mosquee-address {
        color: #64748B;
        font-size: 0.95rem;
        line-height: 1.5;
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .address-icon {
        color: var(--secondary-color);
        margin-top: 0.2rem;
        font-size: 0.9rem;
    }

    .mosquee-details {
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid #f1f5f9;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        color: #64748B;
    }

    .detail-icon {
        color: var(--secondary-color);
        width: 16px;
    }

    /* Section Actions */
    .actions-section {
        background-color: #D1FAE5;
        padding: 3rem 0;
        margin-top: 3rem;
        position: relative;
    }

    .actions-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
    }

    .actions-container {
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .actions-section h3 {
        color: var(--primary-color);
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .actions-section p {
        color: #64748B;
        font-size: 1.1rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 14px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        min-width: 160px;
        justify-content: center;
    }

    .btn-chef {
        background:#060854 ;
        color: white;
    }

    .btn-chef:hover {
        background: #10B981;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-imam {
        background: #10B981;
        color: white;
    }

    .btn-imam:hover {
        background: #060854;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        color: white;
        text-decoration: none;
    }

    /* Message vide */
    .no-mosquees {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
        border: 2px dashed #e2e8f0;
        max-width: 500px;
        margin: 0 auto;
    }

    .no-mosquees i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 1.5rem;
    }

    .no-mosquees h3 {
        color: var(--primary-color);
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .no-mosquees p {
        color: #64748B;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .mosquee-card {
            flex: 0 0 320px;
        }
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 2.5rem;
        }

        .header-section {
            padding: 3rem 0;
        }

        .carousel-container {
            gap: 1rem;
        }

        .mosquee-card {
            flex: 0 0 280px;
            height: 450px;
        }

        .action-buttons {
            flex-direction: column;
            align-items: center;
        }

        .action-btn {
            width: 100%;
            max-width: 280px;
        }

        .carousel-btn {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .section-title {
            font-size: 2rem;
        }

        .section-subtitle {
            font-size: 1rem;
        }

        .mosquee-card {
            flex: 0 0 250px;
            height: 420px;
        }

        .mosquee-content {
            padding: 1.25rem;
        }

        .actions-section h3 {
            font-size: 1.5rem;
        }
    }
</style>

<!-- Header Section -->
<div class="header-section">
    <div class="container">
        <div class="header-content">
            <i class="fas fa-mosque text-6xl mb-4 text-green-300 opacity-90"></i>
            <h1 class="text-5xl font-bold mb-4">Nos Mosquées</h1>
            <p class="section-subtitle">Découvrez les mosquées de votre région et explorez leurs détails</p><br>
            <div class="decorative-divider"></div>
        </div>
    </div>
</div>

<!-- Contenu Principal -->
<div class="container">
    @if($mosquees->count() > 0)
    <div class="mosque-carousel">
        <div class="carousel-wrapper">
            <div class="carousel-container" id="mosqueCarousel">
                @foreach ($mosquees as $mosquee)
                <div class="mosquee-card">
                    <!-- Image ou placeholder -->
                    @if($mosquee->image)
                    <div class="mosquee-image">
                        <img src="{{ asset($mosquee->image) }}" alt="{{ $mosquee->name }}">
                    </div>
                    @else
                    <div class="mosque-icon-placeholder">
                        <i class="fas fa-mosque"></i>
                    </div>
                    @endif

                    <!-- Contenu de la carte -->
                    <div class="mosquee-content">
                        <h3 class="mosquee-title">{{ $mosquee->name }}</h3>

                        <div class="mosquee-address">
                            <i class="fas fa-map-marker-alt address-icon"></i>
                            <span>
                                @if($mosquee->adresse)
                                {{ $mosquee->adresse->boulevard }}<br>
                                {{ $mosquee->adresse->ville }}, {{ $mosquee->adresse->pays }}
                                @else
                                Adresse non spécifiée
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="carousel-controls">
            <button class="carousel-btn" id="prevBtn">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="carousel-indicators" id="indicators"></div>
            <button class="carousel-btn" id="nextBtn">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
    @else
    <div class="no-mosquees">
        <i class="fas fa-mosque"></i>
        <h3>Aucune mosquée disponible</h3>
        <p>Il n'y a actuellement aucune mosquée enregistrée dans le système. Revenez plus tard pour découvrir les mosquées de votre région.</p>
    </div>
    @endif
</div>

<!-- Section Actions -->
<div class="actions-section">
    <div class="actions-container">
        <h3>Rejoignez une mosquée</h3>
        <p>Postulez pour devenir chef ou imam dans l'une de nos mosquées et contribuez à votre communauté</p>

        <div class="action-buttons">
            <a href="{{ route('mosquees') }}" class="action-btn btn-chef">
                <i class="fas fa-user-tie"></i>
                Postuler Chef de mosquée
            </a>
            <a href="{{ route('postulation-imam.form') }}" class="action-btn btn-imam">
                <i class="fas fa-user-graduate"></i>
                Postuler Imam
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables du carousel
        let currentSlide = 0;
        const totalCards = {{ $mosquees->count() }}; // CORRECTION ICI - Syntaxe Blade correcte

        // Calculer le nombre de cartes visibles selon la taille d'écran
        function getCardsPerView() {
            if (window.innerWidth >= 1200) return 3;
            if (window.innerWidth >= 768) return 2;
            return 1;
        }

        let cardsPerView = getCardsPerView();
        let maxSlide = Math.max(0, totalCards - cardsPerView);

        // Éléments du DOM
        const carousel = document.getElementById('mosqueCarousel');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const indicators = document.getElementById('indicators');

        // Vérifier si les éléments existent
        if (!carousel || totalCards === 0) {
            return;
        }

        // Initialiser le carousel
        function initializeCarousel() {
            // Créer les indicateurs
            indicators.innerHTML = '';

            // Ne créer des indicateurs que s'il y a des slides à naviguer
            if (maxSlide > 0) {
                for (let i = 0; i <= maxSlide; i++) {
                    const dot = document.createElement('div');
                    dot.className = `carousel-dot ${i === 0 ? 'active' : ''}`;
                    dot.addEventListener('click', () => goToSlide(i));
                    indicators.appendChild(dot);
                }
            } else {
                // Si pas besoin de navigation, masquer les contrôles
                document.querySelector('.carousel-controls').style.display = 'none';
                return;
            }

            // Ajouter les event listeners aux boutons
            prevBtn.addEventListener('click', previousSlide);
            nextBtn.addEventListener('click', nextSlide);

            updateCarousel();
        }

        // Mettre à jour la position du carousel
        function updateCarousel() {
            if (!carousel || !carousel.children.length) return;

            // Calculer la largeur de déplacement
            const cardWidth = carousel.children[0].offsetWidth || 350;
            const gap = 24; // Gap entre les cartes (1.5rem)
            const slideWidth = cardWidth + gap;

            // Appliquer la transformation
            carousel.style.transform = `translateX(-${currentSlide * slideWidth}px)`;

            // Mettre à jour les indicateurs
            const dots = document.querySelectorAll('.carousel-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });

            // Mettre à jour l'état des boutons
            if (prevBtn) prevBtn.disabled = currentSlide === 0;
            if (nextBtn) nextBtn.disabled = currentSlide >= maxSlide;
        }

        // Slide suivant
        function nextSlide() {
            if (currentSlide < maxSlide) {
                currentSlide++;
                updateCarousel();
            }
        }

        // Slide précédent  
        function previousSlide() {
            if (currentSlide > 0) {
                currentSlide--;
                updateCarousel();
            }
        }

        // Aller à un slide spécifique
        function goToSlide(slideIndex) {
            if (slideIndex >= 0 && slideIndex <= maxSlide) {
                currentSlide = slideIndex;
                updateCarousel();
            }
        }

        // Gérer le redimensionnement de la fenêtre
        function handleResize() {
            const newCardsPerView = getCardsPerView();
            const newMaxSlide = Math.max(0, totalCards - newCardsPerView);

            cardsPerView = newCardsPerView;
            maxSlide = newMaxSlide;

            // Ajuster le slide actuel si nécessaire
            if (currentSlide > maxSlide) {
                currentSlide = maxSlide;
            }

            // Réinitialiser le carousel
            initializeCarousel();
        }

        // Event listener pour le redimensionnement avec debounce
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(handleResize, 250);
        });

        // Navigation au clavier
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                previousSlide();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
            }
        });

        // Initialiser le carousel
        initializeCarousel();

        // Support tactile pour mobile
        let startX = 0;
        let isDragging = false;

        carousel.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            isDragging = true;
        });

        carousel.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            e.preventDefault();
        });

        carousel.addEventListener('touchend', function(e) {
            if (!isDragging) return;

            const endX = e.changedTouches[0].clientX;
            const diffX = startX - endX;

            if (Math.abs(diffX) > 50) { // Minimum swipe distance
                if (diffX > 0) {
                    nextSlide();
                } else {
                    previousSlide();
                }
            }

            isDragging = false;
        });
    });
</script>

@endsection