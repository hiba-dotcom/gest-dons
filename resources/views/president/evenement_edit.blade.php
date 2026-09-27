@extends('president.layout') 

@section('edit_evenement')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">

    <h2 class="text-2xl font-bold mb-6">Modifier l'événement</h2>

    
    <form action="{{ route('president.evenements.update', $evenement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nom" class="block font-semibold mb-1">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom', $evenement->nom) }}" required
                class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label for="budget" class="block font-semibold mb-1">Budget</label>
            <input type="number" step="0.01" name="budget" id="budget" value="{{ old('budget', $evenement->budget) }}" required
                class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label for="dateDebut" class="block font-semibold mb-1">Date de début</label>
            <input type="date" name="dateDebut" id="dateDebut" value="{{ old('dateDebut', $evenement->dateDebut->format('Y-m-d')) }}" required
                class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label for="dateFin" class="block font-semibold mb-1">Date de fin</label>
            <input type="date" name="dateFin" id="dateFin" value="{{ old('dateFin', $evenement->dateFin->format('Y-m-d')) }}" required
                class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label for="lieu_id" class="block font-semibold mb-1">Adresse</label>
            <input type="text" name="boulevard" placeholder="Boulevard" value="{{ old('boulevard', $evenement->adresse->boulevard ?? '') }}" class="w-full mb-2 border px-3 py-2 rounded">
            <input type="text" name="ville" placeholder="Ville" value="{{ old('ville', $evenement->adresse->ville ?? '') }}" class="w-full mb-2 border px-3 py-2 rounded">
            <input type="text" name="pays" placeholder="Pays" value="{{ old('pays', $evenement->adresse->pays ?? '') }}" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label for="association_id" class="block font-semibold mb-1">Association</label>
            <select name="association_id" id="association_id" required class="w-full border px-3 py-2 rounded">
                <option value="">-- Sélectionnez une association --</option>
                @foreach ($associations as $association)
                <option value="{{ $association->id }}" {{ (old('association_id', $evenement->association_id) == $association->id) ? 'selected' : '' }}>
                    {{ $association->nom }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Déscription</label>
            
            <textarea name="description" id="description" value="{{ old('description', $evenement->description ?? '') }}" class="w-full border px-3 py-2 rounded"></textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block font-semibold mb-1">Image (optionnelle)</label>
            @if($evenement->image)
                <img src="{{ asset('storage/' . $evenement->image) }}" alt="Image de l'événement" class="mb-2 w-48 h-auto rounded">
            @endif
            <input type="file" name="image" id="image" accept="image/*" class="block w-full">
        </div>

        <button type="submit" class="btn-primary px-6 py-2 rounded">Enregistrer les modifications</button>
        <a href="{{ route('president.evenements.index') }}" class="btn-secondary ml-4 px-6 py-2 rounded">Annuler</a>
        @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
        <ul>
            @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    </form>
</div>
@endsection
