<?php

namespace App\Http\Controllers;

use App\Models\PostulationImam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostulationImamController extends Controller
{
    /**
     * Liste des demandes pour l'admin
     */
    public function index()
    {
        $postulations = PostulationImam::with('utilisateur')->get();
        return view('chefmosque.demande_imam', compact('postulations'));
    }
    
    public function mesPostulations()
    {
        $user = Auth::user();
    
        $postulations = PostulationImam::where('user_id', $user->id)->get();
    
        return view('voir_postulation_imam', compact('postulations'));
    }
    /**
     * Affiche le formulaire de postulation (pour un adhérent)
     */
    public function create()
    {
        $user = Auth::user();
        
        // Vérifier si l'utilisateur a déjà une postulation en cours
        if (PostulationImam::where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'Vous avez déjà une demande en cours.');
        }
        
        // Vérifier si l'utilisateur est déjà imam ou chef de mosquée
        if (in_array($user->role, ['imam', 'chef'])) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas postuler car vous êtes déjà ' . ($user->role === 'imam' ? 'imam' : 'chef de mosquée') . '.');
        }

        return view('postulation_imam');
    }

    /**
     * Enregistre une nouvelle postulation
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Vérifications de sécurité supplémentaires
        if (PostulationImam::where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'Vous avez déjà soumis une demande.');
        }
        
        if (in_array($user->role, ['imam', 'chef','président'])) {
            return redirect()->back()->with('error', 'Vous n’êtes pas autorisé à postuler.');
        }

        $request->validate([
            'motivations' => 'required|string|min:10',
            'experience' => 'required|string|min:10',
        ]);

        PostulationImam::create([
            'user_id' => $user->id,
            'motivations' => $request->motivations,
            'experience' => $request->experience,
            'statut' => 'en_attente',
        ]);

        return redirect()->back()->with('success', 'Votre demande a été envoyée.');
    }

    /**
     * Met à jour le statut (acceptation ou refus)
     */
    public function updateStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:validé,refusé,en_attente',
            'motif_refus' => 'required_if:statut,refusé|nullable|string|max:255',
        ]);

        $postulation = PostulationImam::findOrFail($id);
        $postulation->statut = $request->statut;

        if ($request->statut === 'validé') {
            $utilisateur = $postulation->utilisateur;
            // Mettre à jour le rôle de l'utilisateur
            $utilisateur->role = 'imam';
            $utilisateur->save();
        }

        if ($request->statut === 'refusé') {
            $postulation->motif_refus = $request->motif_refus;
        } else {
            $postulation->motif_refus = null;
        }

        $postulation->save();

        return redirect()->back()->with('success', 'Statut mis à jour.');
    }

    /**
     * Supprime une postulation
     */
    public function destroy($id)
    {
        $postulation = PostulationImam::findOrFail($id);
        $postulation->delete();

        return redirect()->back()->with('success', 'Postulation supprimée avec succès.');
    }
}