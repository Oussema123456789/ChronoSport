@extends('organisateur.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <div class="main-body">
                <h2 class="mb-4">Détails de l'Organisateur</h2>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $details = [
                                        'Nom' => $organisateur->nom,
                                        'Prénom' => $organisateur->prenom,
                                        'Email' => $organisateur->email,
                                        'Téléphone' => $organisateur->telephone ?? 'Non spécifié',
                                        'Statut' => $organisateur->statut ? 'Actif' : 'Inactif'
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
                                    <a href="{{ route('organisateur.org.edit', $organisateur->id) }}" class="btn btn-warning me-2">Modifier</a>
                                    <a href="{{ route('organisateur.org.index') }}" class="btn btn-outline-primary">← Retour à la liste</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /row -->
            </div>
        </div>
    </div>
</div>
@endsection
