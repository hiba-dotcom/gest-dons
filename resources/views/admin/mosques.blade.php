@extends('admin/adminLayout')
@section('mosques')

<header class="bg-white shadow-sm border-b">
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center">
            <button id="mobile-menu-btn" class="md:hidden mr-4 text-gray-600">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-2xl font-bold text-gray-800">{{__('messages.mosques')}}</h1>
        </div>
    </div>
</header>

<main class="p-6">
    <div class="card p-6">
        <h2 class="text-xl font-bold mb-6">{{__('messages.list_of_mosques')}}</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{__('messages.name')}}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{__('messages.location')}}
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{__('messages.capacity')}}
                        </th>
                         <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            {{__('messages.action')}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mosques as $mosque)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $mosque->name }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $mosque->location }}</p>
                            </td>
                             <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $mosque->capacity }}</p>
                            </td>
                             <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex space-x-2">
                                    {{-- Add links for view, edit, delete here later --}}
                                    <span class="text-gray-500">Actions TBD</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                {{__('messages.no_mosques_found')}}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>        <div class="mt-4">
            {{ $mosques->links() }}
        </div>
    </div>
</main>

@endsection