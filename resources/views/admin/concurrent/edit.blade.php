@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-xl-10 mx-auto">
                <h6 class="mb-0 text-uppercase">Modifier un Concurrent</h6>
                <hr/>
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-4">
                        <div class="card-title d-flex align-items-center mb-3">
                            <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                            <h5 class="mb-0 text-primary">Informations du Concurrent</h5>
                        </div>

                        <form method="POST" action="{{ route('concurrents.update', $concurrent->id) }}" class="row g-3">
                            @csrf
                            @method('PUT')

                            <div class="col-md-4">
                                <label class="form-label">Dossard</label>
                                <input type="text" name="dossard" class="form-control" value="{{ $concurrent->dossard }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Nom</label>
                                <input type="text" name="nom" class="form-control" value="{{ $concurrent->nom }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Prénom</label>
                                <input type="text" name="prenom" class="form-control" value="{{ $concurrent->prenom }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Genre</label>
                                <select name="genre" class="form-select" required>
                                    <option value="male" {{ $concurrent->genre == 'male' ? 'selected' : '' }}>Homme</option>
                                    <option value="female" {{ $concurrent->genre == 'female' ? 'selected' : '' }}>Femme</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Date de Naissance</label>
                                <input type="date" name="date_de_naissance" class="form-control" value="{{ $concurrent->date_de_naissance }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Nationalité</label>
                                <input type="text" name="nationalite" class="form-control" value="{{ $concurrent->nationalite }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Pays</label>
                                <input type="text" name="pays" class="form-control" value="{{ $concurrent->pays }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Épreuve</label>
                                <input type="text" name="epreuve" class="form-control" value="{{ $concurrent->epreuve }}" required>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Club</label>
                                <input type="text" name="club" class="form-control" value="{{ $concurrent->club }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $concurrent->email }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Taille de T-shirt</label>
                                <input type="text" name="tshirt" class="form-control" value="{{ $concurrent->tshirt }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Téléphone</label>
                                <input type="text" name="telephone" class="form-control" value="{{ $concurrent->telephone }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">CIN</label>
                                <input type="text" name="cin" class="form-control" value="{{ $concurrent->cin }}" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Commentaire</label>
                                <textarea name="commentaire" class="form-control" rows="3">{{ $concurrent->commentaire }}</textarea>
                            </div>

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary px-5">Mettre à jour</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
