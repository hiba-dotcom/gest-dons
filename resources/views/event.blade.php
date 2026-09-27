@extends('./layout')
@section('event')

<style>
    .decorative-divider {
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
        margin: 1rem auto;
        border-radius: 2px;
    }

    .event-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        border: 1px solid rgba(59, 130, 246, 0.1);
        flex: 0 0 320px;
        margin-right: 1.5rem;
        height: 460px;
        display: flex;
        flex-direction: column;
    }

    .event-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.2);
        border-color: var(--secondary-color);
    }

    .event-card img {
        transition: transform 0.4s ease;
    }

    .event-card:hover img {
        transform: scale(1.08);
    }

    .event-icon-placeholder {
        background: linear-gradient(135deg, var(--accent-light), rgba(59, 130, 246, 0.15));
        transition: all 0.4s ease;
    }

    .event-card:hover .event-icon-placeholder {
        background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
    }

    .event-card:hover .event-icon-placeholder i {
        color: white !important;
        transform: scale(1.2);
    }

    .event-card-content {
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

    .event-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
        transition: color 0.2s ease;
        line-height: 1.3;
    }

    .event-card:hover .event-title {
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

    .description-section {
        margin-top: auto;
        text-align: center;
        padding-top: 0.75rem;
        border-top: 1px solid #f1f5f9;
    }

    .description-section .description-display {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(147, 197, 253, 0.15));
        border-radius: 8px;
        padding: 0.75rem;
        margin: 0.5rem 0;
    }

    .description-display .description-label {
        color: #64748B;
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
    }

    .description-display .description-amount {
        color: #1e40af;
        font-weight: 700;
        font-size: 1.1rem;
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

    .no-events {
        padding: 4rem 2rem;
        text-align: center;
        background: white;
        border-radius: 12px;
        border: 2px dashed #E2E8F0;
        margin: 2rem auto;
        max-width: 500px;
    }

    .no-events i {
        font-size: 4rem;
        color: #CBD5E1;
        margin-bottom: 1rem;
    }

    .no-events p {
        color: #64748B;
        font-size: 1.1rem;
    }

    /* Header Section Styles avec background événements */
    .header-section {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #1e40af 100%);
        position: relative;
        overflow: hidden;
        padding: 3rem 0;
        color: white;
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
    .event-carousel {
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

        .event-card {
            flex: 0 0 280px;
            margin-right: 1rem;
            height: 440px;
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
        .event-card {
            flex: 0 0 250px;
            height: 420px;
        }

        .carousel-btn {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .event-card-content {
            padding: 1rem;
        }

        .event-title {
            font-size: 1rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="header-section">
    <div class="container mx-auto px-4 text-center">
        <div class="mb-8">
            <i class="fas fa-calendar-alt text-6xl mb-4 text-white opacity-90"></i>
            <h1 class="text-5xl font-bold mb-4">Liste des Événements</h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto">
                Découvrez tous nos événements communautaires.
            </p>
        </div>
    </div>
</section>

<!-- Events Carousel Section -->
<section id="events" class="section-background py-16">
    <div class="container mx-auto px-4">
        @if($evenements->count() > 0)
        <div class="event-carousel">
            <div class="carousel-container" id="eventCarousel">
                @foreach($evenements as $evenement)
                <div class="event-card">
                    <!-- Event Image -->
                    <div class="overflow-hidden" style="height: 160px;">
                        @if($evenement->image)
                        <img src="{{ asset('storage/' . $evenement->image) }}" alt="Image de l'événement {{ $evenement->nom }}" class="w-full h-full object-cover">
                        @else
                        <div class="event-icon-placeholder w-full flex items-center justify-center h-full">
                            <i class="fas fa-calendar-alt text-3xl text-blue-600"></i>
                        </div>
                        @endif
                    </div>

                    <div class="event-card-content">
                        <div>
                            <h3 class="event-title">{{ $evenement->nom }}</h3>

                            <div class="mb-3">
                                <!-- Date Info -->
                                <div class="info-item">
                                    <i class="fas fa-clock info-icon"></i>
                                    <div class="flex-1">
                                        <span class="info-label">Du:</span>
                                        <span class="info-value">{{ \Carbon\Carbon::parse($evenement->dateDebut)->format('d/m/Y') }}</span>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <i class="fas fa-clock info-icon"></i>
                                    <div class="flex-1">
                                        <span class="info-label">Au:</span>
                                        <span class="info-value">{{ \Carbon\Carbon::parse($evenement->dateFin)->format('d/m/Y') }}</span>
                                    </div>
                                </div>

                                <!-- Location Info -->
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt info-icon"></i>
                                    <div class="flex-1">
                                        <span class="info-label">Lieu:</span>
                                        <span class="info-value">
                                            @if($evenement->adresse)
                                            {{ $evenement->adresse->boulevard }}, {{ $evenement->adresse->ville }}, {{ $evenement->adresse->pays }}
                                            @else
                                            Adresse non renseignée
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <!-- Déscription Info -->
                                <div class="info-item">
                                    <i class="fas fa-file-alt info-icon"></i>
                                    <div class="flex-1">
                                        <span class="info-label">Déscription:</span>
                                        <span class="info-value">
                                        {{ $evenement->description }}
                                        </span>
                                    </div>
                                </div>
                            </div>
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
        <div class="no-events">
            <i class="fas fa-calendar-times"></i>
            <p>Aucun événement disponible pour le moment.</p>
        </div>
        @endif
    </div>
</section>

<script>
let currentSlide = 0;
let cardsPerView = window.innerWidth >= 1200 ? 3 : window.innerWidth >= 768 ? 2 : 1;
const totalCards = {{ $evenements->count() }};
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
    const carousel = document.getElementById('eventCarousel');
    if (!carousel || !carousel.children.length) return;
    
    const firstCard = carousel.children[0];
    const cardStyle = getComputedStyle(firstCard);
    const cardWidth = firstCard.offsetWidth;
    const cardMargin = parseFloat(cardStyle.marginRight) || 24;
    
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
    console.log('Total events:', totalCards);
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
</script>

@endsection