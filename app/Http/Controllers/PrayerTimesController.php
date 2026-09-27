<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PrayerTimesController extends Controller
{
    /**
     * Display the prayer times view
     */
    public function index(Request $request)
    {
        return view('components.prayer-times');
    }
    
    /**
     * Get prayer times from the API
     */
    public function getPrayerTimes(Request $request)
    {
        // Get location parameters
        $latitude = $request->input('latitude', 21.4225); // Default to Mecca
        $longitude = $request->input('longitude', 39.8262);
        $method = $request->input('method', 2); // Default to Islamic Society of North America
        
        // Get current date
        $now = Carbon::now();
        $day = $now->day;
        $month = $now->month;
        $year = $now->year;
        
        // Get prayer times from API
        $prayerTimesResponse = Http::get("https://api.aladhan.com/v1/timings/{$day}-{$month}-{$year}", [
            'latitude' => $latitude,
            'longitude' => $longitude,
            'method' => $method
        ]);

        // Initialize response data
        $responseData = [];
        $status = 200;

        if ($prayerTimesResponse->successful()) {
            $prayerData = $prayerTimesResponse->json();
            
            // Make sure response is valid
            if ($prayerData['code'] === 200 && isset($prayerData['data'])) {
                // Get current prayer time
                $currentPrayer = $this->getCurrentPrayer($prayerData['data']['timings'], $now->format('H:i'));
                
                // Base response with prayer times
                $responseData = [
                    'timings' => $prayerData['data']['timings'],
                    'current_prayer' => $currentPrayer,
                    'date' => [
                        'gregorian' => $prayerData['data']['date']['gregorian']['date'],
                        'hijri' => $prayerData['data']['date']['hijri']['day'],
                        'hijri_month' => $prayerData['data']['date']['hijri']['month']['en'],
                        'hijri_year' => $prayerData['data']['date']['hijri']['year']
                    ],
                    'meta' => [
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'method' => $prayerData['data']['meta']['method']['name']
                    ]
                ];
            } else {
                $status = 500;
                $responseData = ['error' => 'Invalid API response format'];
            }
        } else {
            $status = 500;
            $responseData = ['error' => 'Failed to fetch prayer times from API'];
        }

        return response()->json($responseData, $status);
    }

    private function getCurrentPrayer($timings, $currentTime)
    {
        // Define all prayer times
        $prayers = [
            'Fajr',
            'Sunrise',
            'Dhuhr',
            'Asr',
            'Maghrib',
            'Isha'
        ];
        
        // Convert current time to minutes
        $currentMinutes = $this->timeToMinutes($currentTime);
        
        // Create an array of prayer times with their minute values
        $prayerMinutes = [];
        foreach ($prayers as $prayer) {
            if (isset($timings[$prayer])) {
                $prayerMinutes[] = [
                    'prayer' => $prayer,
                    'minutes' => $this->timeToMinutes($timings[$prayer])
                ];
            }
        }
        
        // Add next day Fajr
        $prayerMinutes[] = [
            'prayer' => 'Fajr',
            'minutes' => $this->timeToMinutes($timings['Fajr']) + 1440 // 24 hours in minutes
        ];
        
        // Sort prayer times by minutes
        usort($prayerMinutes, function($a, $b) {
            return $a['minutes'] - $b['minutes'];
        });
        
        // Find current prayer
        for ($i = 0; $i < count($prayerMinutes) - 1; $i++) {
            if ($currentMinutes >= $prayerMinutes[$i]['minutes'] && $currentMinutes < $prayerMinutes[$i + 1]['minutes']) {
                return $prayerMinutes[$i]['prayer'];
            }
        }
        
        // Default to first prayer if we couldn't determine the current prayer
        return $prayerMinutes[0]['prayer'];
    }

    private function timeToMinutes($time)
    {
        list($hours, $minutes) = explode(':', $time);
        return $hours * 60 + $minutes;
    }

    private function getNextDayFajr($currentFajr)
    {
        list($hours, $minutes) = explode(':', $currentFajr);
        $hours = (int)$hours + 24;
        return sprintf('%02d:%02d', $hours, $minutes);
    }
}
