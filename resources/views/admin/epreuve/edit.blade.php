@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <h6 class="mb-0 text-uppercase">Modifier une Épreuve</h6>
                <hr/>
                <div class="card border-top border-0 border-4 border-danger">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-flag me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Formulaire de modification d’une épreuve</h5>
                            </div>
                            <hr/>

                            <form action="{{ route('events.epreuves.update', [$epreuve->evenement_id, $epreuve->id]) }}" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Champs du formulaire --}}
                                @include('admin.epreuve.form', ['epreuve' => $epreuve])

                                <div class="row mt-4">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary px-5">Mettre à jour</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
