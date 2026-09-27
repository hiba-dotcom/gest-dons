@extends('./layout')
@section('listMosquees')
<style>
    .decorative-divider {
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
        margin: 1rem auto;
        border-radius: 2px;
    }

    .card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        border: 1px solid rgba(59, 130, 246, 0.1);
        flex: 0 0 320px;
        margin-right: 1.5rem;
        height: 420px;
        /* Hauteur fixe pour des cartes plus compactes */
        display: flex;
        flex-direction: column;
    }

    .card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.2);
        border-color: var(--secondary-color);
    }

    .card img {
        transition: transform 0.4s ease;
    }

    .card:hover img {
        transform: scale(1.08);
    }

    .mosque-icon-placeholder {
        background: linear-gradient(135deg, var(--accent-light), rgba(59, 130, 246, 0.15));
        transition: all 0.4s ease;
    }

    .card:hover .mosque-icon-placeholder {
        background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
    }

    .card:hover .mosque-icon-placeholder i {
        color: white !important;
        transform: scale(1.2);
    }

    .card-content {
        padding: 1.25rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        padding: 0.4rem 0.6rem;
        border-radius: 6px;
        transition: background-color 0.2s ease;
    }

    .info-item:hover {
        background-color: rgba(59, 130, 246, 0.05);
    }

    .info-icon {
        color: var(--secondary-color);
        margin-right: 0.6rem;
        font-size: 0.9rem;
        min-width: 1rem;
        transition: all 0.2s ease;
    }

    .info-item:hover .info-icon {
        color: var(--primary-color);
        transform: scale(1.1);
    }

    .mosque-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
        transition: color 0.2s ease;
        line-height: 1.3;
    }

    .card:hover .mosque-title {
        color: var(--secondary-color);
    }

    .info-label {
        font-weight: 600;
        color: var(--text-color);
        margin-right: 0.4rem;
        font-size: 0.85rem;
    }

    .info-value {
        color: #64748B;
        flex: 1;
        font-size: 0.85rem;
        line-height: 1.3;
    }

    .postulation-section {
        margin-top: auto;
        text-align: center;
        padding-top: 0.75rem;
        border-top: 1px solid #f1f5f9;
    }

    .postulation-section p {
        color: #64748B;
        font-size: 0.8rem;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .btn-postuler {
        font-size: 0.85rem;
        padding: 0.5rem 1.25rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .section-header {
        position: relative;
        padding-bottom: 1rem;
    }

    .section-title {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(30, 58, 138, 0.1);
    }

    .section-subtitle {
        color: #64748B;
        font-size: 1.1rem;
        line-height: 1.6;
        max-width: 600px;
        margin: 0 auto;
    }

    .no-mosquees {
        padding: 4rem 2rem;
        text-align: center;
        background: white;
        border-radius: 12px;
        border: 2px dashed #E2E8F0;
        margin: 2rem auto;
        max-width: 500px;
    }

    .no-mosquees i {
        font-size: 4rem;
        color: #CBD5E1;
        margin-bottom: 1rem;
    }

    .no-mosquees p {
        color: #64748B;
        font-size: 1.1rem;
    }

    /* Header Section Styles avec background mosquées */
    .header-section {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #1e40af 100%);
        position: relative;
        overflow: hidden;
        padding: 3rem 0;
        color: white;
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

    .header-section::after {
        content: '';
        position: absolute;
        top: 50%;
        right: 10%;
        transform: translateY(-50%);
        width: 300px;
        height: 300px;
        background: url("data:image/svg+xml,%3Csvg viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Cpath d='M60 10 L80 30 L75 45 L60 30 L45 45 L40 30 Z'/%3E%3Ccircle cx='60' cy='40' r='12'/%3E%3Crect x='54' y='52' width='12' height='35'/%3E%3Crect x='15' y='80' width='90' height='12' rx='6'/%3E%3Crect x='20' y='92' width='80' height='25' rx='12'/%3E%3C/g%3E%3C/svg%3E") center/contain no-repeat;
        pointer-events: none;
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

    /* Carousel Styles */
    .mosque-carousel {
        position: relative;
        margin-top: 3rem;
        overflow: hidden;
    }

    .carousel-container {
        display: flex;
        transition: transform 0.5s ease-in-out;
        gap: 1.5rem;
        padding: 0 1rem;
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

    /* Imam Section Styles avec background mosquées */
    .imam-section {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #1e40af 100%);
        position: relative;
        overflow: hidden;
        color: white;
    }

    .imam-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='140' height='140' viewBox='0 0 140 140' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M70 20 L85 40 L80 50 L70 40 L60 50 L55 40 Z'/%3E%3Ccircle cx='70' cy='55' r='10'/%3E%3Crect x='65' y='65' width='10' height='30'/%3E%3Crect x='30' y='90' width='80' height='10' rx='5'/%3E%3Crect x='35' y='100' width='70' height='25' rx='10'/%3E%3C/g%3E%3C/svg%3E");
        background-size: 200px 200px;
        background-repeat: repeat;
        animation: float 20s infinite linear reverse;
    }

    .imam-section::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 15%;
        transform: translateY(-50%);
        width: 250px;
        height: 250px;
        background: url("data:image/svg+xml,%3Csvg viewBox='0 0 140 140' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.015'%3E%3Cpath d='M70 15 L90 35 L85 50 L70 35 L55 50 L50 35 Z'/%3E%3Ccircle cx='70' cy='50' r='15'/%3E%3Crect x='62' y='65' width='16' height='40'/%3E%3Crect x='25' y='95' width='90' height='15' rx='7'/%3E%3Crect x='30' y='110' width='80' height='25' rx='12'/%3E%3C/g%3E%3C/svg%3E") center/contain no-repeat;
        pointer-events: none;
    }

    .imam-section .container {
        position: relative;
        z-index: 2;
    }

    .imam-section h2 {
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .imam-section p {
        color: rgba(255, 255, 255, 0.9);
    }

    .imam-section .btn-imam {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.2);
        color: white;
        font-weight: 600;
        padding: 12px 32px;
        border-radius: 50px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .imam-section .btn-imam:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.4);
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .section-background {
        background: linear-gradient(135deg, #F8FAFC 0%, #E2E8F0 100%);
        position: relative;
    }

    .section-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
    }

    @media (max-width: 768px) {
        .carousel-container {
            gap: 1rem;
        }

        .card {
            flex: 0 0 280px;
            margin-right: 1rem;
            height: 400px;
        }

        .section-title {
            font-size: 2rem;
        }

        .header-section {
            padding: 2rem 0;
        }

        .header-section h1 {
            font-size: 2.5rem;
        }

        .header-section p {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .card {
            flex: 0 0 250px;
            height: 380px;
        }

        .carousel-btn {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .card-content {
            padding: 1rem;
        }

        .mosque-title {
            font-size: 1rem;
        }
    }

    /* Style pour le conteneur du bouton "Mes postulations" */
    .postulations-container {
        text-align: center;
        padding: 2rem 0;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(147, 197, 253, 0.1));
        border-bottom: 1px solid rgba(59, 130, 246, 0.1);
    }

    .postulations-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 12px 28px;
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        position: relative;
        overflow: hidden;
        border: 2px solid transparent;
    }

    .postulations-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .postulations-btn:hover::before {
        left: 100%;
    }

    .postulations-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .postulations-btn:active {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.35);
    }

    .postulations-btn i {
        font-size: 1.1rem;
        transition: transform 0.3s ease;
    }

    .postulations-btn:hover i {
        transform: rotate(5deg) scale(1.1);
    }

    /* Version alternative avec icône de notification */
    .postulations-btn-alt {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 14px 32px;
        background: white;
        color: #1e40af;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(59, 130, 246, 0.15);
        border: 2px solid #3b82f6;
    }

    .postulations-btn-alt:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(59, 130, 246, 0.3);
    }

    .postulations-btn-alt i {
        transition: all 0.3s ease;
    }

    .postulations-btn-alt:hover i {
        transform: scale(1.2);
        color: white;
    }

    /* Badge de notification (optionnel) */
    .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: bold;
        border: 2px solid white;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    /* Style pour mobile */
    @media (max-width: 768px) {
        .postulations-container {
            padding: 1.5rem 1rem;
        }

        .postulations-btn,
        .postulations-btn-alt {
            padding: 12px 24px;
            font-size: 0.9rem;
        }
    }
</style>
<!-- Header Section -->
<section class="header-section">
    <div class="container mx-auto px-4 text-center">
        <div class="mb-8">
            <i class="fas fa-mosque text-6xl mb-4 text-white opacity-90"></i>
            <h1 class="text-5xl font-bold mb-4">Nos Mosquées</h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto">
                Vous souhaitez vous investir d'avantage ? Postulez pour devenir Chef de Mosquée et participez activement à la vie spirituelle et sociale.
            </p>
        </div>
    </div>
</section>
<div class="postulations-container">
    <div class="container mx-auto px-4">
        <a href="mes-postulations" class="postulations-btn-alt">
            <i class="fas fa-clipboard-list"></i>
            <span>Mes postulations</span>
        </a>
    </div>
</div>

<section id="mosquees" class="section-background py-16">
    <div class="container mx-auto px-4">
        @if(!$mosquees->isEmpty())
        <div class="mosque-carousel">
            <div class="carousel-container" id="mosqueCarousel">
                @foreach($mosquees as $mosquee)
                <div class="card">
                    <!-- Image de la mosquée -->
                    @if($mosquee->image)
                    <div class="overflow-hidden" style="height: 160px;">
                        <img src="{{ asset($mosquee->image) }}" alt="{{ $mosquee->name }}" class="w-full h-full object-cover">
                    </div>
                    @else
                    <div class="mosque-icon-placeholder w-full flex items-center justify-center" style="height: 160px;">
                        <i class="fas fa-mosque text-3xl text-blue-600"></i>
                    </div>
                    @endif

                    <div class="card-content">
                        <div>
                            <h3 class="mosque-title">{{ $mosquee->name }}</h3>

                            <div class="mb-3">
                                <!-- Chef de mosquée -->
                                <div class="info-item">
                                    <i class="fas fa-user-tie info-icon"></i>
                                    <div class="flex-1">
                                        <span class="info-label">Chef:</span>
                                        <span class="info-value">{{ $mosquee->chef ? $mosquee->chef->firstname . ' ' . $mosquee->chef->lastname : 'Non attribué' }}</span>
                                    </div>
                                </div>

                                <!-- Adresse -->
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt info-icon"></i>
                                    <div class="flex-1">
                                        <span class="info-label">Lieu:</span>
                                        <span class="info-value">
                                            @if($mosquee->adresse)
                                            {{ $mosquee->adresse->ville }}, {{ $mosquee->adresse->pays }}
                                            @else
                                            Non renseigné
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Proposition pour devenir chef -->
                        <div class="postulation-section">
                            <p>
                                voulez-vous devenir chef de cette mosquée ? 
                                postuler ici
                            </p>

                            @php
                            $dejaChef = !is_null($mosquee->chef_id);
                            @endphp

                            <a href="{{ route('postulation_chef.create', ['mosquee_id' => $mosquee->id]) }}" class="btn-postuler {{ $dejaChef ? 'bg-gray-400 text-white cursor-not-allowed pointer-events-none' : 'bg-blue-600 hover:bg-blue-700 text-white hover:shadow-lg' }}">
                                {{ $dejaChef ? 'Déjà attribué' : 'Postuler' }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="carousel-controls">
                <button class="carousel-btn" id="prevBtn" onclick="previousSlide()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="carousel-indicators" id="indicators"></div>
                <button class="carousel-btn" id="nextBtn" onclick="nextSlide()">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
        @else
        <div class="no-mosquees">
            <i class="fas fa-mosque"></i>
            <p>Aucune mosquée disponible pour le moment.</p>
        </div>
        @endif
    </div>
</section>


<script>
  let currentSlide = 0;
    let cardsPerView = window.innerWidth >= 1200 ? 3 : window.innerWidth >= 768 ? 2 : 1;
    const totalCards = {{ $mosquees->count() }}; // Correction de la syntaxe Blade
    let maxSlide = Math.max(0, totalCards - cardsPerView);

    function initializeCarousel() {
        const indicators = document.getElementById('indicators');
        
        // Clear existing indicators
        indicators.innerHTML = '';
        
        // Create indicators only if we have slides to navigate
        if (maxSlide > 0) {
            for (let i = 0; i <= maxSlide; i++) {
                const dot = document.createElement('div');
                dot.className = `carousel-dot ${i === 0 ? 'active' : ''}`;
                dot.onclick = () => goToSlide(i);
                indicators.appendChild(dot);
            }
        }

        updateCarousel();
    }

    function updateCarousel() {
        const carousel = document.getElementById('mosqueCarousel');
        if (!carousel || !carousel.children.length) return;
        
        const firstCard = carousel.children[0];
        const cardStyle = getComputedStyle(firstCard);
        const cardWidth = firstCard.offsetWidth;
        const cardMargin = parseFloat(cardStyle.marginRight) || 24; // fallback to 24px
        
        const slideWidth = cardWidth + cardMargin;
        carousel.style.transform = `translateX(-${currentSlide * slideWidth}px)`;

        // Update indicators
        const dots = document.querySelectorAll('.carousel-dot');
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });

        // Update button states
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        if (prevBtn) prevBtn.disabled = currentSlide === 0;
        if (nextBtn) nextBtn.disabled = currentSlide >= maxSlide;
    }

    function nextSlide() {
        if (currentSlide < maxSlide) {
            currentSlide++;
            updateCarousel();
        }
    }

    function previousSlide() {
        if (currentSlide > 0) {
            currentSlide--;
            updateCarousel();
        }
    }

    function goToSlide(slideIndex) {
        if (slideIndex >= 0 && slideIndex <= maxSlide) {
            currentSlide = slideIndex;
            updateCarousel();
        }
    }

    function updateCardsPerView() {
        const newCardsPerView = window.innerWidth >= 1200 ? 3 : window.innerWidth >= 768 ? 2 : 1;
        const newMaxSlide = Math.max(0, totalCards - newCardsPerView);
        
        cardsPerView = newCardsPerView;
        maxSlide = newMaxSlide;
        
        // Adjust current slide if necessary
        if (currentSlide > maxSlide) {
            currentSlide = maxSlide;
        }
        
        // Reinitialize indicators
        initializeCarousel();
    }

    // Initialize carousel when page loads
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Total cards:', totalCards); // Debug log
        if (totalCards > 0) {
            initializeCarousel();
        }
    });

    // Handle window resize with debounce
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            updateCardsPerView();
        }, 250);
    });

    // Debug function (can be removed in production)
    function debugCarousel() {
        console.log({
            currentSlide,
            maxSlide,
            cardsPerView,
            totalCards,
            windowWidth: window.innerWidth
        });
    }

    // Handle window resize
    window.addEventListener('resize', function() {
        const newCardsPerView = window.innerWidth >= 1200 ? 3 : window.innerWidth >= 768 ? 2 : 1;
        const newMaxSlide = Math.max(0, totalCards - newCardsPerView);

        if (currentSlide > newMaxSlide) {
            currentSlide = newMaxSlide;
        }

        updateCarousel();
    });
</script>

@endsection