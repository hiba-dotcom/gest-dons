@extends('./layout')

@section('post-imam')

<div class="max-w-4xl mx-auto mt-8 bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6">Mes Postulations</h2>

    @if($postulations->isEmpty())
        <p class="text-gray-600">Vous n'avez encore postulé à aucun poste.</p>
    @else
        <table class="min-w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border-b">Motivations</th>
                    <th class="py-2 px-4 border-b">Expérience</th>
                    <th class="py-2 px-4 border-b">Statut</th>
                    <th class="py-2 px-4 border-b">Motif Refus</th>
                    <th class="py-2 px-4 border-b">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($postulations as $postulation)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $postulation->motivations }}</td>
                        <td class="py-2 px-4 border-b">{{ $postulation->experience }}</td>
                        <td class="py-2 px-4 border-b">
                            @if($postulation->statut == 'validé')
                                <span class="text-green-600 font-semibold">Validé</span>
                            @elseif($postulation->statut == 'refusé')
                                <span class="text-red-600 font-semibold">Refusé</span>
                            @else
                                <span class="text-yellow-600 font-semibold">En attente</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">{{ $postulation->motif_refus ?? '-' }}</td>
                        <td class="py-2 px-4 border-b">{{ $postulation->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
