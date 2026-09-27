@extends('admin/adminLayout')
@section('donations')
<header class="bg-white shadow-sm border-b">
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center">
            <button id="mobile-menu-btn" class="md:hidden mr-4 text-gray-600">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-2xl font-bold text-gray-800">{{__('messages.donations')}}</h1>
        </div>
    </div>
</header>

<main class="p-6">
    <div class="card p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold">Liste des donations</h2>
            <div class="flex space-x-4">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search" placeholder="Search donations..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <select id="status-filter" class="rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">{{__('messages.all')}}</option>
                    <option value="pending">{{__('messages.pending')}}</option>
                    <option value="completed">{{__('messages.completed')}}</option>
                    <option value="failed">{{__('messages.failed')}}</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{__('messages.donor')}}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{__('messages.association')}}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{__('messages.date')}}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{__('messages.amount')}}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{__('messages.status')}}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{__('messages.action')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($donations as $donation)
                        @php
                            $rowClass = '';
                            switch ($donation->status) {
                                case 'Validé':
                                    $rowClass = 'bg-green-50 hover:bg-green-100';
                                    break;
                                case 'En attente':
                                    $rowClass = 'bg-yellow-50 hover:bg-yellow-100';
                                    break;
                                case 'Refusé':
                                    $rowClass = 'bg-red-50 hover:bg-red-100';
                                    break;
                                default:
                                    $rowClass = 'hover:bg-gray-100'; // Default hover effect
                                    break;
                            }
                        @endphp
                        <tr class="{{ $rowClass }}">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $donation->user->firstname ?? '' }} {{ $donation->user->lastname ?? '' }}</p>
                                        <p class="text-gray-500 text-xs">{{ $donation->user->email ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $donation->association->nom ?? 'N/A' }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $donation->created_at->format('d/m/Y H:i') }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap font-semibold">{{ number_format($donation->amount, 2) }} €</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @php
                                    $statusBgClass = '';
                                    $statusDotClass = '';
                                    $statusTextClass = 'text-gray-800';

                                    switch ($donation->status) {
                                        case 'Validé':
                                            $statusBgClass = 'bg-green-100';
                                            $statusDotClass = 'bg-green-600';
                                            $statusTextClass = 'text-green-800';
                                            break;
                                        case 'En attente':
                                            $statusBgClass = 'bg-yellow-100';
                                            $statusDotClass = 'bg-yellow-600';
                                             $statusTextClass = 'text-yellow-800';
                                            break;
                                        case 'Refusé':
                                            $statusBgClass = 'bg-red-100';
                                            $statusDotClass = 'bg-red-600';
                                            $statusTextClass = 'text-red-800';
                                            break;
                                        default:
                                            $statusBgClass = 'bg-gray-100';
                                            $statusDotClass = 'bg-gray-600';
                                            $statusTextClass = 'text-gray-800';
                                            break;
                                    }
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full font-semibold {{$statusBgClass}} {{$statusTextClass}}">
                                    <span class="h-2 w-2 rounded-full {{$statusDotClass}} mr-2"></span>
                                    {{ $donation->status }}
                                </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.donations.show', $donation) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this donation?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{__('messages.no_donations')}}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $donations->links() }}
        </div>
    </div>
</main>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const statusFilter = document.getElementById('status-filter');
        
        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusValue = statusFilter.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const donorName = row.querySelector('td:first-child').textContent.toLowerCase();
                const status = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                
                const matchesSearch = donorName.includes(searchTerm);
                const matchesStatus = !statusValue || status.includes(statusValue);
                
                row.style.display = matchesSearch && matchesStatus ? '' : 'none';
            });
        }
        
        searchInput.addEventListener('input', applyFilters);
        statusFilter.addEventListener('change', applyFilters);
    });
</script>
@endpush
@endsection 