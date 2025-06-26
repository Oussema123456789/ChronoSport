@extends('arbitre.events.show')

@section('content')
    <div class="container">
        <h2>Détails du Résultat</h2>
        <ul>
            <li><strong>Rang:</strong> {{ $resultat->rang }}</li>
            <li><strong>Nom:</strong> {{ $resultat->nom }}</li>
            <li><strong>Prénom:</strong> {{ $resultat->prenom }}</li>
            <li><strong>Temps:</strong> {{ $resultat->temps }}</li>
            <li><strong>Épreuve:</strong> {{ $resultat->epreuve->nom ?? 'N/A' }}</li>
        </ul>
        <a href="{{ route('admin.resultats.index') }}" class="btn btn-secondary">Retour</a>
    </div>
@endsection
