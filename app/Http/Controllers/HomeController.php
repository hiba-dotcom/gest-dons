<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mosquee;
use App\Models\Evenement;

class HomeController extends Controller
{
    public function index()
    {
        $mosquees = Mosquee::with('chef', 'adresse')
            ->latest()
            ->take(3)
            ->get();

        $evenements = Evenement::with('adresse')
            ->latest()
            ->take(3)
            ->get();

        $coursController = new CoursController();
        $cours = $coursController->getCoursForHomePage();
        return view('welcome', compact('mosquees' , 'cours' , 'evenements'));
    }
}
