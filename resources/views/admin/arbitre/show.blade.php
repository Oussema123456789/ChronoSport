@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Arbitre</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.arbitre.index') }}">Liste des Arbitres</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Détails de l'Arbitre</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title">Détails de l'Arbitre</h5>
                    <a href="{{ route('admin.arbitre.index') }}" class="btn btn-secondary">Retour</a>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nom:</strong> {{ $arbitre->nom }}</p>
                        <p><strong>Prénom:</strong> {{ $arbitre->prenom }}</p>
                        <p><strong>Email:</strong> {{ $arbitre->email }}</p>
                        <p><strong>Téléphone:</strong> {{ $arbitre->telephone }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
