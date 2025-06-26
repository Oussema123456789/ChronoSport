@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <h6 class="mb-0 text-uppercase">Ajout de Sponsor</h6>
                <hr/>
                <div class="card border-top border-0 border-4 border-danger shadow">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center mb-4">
                            <div><i class="bx bxs-user-plus me-2 font-22 text-primary"></i></div>
                            <h4 class="mb-0 text-primary">Nouveau Sponsor</h4>
                        </div>

                        <form class="row g-3"
                            action="{{ route('events.sponsors.store', $selectedEventId) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <label for="nom" class="form-label">Nom du Sponsor</label>
                                <input type="text" name="nom" id="nom" class="form-control" placeholder="Entrez le nom du sponsor" required>
                            </div>

                            <div class="col-md-12">
                                <label for="image" class="form-label">Image du Sponsor</label>
                                <input class="form-control" type="file" id="image" name="image" required>
                            </div>

                            <input type="hidden" name="evenement_id" value="{{ $selectedEventId }}">

                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn btn-success px-5">
                                    <i class="bi bi-check-circle me-1"></i>Enregistrer
                                </button>
                                <a href="{{ route('admin.template', ['event' => $selectedEventId]) }}" class="btn btn-secondary px-4 ms-2">
                                    <i class="bi bi-arrow-left me-1"></i>Retour
                                </a>
                            </div>
                        </form>
                    </div>
                </div> <!-- End card -->
            </div>
        </div>
    </div>
</div>
@endsection
