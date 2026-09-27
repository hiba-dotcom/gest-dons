<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Enums\StatutEnum;
use App\Models\Association;
use App\Models\Postulation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PostulationController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'experiences' => 'required|string|min:100',
            'motivations' => 'required|string|min:100',
            'plan' => 'required|string|min:30',
            'nom' => 'required|string|max:100',
            'slogan' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image' => 'required|url',
            'totaleBudget' => 'required|numeric|min:0',
            'totaleMembres' => 'required|integer|min:1',
        ]);
        try {
            DB::beginTransaction();
            $postulation = new Postulation();
            $postulation->plan = $request->plan;
            $postulation->experiences = $request->experiences;
            $postulation->motivations = $request->motivations;
            $postulation->president()->associate(auth()->user());
            $postulation->save();


            $association = new Association();
            $association->nom = $request->nom;
            $association->slogan = $request->slogan;
            $association->description = $request->description;
            $association->image = $request->image;
            $association->totaleBudget = $request->totaleBudget;
            $association->totaleBudget = $request->totaleBudget;
            $association->totaleMembres = $request->totaleMembres;
            $association->postulation()->associate($postulation);
            $association->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
            return $e->getMessage();
        }

        return redirect()->route('associations')->with('success', 'wait for admin validation');
    }
    public function show(Postulation $postulation)
    {
        $postulation->load(['association', 'president']);

        return view('admin/postulation', compact('postulation'));
    }

    public function updateStatus(Request $request, $id)
    {
        // dd($id);
        // dd($request->all());
        $request->validate([
            'statut' => ['required', Rule::in(['pending', 'validé', 'refusé'])]
        ]);
        // dd($request);


        $postulation = Postulation::findOrFail($id);
        $postulation->statut = StatutEnum::from($request->statut);
        $postulation->save();
        if($postulation->statut->value === 'validé'){
            $postulation->president->role = RoleEnum::from('président');
            $postulation->president->save();
        }
        
        $messages = [
            'pending' => 'La postulation a été remise en attente.',
            'validé' => 'La postulation a été validée avec succès.',
            'refusé' => 'La postulation a été refusée.'
        ];

        return redirect()->route('association.postulation')
            ->with('success', $messages[$request->statut]);
    }
}