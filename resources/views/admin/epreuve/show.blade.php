@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <div class="main-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Détails de l'Épreuve : {{ $epreuve->nom }}</h2>
                    <span class="badge bg-info fs-6">{{ $event->nom }}</span>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $details = [
                                        'Nom' => $epreuve->nom,
                                        'Tarif' => $epreuve->tarif . '€',
                                        'Genre' => $epreuve->genre,
                                        'Date Début' => \Carbon\Carbon::parse($epreuve->date_debut)->format('d/m/Y'),
                                        'Date Fin' => \Carbon\Carbon::parse($epreuve->date_fin)->format('d/m/Y'),
                                        'Période d\'inscription' => \Carbon\Carbon::parse($epreuve->inscription_date_debut)->format('d/m/Y') . ' → ' . \Carbon\Carbon::parse($epreuve->inscription_date_fin)->format('d/m/Y'),
                                        'Nombre d\'inscriptions' => $epreuve->inscriptions->count() . ' participant(s)',
                                        'Résultat publié' => $epreuve->publier_resultat ? 'Oui' : 'Non',
                                        'Événement' => $event->nom ?? 'N/A'
                                    ];
                                @endphp

                                @foreach ($details as $label => $value)
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">{{ $label }}</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            @if($label == 'Nombre d\'inscriptions')
                                                <span class="badge bg-primary fs-6">{{ $value }}</span>
                                            @else
                                                {{ $value }}
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                <div class="mt-4 d-flex justify-content-start">
                                    <a href="{{ route('inscriptions.index', ['event' => $event->id, 'epreuve' => $epreuve->id]) }}" class="btn btn-success me-2">
                                        <i class="bx bx-list-ul"></i> Liste des Inscriptions
                                    </a>
                                    <a href="{{ route('events.epreuves.index', $event->id) }}" class="btn btn-info">
                                        <i class="bx bx-arrow-back"></i> Retour
                                    </a>
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
