@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <h6 class="mb-0 text-uppercase">Ajouter un Concurrent</h6>
                <hr/>
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Formulaire d’inscription du concurrent</h5>
                            </div>
                            <hr/>

                            <form method="POST" action="{{ route('concurrents.store') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Dossard</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="dossard" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nom" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Prénom</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="prenom" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Genre</label>
                                    <div class="col-sm-9">
                                        <select name="genre" class="form-select" required>
                                            <option value="">Choisir le genre</option>
                                            <option value="male">Homme</option>
                                            <option value="female">Femme</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Date de Naissance</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="date_de_naissance" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Nationalité</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nationalite" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Pays</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="pays" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Épreuve</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="epreuve" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Club</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="club" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">T-Shirt</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="tshirt" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Téléphone</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="telephone" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Commentaire</label>
                                    <div class="col-sm-9">
                                        <textarea name="commentaire" class="form-control" rows="2" placeholder="Optionnel"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-sm-3 col-form-label">CIN</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="cin" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary px-5">Enregistrer</button>
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
