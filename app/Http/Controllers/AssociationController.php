<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    public function index()
    {
        $associations = Association::whereHas('postulation', function ($query) {
            $query->where('statut', 'validé');
        })->get();
        return view('associations', ['associations' => $associations]);
    }

    public function create()
    {
        return view('/AssociationPostulation');
    }
}
