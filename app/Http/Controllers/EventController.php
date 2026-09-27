<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Evenement::with(['adresse', 'associations'])
            // ->where('dateDebut', '>=', now())
            ->orderBy('dateDebut', 'asc')
            ->get();

        return view('evenements', [
            'events' => $events
        ]);
    }
}
