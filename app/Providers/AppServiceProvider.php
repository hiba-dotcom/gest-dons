<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use App\Models\Association;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        // Set the application locale from session
        $this->setLocaleFromSession();

        // Make associations available in the donation view
        View::composer('sections.welcome.donation', function ($view) {
            $view->with('associations', Association::all());
        });
    }
    
    /**
     * Set the application locale from session
     */
    protected function setLocaleFromSession(): void
    {
        // Check if session has locale
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            
            // Verify it's a supported locale
            $supportedLocales = ['en', 'fr', 'ar'];
            
            if (in_array($locale, $supportedLocales)) {
                App::setLocale($locale);
            }
        }
    }
}
