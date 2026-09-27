@extends('admin/adminLayout')
@section('donations')
<header class="bg-white shadow-sm border-b">
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center">
            <a href="{{ route('admin.donations') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Donation Details</h1>
        </div>
    </div>
</header>

<main class="p-6">
    <div class="card p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Donation Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Donation Information</h2>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-600">Amount</label>
                        <p class="text-lg font-semibold">{{ number_format($donation->amount, 2) }} €</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Status</label>
                        <p class="text-lg">
                            @php
                                $statusClass = '';
                                switch ($donation->status) {
                                    case 'completed':
                                        $statusClass = 'bg-green-200 text-green-800';
                                        break;
                                    case 'pending':
                                        $statusClass = 'bg-yellow-200 text-yellow-800';
                                        break;
                                    case 'failed':
                                        $statusClass = 'bg-red-200 text-red-800';
                                        break;
                                    default:
                                        $statusClass = 'bg-gray-200 text-gray-800';
                                        break;
                                }
                            @endphp
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                                {{ ucfirst($donation->status) }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Date</label>
                        <p class="text-lg">{{ $donation->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Donor Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Donor Information</h2>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-600">Name</label>
                        <p class="text-lg">{{ $donation->user->firstname }} {{ $donation->user->lastname }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <p class="text-lg">{{ $donation->user->email }}</p>
                    </div>
                    @if($donation->user->phone)
                    <div>
                        <label class="text-sm text-gray-600">Phone</label>
                        <p class="text-lg">{{ $donation->user->phone }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Association Information -->
            @if($donation->association)
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold mb-4">Association Information</h2>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-600">Name</label>
                        <p class="text-lg">{{ $donation->association->nom }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="mt-6 flex justify-end space-x-4">
            <form action="{{ route('admin.donations.update-status', $donation) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <select name="status" class="rounded-lg border-gray-300" onchange="this.form.submit()">
                    <option value="pending" {{ $donation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $donation->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="failed" {{ $donation->status === 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </form>

            <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this donation?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                    Delete
                </button>
            </form>
        </div>
    </div>
</main>
@endsection 