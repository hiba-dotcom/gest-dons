@extends('president.layout')
@section('dashboard')
<header class="bg-white shadow-sm border-b">
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center">
            <button id="mobile-menu-btn" class="md:hidden mr-4 text-gray-600">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-2xl font-bold text-gray-800">Tableau de bord</h1>
        </div>

    </div>
</header>

<main class="p-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="card stat-card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Demandes</p>
                    <p class="text-3xl font-bold">12</p>
                    <p class="text-blue-200 text-xs mt-1">+12% ce mois</p>
                </div>
                <i class="fas fa-users text-3xl text-blue-200"></i>
            </div>
        </div>

        <div class="card stat-card success p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Mosquées</p>
                    <p class="text-3xl font-bold">9</p>
                    <p class="text-green-200 text-xs mt-1">+3 nouvelles</p>
                </div>
                <i class="fas fa-mosque text-3xl text-green-200"></i>
            </div>
        </div>

        <div class="card stat-card warning p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-100 text-sm">Evénements</p>
                    <p class="text-3xl font-bold">9</p>
                    <p class="text-yellow-200 text-xs mt-1">+7 ce mois</p>
                </div>
                <i class="fas fa-heart text-3xl text-yellow-200"></i>
            </div>
        </div>
    </div>
</main>
@endsection