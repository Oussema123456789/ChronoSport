@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <div class="main-body">
                <h2 class="mb-4">Détails du Concurrent</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="mt-3">
                                    <h4>{{ $concurrent->prenom }} {{ $concurrent->nom }}</h4>
                                    <p class="text-muted font-size-sm">{{ $concurrent->nationalite }}</p>
                                    <p class="text-muted font-size-sm">{{ $concurrent->club }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $fields = [
                                        'Email' => $concurrent->email,
                                        'CIN' => $concurrent->cin,
                                        'Dossard' => $concurrent->dossard,
                                        'Genre' => $concurrent->genre,
                                        'Naissance' => $concurrent->date_de_naissance,
                                        'Pays' => $concurrent->pays,
                                        'Épreuve' => $concurrent->epreuve,
                                        'Téléphone' => $concurrent->telephone,
                                        'T-Shirt' => $concurrent->tshirt,
                                        'Commentaire' => $concurrent->commentaire,
                                    ];
                                @endphp

                                @foreach ($fields as $label => $value)
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">{{ $label }}</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $value ?? '-' }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div> <!-- /row -->
            </div>
        </div>
    </div>
</div>
@endsection
