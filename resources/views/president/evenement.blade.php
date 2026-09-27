@extends('president.layout')
@section('evenements')

<style>
    .form-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .form-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .input-field {
        border: 2px solid #E5E7EB;
        border-radius: 8px;
        padding: 12px 16px;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .input-field:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    .table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .table-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
    }

    .table-row {
        transition: all 0.3s ease;
    }

    .table-row:hover {
        background-color: var(--accent-light);
    }

    .btn-add {
        background-color: var(--secondary-color);
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.25);
    }

    .btn-add:hover {
        background-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(59, 130, 246, 0.3);
    }

    .btn-nouvelle-mosquee {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .btn-nouvelle-mosquee:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    .btn-edit {
        color: var(--accent-color);
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        color: #059669;
        text-decoration: underline;
    }

    .btn-delete {
        color: #EF4444;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        color: #DC2626;
        text-decoration: underline;
    }

    .page-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 2rem;
    }

    .section-title {
        color: var(--text-color);
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .label-text {
        color: var(--text-color);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    /* Animation pour le formulaire */
    .form-container {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease-out, opacity 0.3s ease-out;
        opacity: 0;
    }

    .form-container.show {
        max-height: 1000px;
        opacity: 1;
    }

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    /* Styles pour les cartes d'événements */
    .event-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border-left: 4px solid var(--secondary-color);
    }

    .event-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        border-left-color: var(--accent-color);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .header-section {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<main class="container mx-auto px-4 py-8" style="background-color: var(--background-light);">

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6">
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg fade-in">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <span class="text-green-700 font-medium">{{ session('success') }}</span>
            </div>
        </div>
    </div>
    @endif

    <!-- En-tête avec titre et bouton -->
    <div class="header-section">
        <h1 class="page-title text-3xl">
            <i class="fas fa-calendar-alt mr-3" style="color: var(--secondary-color);"></i>
            Gestion des Événements
        </h1>

        <button id="toggleFormBtn" class="btn-nouvelle-mosquee">
            <i class="fas fa-plus mr-2"></i>
            <span id="btnText">Nouveau Événement</span>
        </button>
    </div>

    <!-- Formulaire de création d'événement (masqué par défaut) -->
    <div id="formContainer" class="form-container">
        <div class="form-card p-8 mb-10">
            <h2 class="section-title text-2xl">
                <i class="fas fa-calendar-alt mr-3" style="color: var(--secondary-color);"></i>
                Créer un nouvel événement
            </h2>

            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('president.evenements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Event Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="label-text block">
                            <i class="fas fa-tag mr-2" style="color: var(--secondary-color);"></i>Nom de l'événement
                        </label>
                        <input type="text" name="nom" required class="input-field w-full">
                    </div>

                    <div>
                        <label class="label-text block">
                            <i class="fas fa-euro-sign mr-2" style="color: var(--accent-color);"></i>Budget
                        </label>
                        <input type="number" name="budget" step="0.01" required class="input-field w-full">
                    </div>
                </div>

                <!-- Date Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="label-text block">
                            <i class="fas fa-calendar-day mr-2" style="color: var(--secondary-color);"></i>Date de début
                        </label>
                        <input type="date" name="dateDebut" required class="input-field w-full">
                    </div>

                    <div>
                        <label class="label-text block">
                            <i class="fas fa-calendar-check mr-2" style="color: var(--secondary-color);"></i>Date de fin
                        </label>
                        <input type="date" name="dateFin" required class="input-field w-full">
                    </div>
                </div>
                <!-- Description -->
                <div class="mb-4">
                    <label class="label-text block">
                        <i class="fas fa-align-left mr-2" style="color: var(--secondary-color);"></i>Description de l'événement
                    </label>
                    <textarea name="description" rows="4" class="input-field w-full" placeholder="Entrez une description (facultatif)">{{ old('description') }}</textarea>
                </div>
                <!-- Address Section -->
                <div class="mb-4">
                    <h3 class="label-text text-lg mb-4">
                        <i class="fas fa-map-marker-alt mr-2" style="color: var(--secondary-color);"></i>
                        Adresse de l'événement
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="label-text block">Boulevard</label>
                            <input type="text" name="boulevard" required class="input-field w-full">
                        </div>
                        <div>
                            <label class="label-text block">Ville</label>
                            <input type="text" name="ville" required class="input-field w-full">
                        </div>
                        <div>
                            <label class="label-text block">Pays</label>
                            <input type="text" name="pays" required class="input-field w-full">
                        </div>
                    </div>
                </div>

                <!-- Association and Image -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="label-text block">
                            <i class="fas fa-users mr-2" style="color: var(--secondary-color);"></i>Association
                        </label>
                        <select name="association_id" required class="input-field w-full">
                            @foreach($associations as $association)
                            <option value="{{ $association->id }}">{{ $association->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="label-text block">Image <span>(jpeg,png,jpg,gif,svg, max 2 Mo)*</span></label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="validateImageSize(this)" required>
                    </div>
                </div>

                <div class="flex justify-between">
                    <button type="button" id="cancelBtn" class="px-6 py-3 border border-gray-300 rounded-lg font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </button>
                    <button type="submit" class="btn-add px-8 py-3 rounded-lg font-semibold">
                        <i class="fas fa-plus mr-2"></i>Créer l'événement
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des événements -->
    <div class="table-container">
        <div class="table-header p-6">
            <h2 class="text-2xl font-semibold">
                <i class="fas fa-list mr-3"></i>Événements enregistrés

            </h2>
        </div>

        <div class="p-6">
            @if($evenements->isEmpty())
            <div class="text-center py-8">
                <i class="fas fa-mosque text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-500 text-lg">Aucune mosquée enregistrée.</p>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2" style="border-color: var(--secondary-color);">
                            <th class="text-left py-4 px-4 font-semibold" style="color: var(--text-color);">Nom</th>
                            <th class="text-left py-4 px-4 font-semibold" style="color: var(--text-color);">Budget</th>
                            <th class="text-left py-4 px-4 font-semibold" style="color: var(--text-color);">Image</th>
                            <th class="text-left py-4 px-4 font-semibold" style="color: var(--text-color);">Période</th>
                            <th class="text-left py-4 px-4 font-semibold" style="color: var(--text-color);">Lieu</th>
                            <th class="text-left py-4 px-4 font-semibold" style="color: var(--text-color);">Association</th>
                            <th class="text-left py-4 px-4 font-semibold" style="color: var(--text-color);">Description</th>
                            <th class="text-center py-4 px-4 font-semibold" style="color: var(--text-color);">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($evenements as $evenement)
                        <tr class="table-row border-b border-gray-100">
                            <td class="py-4 px-4 font-medium">{{ $evenement->nom }}</td>
                            <td class="py-4 px-4">
                                <span class="font-bold" style="color: var(--accent-color);">{{ number_format($evenement->budget, 2) }} €</span>
                            </td>
                            <td class="border px-4 py-2">
                                @if($evenement->image)
                                <img src="{{ asset('storage/' . $evenement->image) }}" class="w-12 h-12 rounded-full object-cover">
                                @else
                                <span class="text-gray-400">Aucune image</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">
                                    <div>{{ \Carbon\Carbon::parse($evenement->dateDebut)->format('d/m/Y') }}</div>
                                    <div class="text-gray-500">au {{ \Carbon\Carbon::parse($evenement->dateFin)->format('d/m/Y') }}</div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                @if($evenement->adresse)
                                <div class="text-sm">
                                    <div>{{ $evenement->adresse->ville }}</div>
                                    <div class="text-gray-500">{{ $evenement->adresse->pays }}</div>
                                </div>
                                @else
                                <span class="text-gray-400">Non renseigné</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <span class="text-black-500">

                                    {{ $evenement->association->nom }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-sm text-gray-700">
                                {{ \Illuminate\Support\Str::limit($evenement->description, 60, '...') }}
                            </td>

                            <td class="py-4 px-4 text-center">
                                <div class="flex justify-center space-x-4">
                                    <!-- Lien pour Modifier -->
                                    <a href="{{ route('president.evenements.edit', $evenement->id) }}" class="btn-edit">
                                        <i class="fas fa-edit mr-1"></i>Modifier
                                    </a>

                                    <!-- Formulaire de Suppression -->
                                    <form action="{{ route('president.evenements.destroy', $evenement->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')" class="btn-delete">
                                            <i class="fas fa-trash mr-1"></i>Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Références aux éléments
        const toggleBtn = document.getElementById('toggleFormBtn');
        const formContainer = document.getElementById('formContainer');
        const btnText = document.getElementById('btnText');
        const btnIcon = toggleBtn.querySelector('i');
        const cancelBtn = document.getElementById('cancelBtn');

        // État du formulaire
        let isFormVisible = false;

        // Fonction pour basculer l'affichage du formulaire
        function toggleForm() {
            isFormVisible = !isFormVisible;

            if (isFormVisible) {
                // Afficher le formulaire
                formContainer.classList.add('show');
                btnText.textContent = 'Fermer';
                btnIcon.className = 'fas fa-times mr-2';

                // Scroll vers le formulaire
                setTimeout(() => {
                    formContainer.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            } else {
                // Masquer le formulaire
                formContainer.classList.remove('show');
                btnText.textContent = 'Nouveau Événement';
                btnIcon.className = 'fas fa-plus mr-2';
            }
        }

        // Event listeners
        toggleBtn.addEventListener('click', toggleForm);
        cancelBtn.addEventListener('click', function() {
            if (isFormVisible) {
                toggleForm();
                // Réinitialiser le formulaire
                const form = formContainer.querySelector('form');
                form.reset();
            }
        });

        // Effet de focus amélioré pour les champs
        const inputFields = document.querySelectorAll('.input-field');
        inputFields.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.01)';
            });

            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });
    });

    function validateImageSize(input) {
        const file = input.files[0];
        const maxSize = 2 * 1024 * 1024; // 2 Mo en octets

        if (file && file.size > maxSize) {
            alert("L'image ne doit pas dépasser 2 Mo.");
            input.value = ""; // réinitialise le champ
        }
    }
</script>

@endsection