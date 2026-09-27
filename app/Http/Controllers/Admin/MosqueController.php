<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mosquee;

class MosqueController extends Controller
{
    /**
     * Display a listing of the mosques.
     *
     * @return \Illuminate\View\View
     */    public function index()
    {
        // Fetch mosques with pagination for better performance
        $mosques = Mosquee::paginate(10);

        return view('admin.mosques', compact('mosques'));
    }

    // You can add other methods here for creating, editing, deleting mosques
} 