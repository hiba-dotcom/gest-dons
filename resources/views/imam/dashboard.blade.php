@extends('imam/imamLayout')
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
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 p-5">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm opacity-90">Total Cours</h3>
                <p class="text-2xl font-bold">{{auth()->user()->cours->count()}}</p>
            </div>
            <i class="fas fa-book text-2xl opacity-75"></i>
        </div>
    </div>
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-4 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm opacity-90">Cours Actifs</h3>
                <p class="text-2xl font-bold">{{ auth()->user()->cours->where('statut', 'validé')->count() }}</p>
            </div>
            <i class="fas fa-play-circle text-2xl opacity-75"></i>
        </div>
    </div>
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-4 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-sm opacity-90">Cours En Attentes</h3>
                <p class="text-2xl font-bold">{{ auth()->user()->cours->where('statut', 'pending')->count() }}</p>
            </div>
            <i class="fas fa-clock text-2xl opacity-75"></i>
        </div>
    </div>
</div>
@endsection