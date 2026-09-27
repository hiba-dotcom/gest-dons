<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Adresse;
use App\Models\Association;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index()
    {
        $evenements = Evenement::with('adresse')->get();
        $adresses = Adresse::all();
        $associations = Association::all();

        return view('president.evenement', compact('evenements', 'adresses', 'associations'));
    }

    public function afficherListe()
    {
        $evenements = Evenement::with('adresse')->get();
        $adresses = Adresse::all();
        $associations = Association::all();

        return view('event', compact('evenements', 'adresses', 'associations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'budget' => 'required|numeric',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
            'boulevard' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'association_id' => 'required|exists:associations,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $adresse = Adresse::create([
                'boulevard' => $validated['boulevard'],
                'ville' => $validated['ville'],
                'pays' => $validated['pays'],
            ]);

            $evenementData = [
                'nom' => $validated['nom'],
                'budget' => $validated['budget'],
                'dateDebut' => $validated['dateDebut'],
                'dateFin' => $validated['dateFin'],
                'lieu_id' => $adresse->id,
                'association_id' => $validated['association_id'],
                'description' => $validated['description'] ?? null,
            ];

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $evenementData['image'] = $request->file('image')->store('images', 'public');
            }

            Evenement::create($evenementData);

            return redirect()->route('president.evenements.index')->with('success', 'Événement créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Erreur : ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $evenement = Evenement::findOrFail($id);
        $adresses = Adresse::all();
        $associations = Association::all();

        return view('president.evenement_edit', compact('evenement', 'adresses', 'associations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'budget' => 'required|numeric',
            'dateDebut' => 'required|date',
            'dateFin' => 'required|date|after_or_equal:dateDebut',
            'boulevard' => 'required|string',
            'ville' => 'required|string',
            'pays' => 'required|string',
            'association_id' => 'required|exists:associations,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $evenement = Evenement::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $evenement->image = $imagePath;
        }

        $evenement->nom = $request->nom;
        $evenement->budget = $request->budget;
        $evenement->dateDebut = $request->dateDebut;
        $evenement->dateFin = $request->dateFin;
        $evenement->association_id = $request->association_id;
        $evenement->description = $request->description;
        $evenement->save();

        if ($evenement->adresse) {
            $evenement->adresse->update([
                'boulevard' => $request->boulevard,
                'ville' => $request->ville,
                'pays' => $request->pays,
            ]);
        }

        return redirect()->route('president.evenements.index')->with('success', 'Événement modifié avec succès.');
    }

    public function destroy($id)
    {
        $evenement = Evenement::findOrFail($id);
        $evenement->delete();

        return redirect()->route('president.evenements.index')->with('success', 'Événement supprimé avec succès.');
    }
}
