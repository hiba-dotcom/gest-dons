
@extends('admin/adminLayout')

@section('postulations')


<div class="p-6">
    <!-- Filtres -->
    <div class="mb-6">
        <form method="GET" action="{{ route('association.postulation') }}" class="flex items-center space-x-4">
            <select name="statut" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Tous les statuts</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>En attente</option>
                <option value="validé" {{ request('status') === 'validé' ? 'selected' : '' }}>Validée</option>
                <option value="refusé" {{ request('status') === 'refusé' ? 'selected' : '' }}>Refusée</option>
            </select>
            <button type="submit" class="btn-primary px-4 py-2 rounded-lg text-sm font-medium">
                <i class="fas fa-filter mr-2"></i>Filtrer
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Association</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Président</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($postulations as $postulation)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover shadow-sm"
                                        src="{{ $postulation->association->image ?? 'https://via.placeholder.com/150' }}"
                                        alt="Logo {{ $postulation->association->nom }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $postulation->association->nom }}</div>
                                    <div class="text-sm text-gray-500">{{ $postulation->association->slogan }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 font-medium">{{ $postulation->president->nom }} {{ $postulation->president->prenom }}</div>
                            <div class="text-sm text-gray-500">{{ $postulation->president->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $postulation->created_at->format('d/m/Y à H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                            $statusConfig = [
                            'pending' => ['text' => 'En attente', 'class' => 'bg-yellow-100 text-yellow-800 border-yellow-200'],
                            'validé' => ['text' => 'Validée', 'class' => 'bg-green-100 text-green-800 border-green-200'],
                            'refusé' => ['text' => 'Refusée', 'class' => 'bg-red-100 text-red-800 border-red-200']
                            ];
                            $config = $statusConfig[$postulation->statut] ?? $statusConfig['pending'];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $config['class'] }}">
                                <span class="w-2 h-2 bg-current rounded-full mr-2"></span>
                                {{ $config['text'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <!-- Bouton Détails -->
                                <form method="GET" action="{{ route('admin.postulation.show', $postulation->id) }}" class="inline">
                                    <button type="submit" class="text-blue-600 hover:text-blue-900 hover:bg-blue-50 px-3 py-1 rounded-md transition-colors duration-200">
                                        <i class="fas fa-eye mr-1"></i>Détails
                                    </button>
                                </form>

                                <!-- Bouton Changer Statut -->
                                <button onclick="openStatusModal({{ $postulation->id }}, '{{ $postulation->statut }}')"
                                    class="text-purple-600 hover:text-purple-900 hover:bg-purple-50 px-3 py-1 rounded-md transition-colors duration-200">
                                    <i class="fas fa-edit mr-1"></i>Changer statut
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>

<!-- Modal pour changer le statut -->
<div id="status-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95" id="modal-content">
        <form id="status-form" method="POST" action="{{ route('admin.postulation.updateStatus' ,$postulation->id ) }}">
            @csrf
            @method('PUT')


            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-edit text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Changer le statut</h3>
                    </div>
                    <button type="button" onclick="closeStatusModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-full transition-colors duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="space-y-4">
                    <p class="text-sm text-gray-600 mb-4">Sélectionnez le nouveau statut pour cette postulation :</p>

                    <div class="space-y-3">
                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors duration-200">
                            <input type="radio" name="statut" value="pending" class="text-yellow-600 focus:ring-yellow-500">
                            <div class="ml-3 flex items-center">
                                <span class="w-3 h-3 bg-yellow-400 rounded-full mr-3"></span>
                                <span class="font-medium text-gray-900">En attente</span>
                            </div>
                        </label>

                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors duration-200">
                            <input type="radio" name="statut" value="validé" class="text-green-600 focus:ring-green-500">
                            <div class="ml-3 flex items-center">
                                <span class="w-3 h-3 bg-green-400 rounded-full mr-3"></span>
                                <span class="font-medium text-gray-900">Validée</span>
                            </div>
                        </label>

                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors duration-200">
                            <input type="radio" name="statut" value="refusé" class="text-red-600 focus:ring-red-500">
                            <div class="ml-3 flex items-center">
                                <span class="w-3 h-3 bg-red-400 rounded-full mr-3"></span>
                                <span class="font-medium text-gray-900">Refusée</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-end space-x-3">
                <button type="button" onclick="closeStatusModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                    Annuler
                </button>
                <button type="submit"
                    class="btn-primary px-6 py-2 rounded-lg text-sm font-medium flex items-center">
                    <i class="fas fa-check mr-2"></i>
                    Confirmer
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de confirmation (optionnel pour les actions importantes) -->
@if(session('success'))
<div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center" id="success-toast">
    <i class="fas fa-check-circle mr-2"></i>
    {{ session('success') }}
    <button onclick="document.getElementById('success-toast').remove()" class="ml-4 text-green-200 hover:text-white">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

@if(session('error'))
<div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center" id="error-toast">
    <i class="fas fa-exclamation-circle mr-2"></i>
    {{ session('error') }}
    <button onclick="document.getElementById('error-toast').remove()" class="ml-4 text-red-200 hover:text-white">
        <i class="fas fa-times"></i>
    </button>
</div>
@endif

<script>
    // JavaScript minimal pour le modal
    function openStatusModal(postulationId, currentStatus) {
        const modal = document.getElementById('status-modal');
        const form = document.getElementById('status-form');
        const modalContent = document.getElementById('modal-content');

        // Définir l'action du formulaire
        form.action = `/admin/postulations/${postulationId}/status`;

        // Cocher le statut actuel
        const radios = form.querySelectorAll('input[name="statut"]');
        radios.forEach(radio => {
            radio.checked = radio.value === currentStatus;
        });

        // Afficher le modal avec animation
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    function closeStatusModal() {
        const modal = document.getElementById('status-modal');
        const modalContent = document.getElementById('modal-content');

        // Animation de fermeture
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Fermer le modal en cliquant en dehors
    document.getElementById('status-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeStatusModal();
        }
    });

    // Auto-hide des toasts après 5 secondes
    setTimeout(() => {
        const toasts = document.querySelectorAll('#success-toast, #error-toast');
        toasts.forEach(toast => {
            if (toast) {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 300);
            }
        });
    }, 5000);
</script>

<style>
    /* Animation pour le modal */
    #modal-content {
        transition: transform 0.3s ease;
    }

    /* Styles pour les toasts */
    #success-toast,
    #error-toast {
        transition: all 0.3s ease;
    }

    /* Amélioration des radio buttons */
    input[type="radio"] {
        width: 1.25rem;
        height: 1.25rem;
    }

    input[type="radio"]:checked+div {
        font-weight: 600;
    }

    /* Animation hover pour les boutons d'action */
    .hover\:bg-blue-50:hover {
        background-color: #eff6ff;
    }

    .hover\:bg-purple-50:hover {
        background-color: #faf5ff;
    }
</style>
@endsection