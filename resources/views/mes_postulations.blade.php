@extends('./layout')

@section('post')
<style>
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

    /* Section Background */
    .section-background {
        background: linear-gradient(135deg, #F8FAFC 0%, #E2E8F0 100%);
        position: relative;
        min-height: 100vh;
        padding: 4rem 0;
    }

    .section-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #3b82f6, transparent);
    }

    /* Main Container */
    .postulations-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    /* Alert Styles */
    .alert {
        padding: 1.25rem 1.5rem;
        border-radius: 16px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .alert::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 4px;
    }

    .alert-success {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        color: #16a34a;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .alert-success::before {
        background: #22c55e;
    }

    .alert-success .alert-icon {
        background: #22c55e;
        color: white;
        padding: 0.5rem;
        border-radius: 50%;
        font-size: 1rem;
        min-width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .alert-error {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .alert-error::before {
        background: #ef4444;
    }

    .alert-error .alert-icon {
        background: #ef4444;
        color: white;
        padding: 0.5rem;
        border-radius: 50%;
        font-size: 1rem;
        min-width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Content Card */
    .content-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.1);
        border: 1px solid rgba(59, 130, 246, 0.1);
        overflow: hidden;
        position: relative;
    }

    .content-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #1e40af, #3b82f6);
        background-size: 200% 100%;
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    /* Card Header */
    .card-header {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(30, 64, 175, 0.05));
        padding: 2.5rem 2rem;
        text-align: center;
        border-bottom: 1px solid rgba(59, 130, 246, 0.1);
        position: relative;
    }

    .card-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, #3b82f6, #1e40af);
        border-radius: 2px;
    }

    .card-title {
        color: #1e40af;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 0 2px 4px rgba(30, 64, 175, 0.1);
    }

    .card-subtitle {
        color: #64748B;
        font-size: 1.1rem;
        line-height: 1.6;
        max-width: 600px;
        margin: 0 auto;
    }

    .mosque-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        color: #3b82f6;
        opacity: 0.8;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 0.8;
            transform: scale(1);
        }

        50% {
            opacity: 1;
            transform: scale(1.05);
        }
    }

    /* Card Content */
    .card-content {
        padding: 3rem 2rem;
    }

    /* Postulations Grid - Centré */
.postulations-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 2rem;
    margin-top: 2rem;
}

.postulation-card {
    background: white;
    border-radius: 16px;
    border: 2px solid #f1f5f9;
    padding: 2rem;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    width: 400px; /* Largeur fixe pour uniformité */
    max-width: 100%; /* Responsif sur petits écrans */
}

/* Alternative avec grid si vous préférez */
.postulations-grid-alternative {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
    justify-items: center; /* Centre les éléments dans leur cellule */
}

/* Pour les écrans plus petits - responsive */
@media (max-width: 768px) {
    .postulations-grid {
        flex-direction: column;
        align-items: center;
    }
    
    .postulation-card {
        width: 100%;
        max-width: 500px;
    }
}

    .postulation-card {
        background: white;
        border-radius: 16px;
        border: 2px solid #f1f5f9;
        padding: 2rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .postulation-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #1e40af);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .postulation-card:hover {
        border-color: #3b82f6;
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(59, 130, 246, 0.15);
    }

    .postulation-card:hover::before {
        transform: scaleX(1);
    }

    .postulation-mosque {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .mosque-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .mosque-info h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e40af;
        margin-bottom: 0.25rem;
    }

    .mosque-location {
        color: #64748B;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .postulation-details {
        display: grid;
        gap: 1rem;
    }

    .detail-row {
        display: flex;
        justify-content: between;
        align-items: center;
        padding: 0.75rem;
        background: #f8fafc;
        border-radius: 12px;
        border-left: 4px solid #e2e8f0;
    }

    .detail-label {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex: 1;
    }

    .detail-value {
        flex: 1;
        text-align: right;
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #d97706;
        border: 1px solid rgba(217, 119, 6, 0.2);
    }

    .status-accepted {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #16a34a;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .status-rejected {
        background: linear-gradient(135deg, #fee2e2, #fecaca);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .status-icon {
        font-size: 0.75rem;
    }

    /* Date Display */
    .date-display {
        color: #64748B;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Stats Summary */
    .stats-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: white;
        padding: 2rem;
        border-radius: 16px;
        border: 2px solid #f1f5f9;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
    }

    .stat-card.total::before {
        background: linear-gradient(90deg, #3b82f6, #1e40af);
    }

    .stat-card.pending::before {
        background: linear-gradient(90deg, #f59e0b, #d97706);
    }

    .stat-card.accepted::before {
        background: linear-gradient(90deg, #10b981, #16a34a);
    }

    .stat-card.rejected::before {
        background: linear-gradient(90deg, #ef4444, #dc2626);
    }

    .stat-card:hover {
        border-color: #3b82f6;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.1);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #64748B;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.875rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .section-background {
            padding: 2rem 0;
        }

        .postulations-container {
            padding: 0 1rem;
        }

        .card-header {
            padding: 2rem 1.5rem;
        }

        .card-content {
            padding: 2rem 1.5rem;
        }

        .card-title {
            font-size: 2rem;
        }

        .postulations-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .stats-summary {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-card {
            padding: 1.5rem;
        }

        .stat-number {
            font-size: 2rem;
        }
    }
</style>


<!-- Main Content Section -->
<section class="section-background">
    <div class="postulations-container">

        {{-- Alertes --}}
        @if(session('success'))
        <div class="alert alert-success">
            <div class="alert-icon">
                <i class="fas fa-check"></i>
            </div>
            <div>
                <strong>Félicitations !</strong> {{ session('success') }}
            </div>
        </div>
        @elseif(session('error'))
        <div class="alert alert-error">
            <div class="alert-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div>
                <strong>Erreur :</strong> {{ session('error') }}
            </div>
        </div>
        @endif

        {{-- Contenu principal --}}
        <div class="content-card">
            <div class="card-header">
                <i class="fas fa-mosque mosque-icon"></i>
                <h2 class="card-title">Mes candidatures</h2>
                <p class="card-subtitle">
                    Gérez et suivez toutes vos candidatures pour devenir chef de mosquée en temps réel.
                </p>
            </div>

            <div class="card-content">
                @if($postulations->isEmpty())
                {{-- État vide --}}
                <div class="empty-state">
                    <i class="fas fa-inbox empty-state-icon"></i>
                    <h3 class="empty-state-title">Aucune candidature pour le moment</h3>
                    <p class="empty-state-text">
                        Vous n'avez pas encore soumis de candidature. Commencez dès maintenant à postuler pour devenir chef de mosquée dans votre région.
                    </p>
                </div>
                @else
            

                {{-- Grille des candidatures --}}
                <div class="postulations-grid">
                    @foreach($postulations as $postulation)
                    <div class="postulation-card">
                        <div class="postulation-mosque">
                            
                            <div class="mosque-info">
                                <h3>{{ $postulation->mosquee->name }}</h3>
                                <div class="mosque-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $postulation->mosquee->adresse->ville ?? 'Adresse non spécifiée' }}
                                </div>
                            </div>
                        </div>

                        <div class="postulation-details">
                            <div class="detail-row">
                                <div class="detail-label">
                                    <i class="fas fa-flag"></i>
                                    Statut
                                </div>
                                <div class="detail-value">
                                    @if($postulation->statut == 'en_attente')
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-clock status-icon"></i>
                                        En attente
                                    </span>
                                    @elseif($postulation->statut == 'validé')
                                    <span class="status-badge status-accepted">
                                        <i class="fas fa-check status-icon"></i>
                                        Acceptée
                                    </span>
                                    @else
                                    <span class="status-badge status-rejected">
                                        <i class="fas fa-times status-icon"></i>
                                        Refusée
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    Date de candidature
                                </div>
                                <div class="detail-value">
                                    <div class="date-display">
                                        {{ $postulation->created_at->format('d/m/Y') }}
                                    </div>
                                </div>
                            </div>

                            @if($postulation->updated_at && $postulation->updated_at != $postulation->created_at)
                            <div class="detail-row">
                                <div class="detail-label">
                                    <i class="fas fa-history"></i>
                                    Dernière mise à jour
                                </div>
                                <div class="detail-value">
                                    <div class="date-display">
                                        {{ $postulation->updated_at->format('d/m/Y à H:i') }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection