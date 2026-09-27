<section id="cta" class="py-20 bg-primary-color text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-6">{{ __('messages.cta_title') }}</h2>
        <p class="text-xl mb-10 max-w-3xl mx-auto opacity-90">{{ __('messages.cta_subtitle') }}</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('register') }}" class="px-8 py-3 bg-accent-color text-white rounded-full text-lg font-medium hover:bg-accent-color/90 transition-all transform hover:-translate-y-1 hover:shadow-lg">
                {{ __('messages.get_started') }}
            </a>
            <a href="#contact" class="px-8 py-3 bg-white text-primary-color rounded-full text-lg font-medium hover:bg-gray-100 transition-all transform hover:-translate-y-1 hover:shadow-lg">
                {{ __('messages.contact_us') }}
            </a>
        </div>
    </div>
</section>
