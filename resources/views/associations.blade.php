@extends('layout')

@section('associations')
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

<style>
    .association-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .association-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .association-image {
        height: 200px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .association-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.8), rgba(59, 130, 246, 0.6));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .association-card:hover .association-image::before {
        opacity: 1;
    }

    .stat-item {
        background: linear-gradient(135deg, var(--accent-color), #059669);
        color: white;
        padding: 12px;
        border-radius: 12px;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .stat-item:hover {
        transform: scale(1.05);
    }

    .slogan {
        font-style: italic;
        color: var(--secondary-color);
        position: relative;
    }

    .slogan::before {
        content: '"';
        font-size: 2rem;
        color: var(--accent-color);
        position: absolute;
        left: -15px;
        top: -5px;
    }

    .slogan::after {
        content: '"';
        font-size: 2rem;
        color: var(--accent-color);
        position: absolute;
        right: -15px;
        bottom: -15px;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('https://images.unsplash.com/photo-1542816417-0983c9c9ad53?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
        background-size: cover;
        background-position: center;
        opacity: 0.1;
        z-index: 1;
    }

    .page-header>div {
        position: relative;
        z-index: 2;
    }
</style>

<!-- Page Header -->
<section class="page-header">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-6">{{ __('messages.associations_page_title') }}</h1>
        <p class="text-xl opacity-90 max-w-3xl mx-auto">{{ __('messages.associations_page_subtitle') }}</p>
    </div>
</section>

<!-- Association Section -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($associations as $association)
            <!-- Association Card -->
            <div class="association-card">
                <div class="association-image" style="background-image: url('{{$association->image}}');">
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-3 text-gray-800">{{$association->nom}}</h3>
                    <p class="slogan text-sm mb-4 pl-4 pr-4">{{$association->slogan}}</p>
                    <p class="text-gray-600 mb-4 leading-relaxed">{{$association->description}}</p>

                    <div class="mb-4">
                        <p class="text-sm text-gray-500 mb-1">{{ __('messages.president') }}</p>
                        <p class="font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-user-tie mr-2 text-blue-600"></i>
                        {{$association->postulation->president->firstname}} {{$association->postulation->president->lastname}}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mt-6">
                        <div class="stat-item">
                            <div class="text-2xl font-bold">12</div>
                            <div class="text-xs uppercase tracking-wide">{{ __('messages.mosques') }}</div>
                        </div>
                        <div class="stat-item">

                            <div class="text-2xl font-bold">{{$association->evenements->count()}}</div>
                            <div class="text-xs uppercase tracking-wide">{{ __('messages.events') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>

    </div>

</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-r from-blue-900 to-blue-700">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-white mb-6">{{ __('messages.join_associations_title') }}</h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">{{ __('messages.join_associations_subtitle') }}</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{route('create')}}" class="inline-block bg-white text-blue-800 px-8 py-4 rounded-full font-semibold hover:bg-blue-50 transition duration-300">{{ __('messages.apply') }}</a>
            <a href="/faire-un-don" class="inline-block border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-blue-800 transition duration-300">{{ __('messages.donate') }}</a>
        </div>
    </div>
</section>


@endsection