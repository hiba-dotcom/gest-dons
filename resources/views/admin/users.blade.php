@extends('admin/adminLayout')
@section('users')
@if (session('success'))
<div class="container mx-auto  ">
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md" role="alert">
        <div class="flex items-center justify-between">
            <p class="font-semibold">{{ session('success') }}</p>
            <button onclick="this.parentElement.parentElement.remove()" class="text-green-700 hover:text-green-900 font-bold text-lg">&times;</button>
        </div>
    </div>
</div>
@endif

@if (session('error'))
<div class="container mx-auto  ">
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md" role="alert">
        <div class="flex items-center justify-between">
            <p class="font-semibold">{{ session('error') }}</p>
            <button onclick="this.parentElement.parentElement.remove()" class="text-red-700 hover:text-red-900 font-bold text-lg">&times;</button>
        </div>
    </div>
</div>
@endif
<main class="p-6">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Gestion des Utilisateurs</h1>
                <p class="text-gray-600">Gérez les utilisateurs et leurs rôles dans le système</p>
            </div>

        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="stat-card bg-blue-500 p-6 rounded-xl">
            <p class="text-white text-sm mb-2">Total utilisateurs</p>
            <p class="text-3xl font-bold text-white">{{ $users->count() }}</p>
        </div>

        <!-- Adhérents -->
        <div class="stat-card bg-green-500 p-6 rounded-xl">
            <p class="text-white text-sm mb-2">Adhérents</p>
            <p class="text-3xl font-bold text-white">{{ $users->where('role', 'adherant')->count() }}</p>
        </div>

        <!-- Imams -->
        <div class="stat-card bg-yellow-500 p-6 rounded-xl">
            <p class="text-white text-sm mb-2">Imams</p>
            <p class="text-3xl font-bold text-white">{{ $users->where('role', 'imam')->count() }}</p>
        </div>

        <!-- Présidents -->
        <div class="stat-card bg-indigo-500 p-6 rounded-xl">
            <p class="text-white text-sm mb-2">Présidents</p>
            <p class="text-3xl font-bold text-white">{{ $users->where('role', 'président')->count() }}</p>
        </div>
    </div>
    
    <!-- Users Table -->
    <div class="card overflow-hidden">
        <div class="table-header px-6 py-4">
            <h3 class="text-lg font-semibold text-gray-800">Liste des Utilisateurs</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Utilisateur
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date de Naissance
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Rôle
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold">
                                    {{ strtoupper(substr($user->firstname, 0, 1) . substr($user->lastname, 0, 1)) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $user->firstname }} {{ $user->lastname }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        ID: #{{ $user->id }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                <div class="flex items-center mb-1">
                                    <i class="fas fa-envelope text-gray-400 mr-2"></i>
                                    {{ $user->email }}
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-gray-400 mr-2"></i>
                                    {{ $user->phone }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $user->birthDate ? \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') : 'Non renseigné' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                            $roleColors = [
                            'adherant' => 'bg-green-100 text-green-800',
                            'admin' => 'bg-purple-100 text-purple-800',
                            'président' => 'bg-indigo-100 text-indigo-800',
                            'imam' => 'bg-yellow-100 text-yellow-800',
                            ];
                            
                            $roleNames = [
                            'adherant' => 'Adhérent',
                            'admin' => 'Administrateur',
                            'président' => 'Président',
                            'imam' => 'Imam',
                            ];
                            @endphp
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $roleColors[$user->role] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $roleLabels[$user->role] ?? ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button onclick="openChangeRoleModal({{ $user->id }}, '{{ $user->firstname }} {{ $user->lastname }}', '{{ $user->role }}')"
                                    class="btn-primary px-3 py-1 rounded text-xs">
                                    <i class="fas fa-user-cog mr-1"></i>
                                    Changer Rôle
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <i class="fas fa-users text-4xl mb-4"></i>
                                <p class="text-lg font-medium">Aucun utilisateur trouvé</p>
                                <p class="text-sm">Commencez par ajouter des utilisateurs au système</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Change Role Modal -->
<div id="changeRoleModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4 transform transition-all">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Changer le Rôle</h3>
            <button onclick="closeChangeRoleModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form id="changeRoleForm" method="POST" action="{{route('user.role.change')}}">
            @csrf
            @method('PUT')
            <input type="hidden" id="userId" name="user_id" value="">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Utilisateur
                </label>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <span id="selectedUserName" class="font-medium text-gray-800"></span>
                </div>
            </div>

            <div class="mb-6">
                <label for="newRole" class="block text-sm font-medium text-gray-700 mb-2">
                    Nouveau Rôle <span class="text-red-500">*</span>
                </label>
                <select id="newRole" name="role" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Sélectionner un rôle</option>
                    <option value="adherant">Adhérent</option>
                    <option value="admin">Administrateur</option>
                    <option value="président">Président</option>
                    <option value="imam">Imam</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeChangeRoleModal()"
                    class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Annuler
                </button>
                <button type="submit" class="btn-primary px-6 py-2 rounded-lg">
                    Confirmer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Modal functions only
    let currentUserId = null;

    function openChangeRoleModal(userId, userName, currentRole) {
        currentUserId = userId;
        document.getElementById('selectedUserName').textContent = userName;
        document.getElementById('newRole').value = currentRole;
        document.getElementById('userId').value = userId;
        document.getElementById('changeRoleModal').classList.remove('hidden');
    }

    function closeChangeRoleModal() {
        document.getElementById('changeRoleModal').classList.add('hidden');
        document.getElementById('changeRoleForm').reset();
        currentUserId = null;
    }

    // Close modal when clicking outside
    document.getElementById('changeRoleModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeChangeRoleModal();
        }
    });
</script>
@endsection