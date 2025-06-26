@extends('template')

@section('contenu')
<div class="container mt-5">
    <h2 class="mb-4">Épreuves de l'événement : {{ $event->nom }}</h2>

    <div class="row">
        @foreach($epreuves as $epreuve)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $epreuve->nom }}</h5>
                        <a href="{{ route('resultat.show', ['event' => $event->id, 'epreuve' => $epreuve->id]) }}" class="btn btn-primary">
                            Voir Résultats
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
