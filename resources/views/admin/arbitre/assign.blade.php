@extends('admin.home1')

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
                        <li class="breadcrumb-item active" aria-current="page">Assigner des Arbitres</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Assignment Form -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Assigner des Arbitres à un Événement</h5>
                <form method="POST" action="{{ route('admin.arbitre.assign') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="event_id" class="form-label">Événement</label>
                        <select id="event_id" name="event_id" class="form-select" required>
                            <option value="">-- Sélectionner un événement --</option>
                            @foreach($evenements as $evenement)
                                <option value="{{ $evenement->id }}">{{ $evenement->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Arbitres disponibles</label>
                        <div class="row">
                            @foreach($arbitres as $arbitre)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox" name="arbitres[]" value="{{ $arbitre->id }}" id="arbitre_{{ $arbitre->id }}" class="form-check-input">
                                        <label for="arbitre_{{ $arbitre->id }}" class="form-check-label">
                                            {{ $arbitre->prenom }} {{ $arbitre->nom }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Assigner arbitres</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

