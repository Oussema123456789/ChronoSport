@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <div class="main-body">
                <h2 class="mb-4">Détails du Sponsor</h2>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nom</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $sponsor->nom }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Événement</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ optional($sponsor->event)->nom ?? 'Événement non défini' }}
                                    </div>
                                </div>


                                <div class="row mb-4">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Image</h6>
                                    </div>
                                    <div class="col-sm-9">
                                        @if($sponsor->image)
                                            <img src="{{ asset('storage/' . $sponsor->image) }}" alt="Image du sponsor" class="img-fluid rounded shadow" style="max-width: 200px;">
                                        @else
                                            <span class="text-muted">Aucune image disponible</span>
                                        @endif
                                    </div>
                                </div>

                                <a href="{{ route('events.sponsors.index', ['event' => $sponsor->evenement_id]) }}" class="btn btn-outline-secondary">← Retour</a>
                            </div>
                        </div>
                    </div>
                </div> <!-- /row -->
            </div>
        </div>
    </div>
</div>
@endsection
