@extends('admin/adminLayout')

@section('postulations')
<div class="p-6">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('association.postulation') }}" class="text-gray-700 hover:text-blue-600">
                    <i class="fas fa-arrow-left mr-2"></i>Retour aux postulations
                </a>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- En-tête -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <img src="{{ $postulation->association->image ?? 'https://via.placeholder.com/150' }}"
                        alt="Logo" class="h-16 w-16 rounded-full object-cover border-4 border-white shadow-lg mr-4">
                    <div>
                        <h1 class="text-2xl font-bold">{{ $postulation->association->nom }}</h1>
                        <p class="text-blue-100">{{ $postulation->association->slogan }}</p>
                    </div>
                </div>
                <div class="text-right">
                    @php
                    $statusConfig = [
                    'pending' => ['text' => 'En attente', 'class' => 'bg-yellow-500'],
                    'validé' => ['text' => 'Validée', 'class' => 'bg-green-500'],
                    'refusé' => ['text' => 'Refusée', 'class' => 'bg-red-500']
                    ];
                    $config = $statusConfig[$postulation->statut] ?? $statusConfig['pending'];
                    @endphp
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $config['class'] }} text-white">
                        {{ $config['text'] }}
                    </span>
                    <p class="text-blue-100 text-sm mt-2">{{ $postulation->created_at->format('d/m/Y à H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <!-- Informations principales -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Informations Association -->
                <div class="card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-heart text-red-500 mr-2"></i>
                        Informations sur l'association
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Budget total:</span>
                            <span class="font-medium">{{ number_format($postulation->association->totaleBudget, 0, ',', ' ') }} €</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nombre de membres:</span>
                            <span class="font-medium">{{ $postulation->association->totaleMembres }}</span>
                        </div>
                        <div class="pt-3 border-t">
                            <p class="text-gray-700">{{ $postulation->association->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Informations Président -->
                <div class="card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-user-tie text-blue-500 mr-2"></i>
                        Informations sur le président
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $postulation->president->nom }} {{ $postulation->president->prenom }}</p>
                                <p class="text-gray-600">{{ $postulation->president->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu de la postulation -->
            <div class="space-y-6">
                <!-- Plan proposé -->
                <div class="card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-road text-green-500 mr-2"></i>
                        Plan proposé
                    </h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $postulation->plan }}</p>
                    </div>
                </div>

                <!-- Expériences -->
                <div class="card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-briefcase text-purple-500 mr-2"></i>
                        Expériences
                    </h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $postulation->experiences }}</p>
                    </div>
                </div>

                <!-- Motivations -->
                <div class="card p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-fire text-orange-500 mr-2"></i>
                        Motivations
                    </h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $postulation->motivations }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex justify-end space-x-3 pt-6 border-t">
                <button onclick="openStatusModal({{ $postulation->id }}, '{{ $postulation->statut }}')"
                    class="btn-primary px-6 py-2 rounded-lg flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Changer le statut
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Réutiliser le même modal que dans la page index -->
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

<script>
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
@endsection