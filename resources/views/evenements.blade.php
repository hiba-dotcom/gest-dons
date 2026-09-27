@extends('layout')
@section('evenements')

<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-cyan-50">
    <div class="relative z-10 container mx-auto px-4 py-12">
        <!-- Header Section -->
        <div class="flex flex-col items-center mb-12">
            <div class="text-center w-full">
                <h1 class="text-4xl md:text-5xl font-bold text-blue-800 mb-4">
                    {{ __('messages.events') }}
                </h1>
                <p class="text-gray-600 max-w-3xl mx-auto text-lg flex items-center justify-center gap-2">
                    <i class="fas fa-calendar-alt text-blue-500"></i>
                    {{ __('messages.events_subtitle') }}
                </p>
            </div>
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($events as $event)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-2xl hover:scale-105 border border-gray-200">
                <!-- Event Image with fixed height -->
                <div class="relative h-48 w-full"> <!-- Fixed height of 12rem (48 in Tailwind) and full width -->
                    <img src="{{ $event->image_url ?? 'https://via.placeholder.com/400x250.png?text=Event+Image' }}"
                        alt="{{ $event->nom }}" 
                        class="w-full h-full object-cover"> <!-- object-cover ensures image fills container while maintaining aspect ratio -->
                    
                    <!-- Status Badge -->
                    <div class="absolute top-4 left-4">
                        @php
                            $status = \Carbon\Carbon::parse($event->dateDebut)->isFuture() ? 'À venir' : 
                                     (\Carbon\Carbon::parse($event->dateFin)->isPast() ? 'Terminé' : 'En cours');
                            $statusClass = $status === 'À venir' ? 'bg-blue-500 text-white' : 
                                          ($status === 'Terminé' ? 'bg-gray-500 text-white' : 'bg-green-500 text-white');
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                            {{ $status }}
                        </span>
                    </div>
                </div>

                <!-- Event Content -->
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $event->nom }}</h3>
                    
                    <!-- Date Section -->
                    <div class="flex items-center gap-2 text-sm text-gray-600 bg-gray-100 p-3 rounded-lg mb-3">
                        <i class="fas fa-calendar-alt text-blue-600"></i>
                        <span>
                            {{ \Carbon\Carbon::parse($event->dateDebut)->format('d M Y') }}
                            @if($event->dateDebut != $event->dateFin)
                                - {{ \Carbon\Carbon::parse($event->dateFin)->format('d M Y') }}
                            @endif
                        </span>
                    </div>

                    <!-- Location Section -->
                    <div class="flex items-center gap-2 text-sm text-gray-600 bg-gray-100 p-3 rounded-lg mb-3">
                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                        <span>{{ $event->adresse->adresse_complete ?? 'Online Event' }}</span>
                    </div>

                    <!-- Budget Section -->
                    <div class="flex items-center gap-2 text-sm font-semibold text-gray-700 bg-gray-100 p-3 rounded-lg mb-4">
                        <i class="fas fa-euro-sign text-blue-600"></i>
                        <span>{{ number_format($event->budget, 0, ',', ' ') }}€</span>
                    </div>

                    <!-- Organization Info -->
                    @if($event->associations->count() > 0)
                    <div class="flex items-center gap-2 text-sm text-gray-700 bg-gray-100 p-3 rounded-lg mb-4">
                         <i class="fas fa-building text-blue-600"></i>
                         <span>Organisé par {{ $event->associations->first()->nom }}</span>
                    </div>
                    @endif

                    <!-- Action Button -->
                    <div class="text-right">
                        <a href="#" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-eye"></i>
                            {{ __('messages.learn_more') }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="col-span-full text-center py-16">
                <div class="bg-blue-500 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-calendar-alt text-4xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Aucun événement</h3>
                <p class="text-gray-600 mb-6 text-lg">{{ __('messages.no_events') }}</p>
            </div>
        @endforelse
        </div>
    </div>
</div>

@endsection