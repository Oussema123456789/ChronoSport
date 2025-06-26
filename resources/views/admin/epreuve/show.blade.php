@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <div class="main-body">
                <h2 class="mb-4">Détails de l'Épreuve</h2>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $details = [
                                        'Tarif' => $epreuve->tarif . '€',
                                        'Genre' => $epreuve->genre,
                                        'Date Début' => $epreuve->date_debut,
                                        'Date Fin' => $epreuve->date_fin,
                                        'Inscriptions' => $epreuve->inscription_date_debut . ' → ' . $epreuve->inscription_date_fin,
                                        'Résultat publié' => $epreuve->publier_resultat ? 'Oui' : 'Non',
                                        'Événement' => $epreuve->event->nom ?? 'N/A'
                                    ];
                                @endphp

                                @foreach ($details as $label => $value)
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">{{ $label }}</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $value }}
                                        </div>
                                    </div>
                                @endforeach

                                <div class="mt-4 d-flex justify-content-start">
                                    <a href="{{ route('events.epreuves.edit', [$event->id, $epreuve->id]) }}" class="btn btn-warning me-2">Modifier</a>
                                    <a href="{{ route('events.epreuves.index', $event->id) }}" class="btn btn-info">Retour</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
