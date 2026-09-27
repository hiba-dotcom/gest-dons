<section id="community" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12 section-title mx-auto">{{ __('messages.community_title') }}</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Community Card 1 -->
            <div class="card bg-white overflow-hidden">
                <div class="h-48 bg-gray-200 relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1594839690555-c0e71e246eb0?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="{{ __('messages.community_events') }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <h3 class="text-xl font-bold text-white absolute bottom-4 left-4">{{ __('messages.community_events') }}</h3>
                </div>
                <div class="p-5">
                    <p class="text-gray-600 mb-4">{{ __('messages.community_events_desc') }}</p>
                    <a href="#" class="text-accent-color font-medium hover:underline inline-flex items-center">
                        {{ __('messages.learn_more') }}
                        <span class="ml-1"><i class="fas fa-arrow-right text-sm"></i></span>
                    </a>
                </div>
            </div>
            
            <!-- Community Card 2 -->
            <div class="card bg-white overflow-hidden">
                <div class="h-48 bg-gray-200 relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1560523159-4a9692d222f9?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="{{ __('messages.community_classes') }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <h3 class="text-xl font-bold text-white absolute bottom-4 left-4">{{ __('messages.community_classes') }}</h3>
                </div>
                <div class="p-5">
                    <p class="text-gray-600 mb-4">{{ __('messages.community_classes_desc') }}</p>
                    <a href="#" class="text-accent-color font-medium hover:underline inline-flex items-center">
                        {{ __('messages.learn_more') }}
                        <span class="ml-1"><i class="fas fa-arrow-right text-sm"></i></span>
                    </a>
                </div>
            </div>
            
            <!-- Community Card 3 -->
            <div class="card bg-white overflow-hidden">
                <div class="h-48 bg-gray-200 relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1593113630400-ea4288922497?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="{{ __('messages.community_support') }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <h3 class="text-xl font-bold text-white absolute bottom-4 left-4">{{ __('messages.community_support') }}</h3>
                </div>
                <div class="p-5">
                    <p class="text-gray-600 mb-4">{{ __('messages.community_support_desc') }}</p>
                    <a href="#" class="text-accent-color font-medium hover:underline inline-flex items-center">
                        {{ __('messages.learn_more') }}
                        <span class="ml-1"><i class="fas fa-arrow-right text-sm"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
