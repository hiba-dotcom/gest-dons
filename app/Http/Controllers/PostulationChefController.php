<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostulationChef;
use App\Models\Mosquee;
use Illuminate\Support\Facades\Auth;

class PostulationChefController extends Controller
{

    public function afficherDemandesPourPresident()
    {
        $postulations = PostulationChef::with('utilisateur', 'mosquee')->get();
        return view('president.demande_chef', compact('postulations'));
    }

    // Affiche le formulaire de postulation pour une mosquée donnée
    public function create($mosquee_id)
    {
        $utilisateur = Auth::user();

        // Empêcher les rôles non autorisés
        if (in_array($utilisateur->role, ['chefDeMosquee', 'imam', 'président'])) {
            return redirect()->route('mosquees')
                ->with('error', 'Vous n’êtes pas autorisé à postuler.');
        }

        // Vérifier que l'utilisateur a déjà une postulation en attente ou validée
        $existing = PostulationChef::where('utilisateur_id', $utilisateur->id)
            ->whereIn('statut', ['en_attente', 'validé'])
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Vous avez déjà une postulation en cours.');
        }

        $mosquee = Mosquee::findOrFail($mosquee_id);

        if ($mosquee->chef_id) {
            return redirect()->back()->with('error', 'Vous n’êtes pas autorisé à postuler.');
        }

        return view('postulation_chef', compact('mosquee'));
    }

    // Enregistre la postulation dans la base
    public function store(Request $request, $mosquee_id)
    {
        $request->validate([
            'motivations' => 'required|string',
            'experiences' => 'required|string',
        ]);

        $mosquee = Mosquee::findOrFail($mosquee_id);

        if ($mosquee->chef_id) {
            return redirect()->route('mosquees.index')
                ->with('error', 'Cette mosquée a déjà un chef, vous ne pouvez pas postuler.');
        }

        PostulationChef::create([
            'utilisateur_id' => Auth::id(),
            'mosquee_id' => $mosquee_id,
            'motivations' => $request->motivations,
            'experiences' => $request->experiences,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('mes_postulations')->with('success', 'Votre postulation a bien été envoyée.');
    }

    // Liste des postulations de l'utilisateur connecté
    public function index()
    {
        $postulations = PostulationChef::with('mosquee')
            ->where('utilisateur_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mes_postulations', compact('postulations'));
    }

    public function updateStatut(Request $request, $id)
    {
        $postulation = PostulationChef::findOrFail($id);
        $postulation->statut = $request->statut;
        $postulation->save();

        // Si la postulation est validée
        if ($request->statut === 'validé') {
            $utilisateur = $postulation->utilisateur;
            $mosquee = $postulation->mosquee;

            // Mettre à jour le rôle de l'utilisateur
            $utilisateur->role = 'chefDeMosquee';
            $utilisateur->save();

            // Associer l'utilisateur comme chef de la mosquée
            $mosquee->chef_id = $utilisateur->id;
            $mosquee->save();
        }

        return redirect()->back()->with('success', 'Statut mis à jour avec succès');
    }


    public function destroy($id)
    {
        $postulation = PostulationChef::findOrFail($id);
        $postulation->delete();

        return redirect()->back()->with('success', 'Postulation supprimée avec succès.');
    }

    public function filterByStatut($statut = null)
    {
        if ($statut && in_array($statut, ['en_attente', 'validé', 'refusé'])) {
            $postulations = PostulationChef::with('utilisateur', 'mosquee')
                ->where('statut', $statut)
                ->get();
        } else {
            $postulations = PostulationChef::with('utilisateur', 'mosquee')->get();
        }

        return view('president.demande_chef', compact('postulations'));
    }

}
