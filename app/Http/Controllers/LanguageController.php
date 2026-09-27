<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Cache;

class LanguageController extends Controller
{
    /**
     * Change the application language.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLanguage(Request $request, $locale)
    {
        // Log the language change request
        Log::info('Language change requested', ['locale' => $locale]);
        
        // Check if the language is supported
        $supportedLocales = ['fr', 'en', 'ar'];
        
        if (in_array($locale, $supportedLocales)) {
            // Clear any cached locale
            Cache::forget('app.locale');
            
            // Set the locale in session
            Session::put('locale', $locale);
            App::setLocale($locale);
            
            // Create a cookie that will last for 1 year
            $cookie = Cookie::make('locale', $locale, 60 * 24 * 365);
            
            // Log success
            Log::info('Language changed successfully', ['locale' => $locale]);
            
            // If the request expects a JSON response (AJAX request)
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'locale' => $locale,
                    'message' => 'Language changed successfully'
                ]);
            }
            
            // Redirect back with the cookie and a success message
            return redirect()->back()
                ->withCookie($cookie)
                ->with('success', 'Language changed successfully');
        }
        
        // Log error
        Log::warning('Invalid locale requested', ['locale' => $locale]);
        
        // Redirect back with error message
        return redirect()->back()->with('error', 'Invalid language selected');
    }
}
