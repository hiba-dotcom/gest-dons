<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mosquee;
use App\Models\MosqueeAdresse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MosqueeController extends Controller
{
    public function index()
    {
        $mosquees = Mosquee::with(['chef', 'adresse'])->get();
        $chefs = User::where('role', 'chefDeMosquee')->get();
        return view('president.gest_mosquees', compact('mosquees', 'chefs'));
    }

    public function indexAll()
    {
        $mosquees = Mosquee::with('chef', 'adresse')


            ->get();
        return view('mosquees', compact('mosquees'));
    }

    public function create()
    {
        $chefs = User::where('role', 'chefDeMosquee')->get();
        return view('president.gest_mosquees.create', compact('chefs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'chef_id' => 'nullable|exists:users,id',
            'boulevard' => 'required|string',
            'ville' => 'required|string',
            'pays' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('public/mosquees');
        $validated['image'] = str_replace('public/', 'storage/', $imagePath);

        $adresse = MosqueeAdresse::create([
            'boulevard' => $validated['boulevard'],
            'ville' => $validated['ville'],
            'pays' => $validated['pays'],
        ]);

        Mosquee::create([
            'name' => $validated['name'],
            'image' => $validated['image'] ?? null,
            'chef_id' => $validated['chef_id'] ?? null,
            'adresse_id' => $adresse->id,
        ]);

        return redirect()->route('gest_mosquees.index')->with('success', 'Mosquée créée avec succès.');
    }

    public function edit(Mosquee $mosquee)
    {
        $mosquees = Mosquee::with(['chef', 'adresse'])->get();
        $chefs = User::where('role', 'chefDeMosquee')->get();
        return view('president.edit', compact('mosquee', 'chefs')); //ligne modifié

    }

    public function update(Request $request, Mosquee $mosquee)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'chef_id' => 'nullable|exists:users,id',
            'boulevard' => 'required|string',
            'ville' => 'required|string',
            'pays' => 'required|string',
        ]);

        $mosquee->adresse->update([
            'boulevard' => $validated['boulevard'],
            'ville' => $validated['ville'],
            'pays' => $validated['pays'],
        ]);

        // Gestion de l'image seulement si un nouveau fichier a été uploadé
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si tu veux (optionnel)
            if ($mosquee->image && file_exists(public_path($mosquee->image))) {
                unlink(public_path($mosquee->image));
            }

            // Stocker la nouvelle image
            $imagePath = $request->file('image')->store('public/mosquees');
            $imagePath = str_replace('public/', 'storage/', $imagePath);

            $mosquee->update([
                'name' => $validated['name'],
                'image' => $imagePath,
                'chef_id' => $validated['chef_id'] ?? null,
            ]);
        } else {
            // Mise à jour sans changer l'image
            $mosquee->update([
                'name' => $validated['name'],
                'chef_id' => $validated['chef_id'] ?? null,
            ]);
        }

        return redirect()->route('gest_mosquees.index')->with('success', 'Mosquée mise à jour.');
    }



    public function destroy(Mosquee $mosquee)
    {
        $mosquee->adresse->delete();
        $mosquee->delete();
        return redirect()->route('gest_mosquees.index')->with('success', 'Mosquée supprimée.');
    }

    public function listeMosquees()
    {
        $mosquees = Mosquee::with('chef', 'adresse')->get();

        // Vérifier si l'utilisateur est déjà chef d'une mosquée
        $utilisateurEstDejaChef = Mosquee::where('chef_id', Auth::id())->exists();

        return view('mosquees', compact('mosquees', 'utilisateurEstDejaChef'));
    }

    public function voirMosquees()
    {
        $mosquees = Mosquee::with('adresse')->get(); // Récupère toutes les mosquées avec leur adresse
        return view('voir_mosquees', compact('mosquees'));
}
}
