<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\Pool;

class QuranController extends Controller
{
    protected $baseUrl = 'https://api.alquran.cloud/v1';
    protected $cacheTime = 86400; // 24 heures en secondes

    public function index()
    {
        try {
            $sourates = Cache::remember('all_sourates', $this->cacheTime, function () {
                $response = Http::timeout(15)->get("{$this->baseUrl}/surah");
                

                if (!$response->successful()) {
                    throw new \Exception("Failed to fetch surah list");
                }

                return $response->json()['data'] ?? [];
            });

            return view('coran', [
                'sourates' => $sourates,
                'sourate' => null,
                'versets' => [],
                'results' => [],
                'queryText' => null,
            ]);
        } catch (\Exception $e) {
            report($e);
            return back()->with('error', 'Impossible de charger la liste des sourates. Veuillez réessayer plus tard.');
        }
    }

    public function showSourate($id)
    {
        $request = request();
        $request->validate([
            'id' => 'sometimes|integer|between:1,114'
        ]);

        try {
            $cacheKey = "surah_{$id}_data";
            $data = Cache::remember($cacheKey, $this->cacheTime, function () use ($id) {
                $responses = Http::pool(fn (Pool $pool) => [
                    $pool->get("{$this->baseUrl}/surah/{$id}/ar.alafasy"),
                    $pool->get("{$this->baseUrl}/surah/{$id}/en.sahih"),
                    $pool->get("{$this->baseUrl}/surah/{$id}/fr.hamidullah")
                ]);

                if (!$responses[0]->successful() || !$responses[1]->successful()) {
                    throw new \Exception("Failed to fetch surah data");
                }

                $arabicAyahs = $responses[0]->json()['data']['ayahs'];
                $englishAyahs = $responses[1]->json()['data']['ayahs'];
                $frenchAyahs = $responses[2]->successful() ? $responses[2]->json()['data']['ayahs'] : [];

                return [
                    'sourate' => $responses[0]->json()['data'],
                    'versets' => $this->mapAyahs($arabicAyahs, $englishAyahs, $frenchAyahs)
                ];
            });

            return view('coran', [
                'sourate' => $data['sourate'],
                'versets' => $data['versets'],
                'sourates' => [],
                'results' => [],
                'queryText' => null,
            ]);
        } catch (\Exception $e) {
            report($e);
            return back()->with('error', 'Erreur lors du chargement de la sourate. Veuillez réessayer.');
        }
    }

    protected function mapAyahs($arabicAyahs, $englishAyahs, $frenchAyahs = [])
    {
        return collect($arabicAyahs)->map(function ($ayah, $index) use ($englishAyahs, $frenchAyahs) {
            return [
                'numberInSurah' => $ayah['numberInSurah'],
                'text_arabic' => $ayah['text'],
                'text_english' => $englishAyahs[$index]['text'] ?? '',
                'text_french' => $frenchAyahs[$index]['text'] ?? '',
                'audio' => $ayah['audio'] ?? null,
            ];
        });
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2|max:100'
        ]);

        $queryText = trim($request->input('query'));

        // Alternative API endpoint
        $response = Http::get("https://api.alquran.cloud/v1/search/{$queryText}/all/fr.hamidullah");

        // Fallback option
        if (!$response->successful()) {
            $response = Http::get("https://quran-api-id.vercel.app/api/search?q={$queryText}&language=fr");
        }

        $results = [];

        if ($response->successful()) {
            $data = $response->json();

            // Handle different API response formats
            $matches = $data['data']['matches'] ?? $data['matches'] ?? $data['results'] ?? [];

            foreach ($matches as $match) {
                $results[] = [
                    'verse_key' => $match['surah']['number'] . ':' . $match['numberInSurah']
                        ?? $match['verse_key']
                        ?? $match['surah_number'] . ':' . $match['verse_number'],
                    'text_uthmani' => $match['text']['arabic'] ?? $match['arabic_text'] ?? '',
                    'translation' => $match['text']['translation'] ?? $match['translation'] ?? '',
                    'audio_url' => $match['audio'] ?? $match['audio_url'] ?? null,
                    'surah_name' => $match['surah']['name'] ?? $match['surah_name'] ?? '',
                ];
            }
        }

        return view('coran', [
            'results' => $results,
            'queryText' => $queryText,
            'sourates' => [],
            'sourate' => null,
            'versets' => [],
        ]);
    }
    public function suggestSourates(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string|max:50'
        ]);

        $query = strtolower($request->input('q', ''));
        $cacheKey = 'suggest_' . ($query ? md5($query) : 'default');

        return Cache::remember($cacheKey, 3600, function () use ($query) {
            $response = Http::get("{$this->baseUrl}/surah");

            if (!$response->successful()) return [];

            $all = $response->json()['data'] ?? [];

            return $query !== ''
                ? collect($all)
                ->filter(function ($s) use ($query) {
                    return str_starts_with(strtolower($s['englishName']), $query) ||
                        str_starts_with(strtolower($s['name']), $query);
                })
                ->take(8)
                ->values()
                ->all()
                : collect($all)
                ->take(8)
                ->values()
                ->all();
        });
    }

    public function getAyahAudio($surahId, $ayahNumber)
    {
        try {
            $response = Http::timeout(10)
                ->get("{$this->baseUrl}/ayah/{$surahId}:{$ayahNumber}/ar.alafasy");

            if (!$response->successful()) {
                return response()->json(['error' => 'Audio not found'], 404);
            }

            $audioUrl = $response->json()['data']['audio'] ?? null;

            return $audioUrl
                ? response()->json(['audio_url' => $audioUrl])
                : response()->json(['error' => 'Audio not available'], 404);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }
}

