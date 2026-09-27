<section class="header-section py-20">
    <div class="container mx-auto px-4 py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ __('messages.welcome_title') }}</h1>
        <p class="text-xl mb-10 max-w-3xl mx-auto">{{ __('messages.welcome_subtitle') }}</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('login') }}" class="btn-primary px-8 py-3 rounded-full text-lg font-medium">
                {{ __('messages.login') }}
            </a>
            <a href="{{ route('register') }}" class="btn-secondary px-8 py-3 rounded-full text-lg font-medium">
                {{ __('messages.register') }}
            </a>
        </div>
    </div>
</section>
