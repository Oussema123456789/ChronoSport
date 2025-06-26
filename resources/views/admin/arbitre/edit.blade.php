@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <h6 class="mb-0 text-uppercase">Modifier un Arbitre</h6>
                <hr/>
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-user-edit me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Formulaire de modification d’un arbitre</h5>
                            </div>
                            <hr/>

                            <form action="{{ route('admin.arbitre.update', $arbitre->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label for="nom" class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nom" class="form-control" value="{{ old('nom', $arbitre->nom) }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="prenom" class="col-sm-3 col-form-label">Prénom</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $arbitre->prenom) }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $arbitre->email) }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-sm-3 col-form-label">Mot de passe (laisser vide pour ne pas modifier)</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>

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
