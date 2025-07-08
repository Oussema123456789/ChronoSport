@extends('template')

@section('contenu')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-xl-8 mx-auto">
            <h6 class="mb-0 text-uppercase">Formulaire d'inscription</h6>
            <hr/>
            <div class="card border-top border-0 border-4 border-success">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-success"></i></div>
                        <h5 class="mb-0 text-success">Inscription à l'événement</h5>
                    </div>
                    <hr>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Informations sur l'événement et l'épreuve -->
                    <div class="alert alert-info">
                        <h6><i class="bx bx-info-circle"></i> Informations</h6>
                        <p class="mb-1"><strong>Événement :</strong> {{ $event->nom }}</p>
                        <p class="mb-1"><strong>Date :</strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                        <p class="mb-1"><strong>Lieu :</strong> {{ $event->ville }}</p>
                        <p class="mb-0"><strong>Épreuve :</strong> {{ $epreuve->nom }}</p>
                    </div>

                    <form method="POST" action="{{ route('inscription.store', $epreuve->id) }}">
                        @csrf
                        <input type="hidden" name="epreuve_id" value="{{ $epreuve->id }}">

                        <div class="row g-3">
                            @if($formConfig['nom']['enabled'])
                            <div class="col-md-6">
                                <label class="form-label">
                                    Nom
                                    @if($formConfig['nom']['required']) <span class="text-danger">*</span> @endif
                                </label>
                                <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                                       value="{{ old('nom') }}" {{ $formConfig['nom']['required'] ? 'required' : '' }}>
                                @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            @endif

                            @if($formConfig['prenom']['enabled'])
                            <div class="col-md-6">
                                <label class="form-label">
                                    Prénom
                                    @if($formConfig['prenom']['required']) <span class="text-danger">*</span> @endif
                                </label>
                                <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" 
                                       value="{{ old('prenom') }}" {{ $formConfig['prenom']['required'] ? 'required' : '' }}>
                                @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            @endif

                            @if($formConfig['email']['enabled'])
                            <div class="col-md-6">
                                <label class="form-label">
                                    Email
                                    @if($formConfig['email']['required']) <span class="text-danger">*</span> @endif
                                </label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" {{ $formConfig['email']['required'] ? 'required' : '' }}>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            @endif

                            @if($formConfig['telephone']['enabled'])
                            <div class="col-md-6">
                                <label class="form-label">
                                    Téléphone
                                    @if($formConfig['telephone']['required']) <span class="text-danger">*</span> @endif
                                </label>
                                <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" 
                                       value="{{ old('telephone') }}" pattern="\d{8}" minlength="8" maxlength="8" 
                                       title="Le numéro doit contenir exactement 8 chiffres" 
                                       {{ $formConfig['telephone']['required'] ? 'required' : '' }}>
                                @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            @endif

                            @if($formConfig['date_naissance']['enabled'])
                            <div class="col-md-6">
                                <label class="form-label">
                                    Date de naissance
                                    @if($formConfig['date_naissance']['required']) <span class="text-danger">*</span> @endif
                                </label>
                                <input type="date" name="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror" 
                                       value="{{ old('date_naissance') }}" {{ $formConfig['date_naissance']['required'] ? 'required' : '' }}>
                                @error('date_naissance') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            @endif

                            @if($formConfig['cin']['enabled'])
                            <div class="col-md-6">
                                <label class="form-label">
                                    N° CIN / Passeport
                                    @if($formConfig['cin']['required']) <span class="text-danger">*</span> @endif
                                </label>
                                <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror"
                                       value="{{ old('cin') }}" pattern="\d{8}" minlength="8" maxlength="8"
                                       title="Le numéro doit contenir exactement 8 chiffres"
                                       {{ $formConfig['cin']['required'] ? 'required' : '' }}>
                                @error('cin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            @endif

                            @if($formConfig['genre']['enabled'])
                            <div class="col-md-6">
                                <label class="form-label">
                                    Genre
                                    @if($formConfig['genre']['required']) <span class="text-danger">*</span> @endif
                                </label>
                                <select name="genre" class="form-select @error('genre') is-invalid @enderror" 
                                        {{ $formConfig['genre']['required'] ? 'required' : '' }}>
                                    <option value="">Sélectionner...</option>
                                    <option value="Homme" {{ old('genre') == 'Homme' ? 'selected' : '' }}>Homme</option>
                                    <option value="Femme" {{ old('genre') == 'Femme' ? 'selected' : '' }}>Femme</option>
                                </select>
                                @error('genre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            @endif

                            @if($formConfig['nationalite']['enabled'])
                            <div class="col-md-6">
                                <label class="form-label">
                                    Nationalité
                                    @if($formConfig['nationalite']['required']) <span class="text-danger">*</span> @endif
                                </label>
                                <input type="text" name="nationalite" class="form-control @error('nationalite') is-invalid @enderror" 
                                       value="{{ old('nationalite') }}" {{ $formConfig['nationalite']['required'] ? 'required' : '' }}>
                                @error('nationalite') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            @endif

                            @if($formConfig['club']['enabled'])
                            <div class="col-md-6">
                                <label class="form-label">
                                    Club
                                    @if($formConfig['club']['required']) <span class="text-danger">*</span> @endif
                                </label>
                                <input type="text" name="club" class="form-control @error('club') is-invalid @enderror" 
                                       value="{{ old('club') }}" {{ $formConfig['club']['required'] ? 'required' : '' }}>
                                @error('club') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            @endif
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-success px-5">
                                <i class="bx bx-check"></i> Confirmer l'inscription
                            </button>
                            <a href="{{ route('public.event.epreuves', $event->id) }}" class="btn btn-outline-secondary px-5 ms-2">
                                <i class="bx bx-arrow-back"></i> Retour
                            </a>
                        </div>
                    </form>

                    <!-- Légende des champs obligatoires -->
                    <div class="alert alert-light mt-4">
                        <small class="text-muted">
                            <span class="text-danger">*</span> Champs obligatoires
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
