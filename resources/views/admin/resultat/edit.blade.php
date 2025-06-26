@extends('admin.template')

@section('content')
    <div class="container">
        <h6 class="mb-0 text-uppercase">Modifier un Résultat</h6>
        <hr/>
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bx-trophy me-1 font-22 text-primary"></i></div>
                        <h5 class="mb-0 text-primary">Formulaire de modification du résultat</h5>
                    </div>
                    <hr/>

                    <form action="{{ route('admin.resultats.update', $resultat->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('admin.resultat.form')

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
@endsection
