@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Gestion</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Arbitres Assignés</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Arbitres assignés à l'événement : <strong>{{ $event->nom }}</strong></h5>

                @if($arbitres->isEmpty())
                    <div class="alert alert-warning">
                        Aucun arbitre n'est encore assigné à cet événement.
                    </div>
                @else
                    <div class="row">
                        @foreach($arbitres as $arbitre)
                            <div class="col-md-4 mb-3">
                                <div class="card border shadow">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $arbitre->name }}</h6>
                                        <p class="mb-1"><strong>Email :</strong> {{ $arbitre->email }}</p>
                                        <p class="mb-0"><strong>Téléphone :</strong> {{ $arbitre->telephone ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('admin.arbitre.assign.form') }}" class="btn btn-primary">
                        <i class="bx bxs-plus-circle"></i> Assigner d'autres arbitres
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
