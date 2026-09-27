@extends('chefmosque.layout')
@section('postulations')
<style>
    .motif-cell {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        position: relative;
        cursor: help;
    }

    .motif-cell:hover {
        white-space: normal;
        overflow: visible;
        background: rgba(0, 0, 0, 0.9);
        color: white;
        padding: 0.75rem;
        border-radius: 8px;
        position: absolute;
        z-index: 1000;
        max-width: 300px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
    }

    .demandes-container {
        max-width: 100%;
        margin: 0 auto;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 32px rgba(30, 58, 138, 0.3);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: scale(0.8);
        transition: transform 0.3s ease;
    }

    .page-header:hover::before {
        transform: scale(1.2);
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stats-bar {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .stat-item {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        flex: 1;
        min-width: 200px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--accent-color);
        transition: width 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .stat-item:hover::before {
        width: 100%;
        opacity: 0.1;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin: 0;
    }

    .stat-label {
        color: #64748B;
        font-size: 0.9rem;
        margin: 0;
        font-weight: 500;
    }

    .table-container {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .table-header {
        background: linear-gradient(135deg, #F8FAFC, #E2E8F0);
        padding: 1.5rem;
        border-bottom: 2px solid #E2E8F0;
    }

    .table-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-color);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .custom-table thead th {
        background: linear-gradient(135deg, var(--primary-color), #1E40AF);
        color: white;
        padding: 1.25rem 1rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        position: relative;
    }

    .custom-table tbody td {
        padding: 1.25rem 1rem;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .custom-table tbody tr {
        transition: all 0.2s ease;
        position: relative;
    }

    .custom-table tbody tr:hover {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(16, 185, 129, 0.05));
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .user-cell {
        font-weight: 600;
        color: var(--primary-color);
    }

    .motivation-cell,
    .experience-cell {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .status-en_attente {
        background: linear-gradient(135deg, #FEF3C7, #FDE68A);
        color: #92400E;
    }

    .status-validé {
        background: linear-gradient(135deg, #D1FAE5, #A7F3D0);
        color: #065F46;
    }

    .status-refusé {
        background: linear-gradient(135deg, #FEE2E2, #FECACA);
        color: #991B1B;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #64748B;
    }

    .empty-icon {
        font-size: 4rem;
        color: #CBD5E1;
        margin-bottom: 1rem;
    }

    .filter-bar {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-btn {
        padding: 0.75rem 1.5rem;
        border: 2px solid #E2E8F0;
        background: white;
        border-radius: 25px;
        font-weight: 500;
        color: #64748B;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .filter-btn:hover,
    .filter-btn.active {
        border-color: var(--accent-color);
        background: var(--accent-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    /* Styles pour les actions */
    .actions-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn {
        padding: 0.5rem;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        height: 36px;
        width: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-info {
        background: linear-gradient(135deg, #3b82f6, #1e40af);
        color: white;
    }

    .btn-info:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, #d97706, #b45309);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    /* Styles pour les modals */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 10000;
        backdrop-filter: blur(5px);
    }

    .modal-content {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        position: relative;
        animation: modalSlideIn 0.3s ease;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #E2E8F0;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin: 0;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #64748B;
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .close-btn:hover {
        background: #F1F5F9;
        color: #ef4444;
    }

    .detail-item {
        margin-bottom: 1.5rem;
    }

    .detail-label {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-value {
        color: #374151;
        line-height: 1.6;
        padding: 0.75rem;
        background: #F8FAFC;
        border-radius: 8px;
        border-left: 4px solid var(--accent-color);
    }

    /* Modal pour le statut */
    .status-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 10001;
        backdrop-filter: blur(5px);
    }

    .status-modal-content {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        position: relative;
        animation: modalSlideIn 0.3s ease;
    }

    .status-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #E2E8F0;
    }

    .status-modal-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary-color);
        margin: 0;
    }

    .status-options {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .status-btn {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.25rem;
        border: 2px solid #E2E8F0;
        background: white;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
        font-weight: 500;
        text-align: left;
        width: 100%;
    }

    .status-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .status-btn.en-attente {
        border-color: #FDE68A;
        background: #FEF3C7;
        color: #92400E;
    }

    .status-btn.en-attente:hover {
        background: #FDE68A;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .status-btn.valide {
        border-color: #A7F3D0;
        background: #D1FAE5;
        color: #065F46;
    }

    .status-btn.valide:hover {
        background: #A7F3D0;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .status-btn.refuse {
        border-color: #FECACA;
        background: #FEE2E2;
        color: #991B1B;
    }

    .status-btn.refuse:hover {
        background: #FECACA;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .status-icon {
        font-size: 1.25rem;
    }

    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .stats-bar {
            flex-direction: column;
        }

        .stat-item {
            min-width: auto;
        }

        .table-container {
            overflow-x: auto;
        }

        .custom-table {
            min-width: 800px;
        }

        .motivation-cell,
        .experience-cell {
            max-width: 150px;
        }

        .modal-content {
            width: 95%;
            padding: 1.5rem;
        }
    }
</style>

<div class="demandes-container">
    <!-- En-tête de page -->
    <div class="page-header">
        <h2 class="page-title">
            <i class="fas fa-user-tie"></i>
            Gestion des Demandes d'Imam
        </h2>
    </div>

    <!-- Statistiques -->
    <div class="stats-bar">
        <div class="stat-item">
            <p class="stat-number">{{ $postulations->count() }}</p>
            <p class="stat-label">Total des demandes</p>
        </div>
        <div class="stat-item">
            <p class="stat-number">{{ $postulations->where('statut', 'en_attente')->count() }}</p>
            <p class="stat-label">En attente</p>
        </div>
        <div class="stat-item">
            <p class="stat-number">{{ $postulations->where('statut', 'validé')->count() }}</p>
            <p class="stat-label">Acceptées</p>
        </div>
        <div class="stat-item">
            <p class="stat-number">{{ $postulations->where('statut', 'refusé')->count() }}</p>
            <p class="stat-label">Refusées</p>
        </div>
    </div>

    <!-- Filtres -->
    <div class="filter-bar">
        <button class="filter-btn active" onclick="filterTable('all')">
            <i class="fas fa-list"></i> Toutes
        </button>
        <button class="filter-btn" onclick="filterTable('en_attente')">
            <i class="fas fa-clock"></i> En attente
        </button>
        <button class="filter-btn" onclick="filterTable('validé')">
            <i class="fas fa-check-circle"></i> Acceptées
        </button>
        <button class="filter-btn" onclick="filterTable('refusé')">
            <i class="fas fa-times-circle"></i> Refusées
        </button>
    </div>

    <!-- Tableau des demandes -->
    <div class="table-container">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-table"></i>
                Liste des Postulations
            </h3>
        </div>

        @if($postulations->count() > 0)
        <table class="custom-table">
            <thead>
                <tr>
                    <th><i class="fas fa-user mr-2"></i>Candidat</th>
                    <th><i class="fas fa-heart mr-2"></i>Motivations</th>
                    <th><i class="fas fa-star mr-2"></i>Expériences</th>
                    <th><i class="fas fa-flag mr-2"></i>Statut</th>
                    <th><i class="fas fa-comment-alt mr-2"></i>Motif de refus</th>
                    <th><i class="fas fa-tools mr-2"></i>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($postulations as $postulation)
                <tr data-status="{{ $postulation->statut }}">
                    <td class="user-cell">
                        <i class="fas fa-user-circle mr-2"></i>
                        {{ $postulation->utilisateur->firstname ?? '' }} {{ $postulation->utilisateur->lastname ?? '' }}
                    </td>
                    <td class="motivation-cell" title="{{ $postulation->motivations }}">
                        {{ Str::limit($postulation->motivations, 50) }}
                    </td>
                    <td class="experience-cell" title="{{ $postulation->experience }}">
                        {{ Str::limit($postulation->experience, 50) }}
                    </td>
                    <td>
                        <span class="status-badge status-{{ $postulation->statut }}">
                            @if($postulation->statut == 'en_attente')
                            <i class="fas fa-clock mr-1"></i>
                            @elseif($postulation->statut == 'validé')
                            <i class="fas fa-check mr-1"></i>
                            @else
                            <i class="fas fa-times mr-1"></i>
                            @endif
                            {{ ucfirst(str_replace('_', ' ', $postulation->statut)) }}
                        </span>
                    </td>
                    <td class="motif-cell" title="{{ $postulation->motif_refus ?? '' }}">
                        {{ $postulation->motif_refus ? Str::limit($postulation->motif_refus, 30) : '-' }}
                    </td>
                    <td>
                        <div class="actions-container">
                            <!-- Voir détails -->
                            <button type="button" class="btn btn-info" title="Voir les détails" onclick="showDetails(
                                        '{{ $postulation->utilisateur->firstname ?? '' }} {{ $postulation->utilisateur->lastname ?? '' }}',
                                        '{{ addslashes($postulation->motivations) }}', 
                                        '{{ addslashes($postulation->experience) }}', 
                                        '{{ $postulation->statut }}',
                                        '{{ $postulation->motif_refus ?? '' }}'
                                    )">
                                <i class="fas fa-eye"></i>
                            </button>

                            <!-- Modifier statut -->
                            <button type="button" class="btn btn-warning" title="Modifier le statut" onclick="showStatusModal({{ $postulation->id }}, '{{ $postulation->statut }}')">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Supprimer -->
                            <form action="{{ route('demande_imam.destroy', $postulation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette postulation ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-inbox"></i>
            </div>
            <h3>Aucune demande trouvée</h3>
            <p>Il n'y a actuellement aucune demande d'imam.</p>
        </div>
        @endif
    </div>
</div>

<!-- Modal pour voir les détails -->
<div class="modal-overlay" id="detailsModal" onclick="closeModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h3 class="modal-title">
                <i class="fas fa-info-circle"></i>
                Détails de la Postulation
            </h3>
            <button class="close-btn" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="detail-item">
            <div class="detail-label">
                <i class="fas fa-user"></i>
                Candidat
            </div>
            <div class="detail-value" id="modal-candidat"></div>
        </div>

        <div class="detail-item">
            <div class="detail-label">
                <i class="fas fa-heart"></i>
                Motivations
            </div>
            <div class="detail-value" id="modal-motivations"></div>
        </div>

        <div class="detail-item">
            <div class="detail-label">
                <i class="fas fa-star"></i>
                Expériences
            </div>
            <div class="detail-value" id="modal-experiences"></div>
        </div>

        <div class="detail-item">
            <div class="detail-label">
                <i class="fas fa-flag"></i>
                Statut
            </div>
            <div class="detail-value" id="modal-statut"></div>
        </div>

        <div class="detail-item" id="motif-container" style="display: none;">
            <div class="detail-label">
                <i class="fas fa-exclamation-triangle"></i>
                Motif du refus
            </div>
            <div class="detail-value" id="modal-motif"></div>
        </div>
    </div>
</div>

<!-- Modal pour modifier le statut -->
<div class="status-modal" id="statusModal" onclick="closeStatusModal()">
    <div class="status-modal-content" onclick="event.stopPropagation()">
        <div class="status-modal-header">
            <h3 class="status-modal-title">
                <i class="fas fa-edit"></i>
                Modifier le Statut
            </h3>
            <button class="close-btn" onclick="closeStatusModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="status-options">
            <button type="button" class="status-btn en-attente" onclick="changeStatus('en_attente')">
                <span class="status-icon">🕒</span>
                <span>En attente</span>
            </button>

            <button type="button" class="status-btn valide" onclick="changeStatus('validé')">
                <span class="status-icon">✅</span>
                <span>Acceptée</span>
            </button>

            <button type="button" class="status-btn refuse" onclick="showRefusModal()">
                <span class="status-icon">❌</span>
                <span>Refusée</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal pour motif de refus -->
<div class="status-modal" id="refusModal" onclick="closeRefusModal()">
    <div class="status-modal-content" onclick="event.stopPropagation()">
        <div class="status-modal-header">
            <h3 class="status-modal-title">
                <i class="fas fa-times-circle"></i>
                Motif du refus
            </h3>
            <button class="close-btn" onclick="closeRefusModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div style="margin-bottom: 1rem;">
            <label for="motif-refus" style="display: block; margin-bottom: 0.5rem; font-weight: 600;">
                Veuillez préciser le motif du refus :
            </label>
            <textarea id="motif-refus" placeholder="Expliquez pourquoi cette demande est refusée..." style="width: 100%; height: 100px; padding: 0.75rem; border: 2px solid #E2E8F0; border-radius: 8px; resize: vertical;"></textarea>
        </div>

        <div style="display: flex; gap: 1rem;">
            <button type="button" onclick="closeRefusModal()" style="flex: 1; padding: 0.75rem; background: #E5E7EB; border: none; border-radius: 8px; cursor: pointer;">
                Annuler
            </button>
            <button type="button" onclick="confirmRefus()" style="flex: 1; padding: 0.75rem; background: #EF4444; color: white; border: none; border-radius: 8px; cursor: pointer;">
                Confirmer le refus
            </button>
        </div>
    </div>
</div>

<!-- Formulaire caché pour soumettre le changement de statut -->
<form id="statusForm" method="POST" style="display: none;">
    @csrf
    @method('PUT')
    <input type="hidden" name="statut" id="statusInput">
    <input type="hidden" name="motif_refus" id="motifInput">
</form>

<script>
    let currentPostulationId = null;

    function filterTable(status) {
        const rows = document.querySelectorAll('.custom-table tbody tr');
        const buttons = document.querySelectorAll('.filter-btn');

        // Mise à jour des boutons
        buttons.forEach(btn => btn.classList.remove('active'));
        event.target.closest('.filter-btn').classList.add('active');

        // Filtrage des lignes
        rows.forEach(row => {
            if (status === 'all' || row.dataset.status === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function showDetails(candidat, motivations, experiences, statut, motifRefus) {
        document.getElementById('modal-candidat').textContent = candidat;
        document.getElementById('modal-motivations').textContent = motivations;
        document.getElementById('modal-experiences').textContent = experiences;

        let statutText = '';
        switch (statut) {
            case 'en_attente':
                statutText = '🕒 En attente';
                break;
            case 'validé':
                statutText = '✅ Acceptée';
                break;
            case 'refusé':
                statutText = '❌ Refusée';
                break;
        }
        document.getElementById('modal-statut').textContent = statutText;

        // Afficher le motif de refus si il existe
        const motifContainer = document.getElementById('motif-container');
        if (statut === 'refusé' && motifRefus) {
            document.getElementById('modal-motif').textContent = motifRefus;
            motifContainer.style.display = 'block';
        } else {
            motifContainer.style.display = 'none';
        }

        document.getElementById('detailsModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('detailsModal').style.display = 'none';
    }

    function showStatusModal(postulationId, currentStatus) {
        currentPostulationId = postulationId;
        document.getElementById('statusModal').style.display = 'flex';

        // Mettre à jour l'action du formulaire
        document.getElementById('statusForm').action = `/chefmosque/demande_imam/${postulationId}/statut`;
    }

    function closeStatusModal() {
        document.getElementById('statusModal').style.display = 'none';
        currentPostulationId = null;
    }

    function showRefusModal() {
        document.getElementById('refusModal').style.display = 'flex';
        document.getElementById('motif-refus').value = '';
    }

    function closeRefusModal() {
        document.getElementById('refusModal').style.display = 'none';
    }

    function confirmRefus() {
        const motif = document.getElementById('motif-refus').value;
        if (!motif) {
            alert('Veuillez saisir un motif de refus');
            return;
        }

        document.getElementById('motifInput').value = motif;
        document.getElementById('statusInput').value = 'refusé';
        document.getElementById('statusForm').submit();

        closeRefusModal();
        closeStatusModal();
    }

    function changeStatus(status) {
        if (status === 'refusé') {
            showRefusModal();
        } else {
            document.getElementById('statusInput').value = status;
            document.getElementById('motifInput').value = '';
            document.getElementById('statusForm').submit();
            closeStatusModal();
        }
    }
</script>
@endsection