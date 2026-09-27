@extends('president.layout')
@section('edit_mosquees')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Header Section -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-800 to-blue-600 px-8 py-6">
                <h2 class="text-3xl font-bold text-white flex items-center">
                    <i class="fas fa-mosque mr-3"></i>
                    Modifier la Mosquée
                </h2>
                <p class="text-blue-100 mt-2">Mettez à jour les informations de la mosquée</p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-8 py-8">
                <form action="{{ route('gest_mosquees.update', $mosquee) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Informations générales -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                            Informations générales
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-mosque text-blue-600 mr-1"></i>
                                    Nom de la mosquée
                                </label>
                                <input type="text" name="name" id="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" value="{{ old('name', $mosquee->name) }}" required placeholder="Entrez le nom de la mosquée">
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-image text-blue-600 mr-1"></i>
                                    Image
                                </label>
                                
                                <!-- Aperçu de l'image actuelle -->
                                @if($mosquee->image)
                                    <div class="mb-2">
                                        <img src="{{ asset($mosquee->image) }}" class="w-20 h-20 object-cover rounded-lg border">
                                        <p class="text-xs text-gray-500 mt-1">Image actuelle</p>
                                    </div>
                                @endif
                                
                                <!-- Input pour le nouveau fichier -->
                                <input type="file" name="image" accept="image/*" id="image" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                                <small class="text-gray-500">Formats acceptés : JPEG, PNG | Max: 2MB</small>
                                
                                <!-- Aperçu de la nouvelle image sélectionnée -->
                                <div id="image-preview" class="mt-2 hidden">
                                    <img id="preview" class="w-20 h-20 object-cover rounded-lg border">
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="chef_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-user-tie text-blue-600 mr-1"></i>
                                Chef de la mosquée
                            </label>
                            <select name="chef_id" id="chef_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 bg-white">
                                <option value="">Sélectionnez un chef</option>
                                @foreach($chefs as $chef)
                                <option value="{{ $chef->id }}" {{ $chef->id == $mosquee->chef_id ? 'selected' : '' }}>
                                {{ $chef->firstname }} {{ $chef->lastname }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Adresse -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>
                            Adresse
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="boulevard" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-road text-green-600 mr-1"></i>
                                    Boulevard
                                </label>
                                <input type="text" name="boulevard" id="boulevard" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200" value="{{ old('boulevard', $mosquee->adresse->boulevard) }}" required placeholder="Nom du boulevard">
                            </div>

                            <div>
                                <label for="ville" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-city text-green-600 mr-1"></i>
                                    Ville
                                </label>
                                <input type="text" name="ville" id="ville" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200" value="{{ old('ville', $mosquee->adresse->ville) }}" required placeholder="Nom de la ville">
                            </div>

                            <div>
                                <label for="pays" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-flag text-green-600 mr-1"></i>
                                    Pays
                                </label>
                                <input type="text" name="pays" id="pays" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200" value="{{ old('pays', $mosquee->adresse->pays) }}" required placeholder="Nom du pays">
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('gest_mosquees.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-200 font-medium">
                            <i class="fas fa-times mr-2"></i>
                            Annuler
                        </a>
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-save mr-2"></i>
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Aperçu de l'image sélectionnée
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('preview');
        const previewContainer = document.getElementById('image-preview');
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            
            reader.readAsDataURL(this.files[0]);
        } else {
            previewContainer.classList.add('hidden');
        }
    });

    // Aperçu dynamique des informations
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = ['name', 'boulevard', 'ville', 'pays'];
        inputs.forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.addEventListener('input', updatePreview);
            }
        });

        function updatePreview() {
            // Votre logique d'aperçu existante peut être conservée ici
        }
    });
</script>
@endsection