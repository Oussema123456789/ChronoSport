@extends('admin.template')

@section('contenu')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Gestion</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inscriptions.index', ['event' => $event->id, 'epreuve' => $epreuve->id]) }}">Inscriptions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modifier l'Inscription</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="card border-top border-0 border-4 border-warning">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-edit me-1 font-22 text-warning"></i></div>
                            <h5 class="mb-0 text-warning">Modifier l'Inscription</h5>
                        </div>
                        <hr>
                        
                        <!-- Informations sur l'événement et l'épreuve -->
                        <div class="alert alert-info">
                            <h6><i class="bx bx-info-circle"></i> Informations</h6>
                            <p class="mb-1"><strong>Événement :</strong> {{ $event->nom }}</p>
                            <p class="mb-1"><strong>Date :</strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                            <p class="mb-1"><strong>Épreuve actuelle :</strong> {{ $epreuve->nom }}</p>
                            <p class="mb-0"><strong>Dossard :</strong> <span class="badge bg-primary">{{ $inscription->dossard }}</span></p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.inscriptions.update', ['event' => $event->id, 'epreuve' => $epreuve->id, 'inscription' => $inscription->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Épreuve</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-select" name="epreuve_id" required>
                                        @foreach($epreuves as $epr)
                                            <option value="{{ $epr->id }}" {{ $epr->id == $inscription->epreuve_id ? 'selected' : '' }}>
                                                {{ $epr->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nom</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="nom" value="{{ old('nom', $inscription->nom) }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Prénom</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="prenom" value="{{ old('prenom', $inscription->prenom) }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $inscription->email) }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Téléphone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="telephone" value="{{ old('telephone', $inscription->telephone) }}" 
                                           pattern="[0-9]{8}" title="8 chiffres requis" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Date de naissance</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="date" class="form-control" name="date_naissance" value="{{ old('date_naissance', $inscription->date_naissance) }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">CIN</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="cin" value="{{ old('cin', $inscription->cin) }}" 
                                           pattern="[0-9]{8}" title="8 chiffres requis" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Genre</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-select" name="genre" required>
                                        <option value="">Sélectionner le genre</option>
                                        <option value="Homme" {{ old('genre', $inscription->genre) == 'Homme' ? 'selected' : '' }}>Homme</option>
                                        <option value="Femme" {{ old('genre', $inscription->genre) == 'Femme' ? 'selected' : '' }}>Femme</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nationalité</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="nationalite" value="{{ old('nationalite', $inscription->nationalite) }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Club (optionnel)</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control" name="club" value="{{ old('club', $inscription->club) }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <button type="submit" class="btn btn-warning px-4">
                                        <i class="bx bx-save"></i> Mettre à jour l'Inscription
                                    </button>
                                    <a href="{{ route('inscriptions.index', ['event' => $event->id, 'epreuve' => $epreuve->id]) }}" 
                                       class="btn btn-secondary px-4 ms-2">
                                        <i class="bx bx-arrow-back"></i> Retour
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
