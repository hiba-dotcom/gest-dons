<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $supportedLocales = ['en', 'fr', 'ar']; // Add your supported locales here
        // First check session
        if (Session::has('locale')) {
            $locale = Session::get('locale');
            if (in_array($locale, $supportedLocales)) {
                App::setLocale($locale);
            }
        }
        // Then check cookie
        elseif ($request->cookie('locale')) {
            $locale = $request->cookie('locale');
            if (in_array($locale, $supportedLocales)) {
                App::setLocale($locale);
                // Also set it in session for consistency
                Session::put('locale', $locale);
            }
        }
        // If neither exists, use the default locale from config
        else {
            App::setLocale(config('app.locale'));
        }
        
        return $next($request);
    }
}
