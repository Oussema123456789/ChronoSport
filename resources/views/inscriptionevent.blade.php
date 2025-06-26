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

                    <form method="POST" action="{{ route('inscription.store', $epreuve->id) }}">
                        @csrf
                        <input type="hidden" name="epreuve_id" value="{{ $epreuve->id }}">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom</label>
                                <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" required>
                                @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Prénom</label>
                                <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom') }}" required>
                                @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Téléphone</label>
                                <input
                                    type="text"
                                    name="telephone"
                                    class="form-control @error('telephone') is-invalid @enderror"
                                    value="{{ old('telephone') }}"
                                    pattern="\d{8}"
                                    minlength="8"
                                    maxlength="8"
                                    title="Le numéro doit contenir exactement 8 chiffres"
                                    required>
                                @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>


                            <div class="col-md-6">
                                <label class="form-label">Date de naissance</label>
                                <input type="date" name="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror" value="{{ old('date_naissance') }}" required>
                                @error('date_naissance') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

<div class="col-md-6">
    <label class="form-label">N° CIN / Passeport</label>
    <input
        type="text"
        name="cin"
        class="form-control @error('cin') is-invalid @enderror"
        value="{{ old('cin') }}"
        pattern="\d{8}"
        minlength="8"
        maxlength="8"
        title="Le numéro doit contenir exactement 8 chiffres"
        required>
    @error('cin') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>


                            <div class="col-md-4">
                                <label class="form-label">Genre</label>
                                <select name="genre" class="form-select @error('genre') is-invalid @enderror" required>
                                    <option value="">Choisir...</option>
                                    <option value="Homme" {{ old('genre') == 'Homme' ? 'selected' : '' }}>Homme</option>
                                    <option value="Femme" {{ old('genre') == 'Femme' ? 'selected' : '' }}>Femme</option>
                                </select>
                                @error('genre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Nationalité</label>
                                <select name="nationalite" class="form-select @error('nationalite') is-invalid @enderror" required>
                                    <option value="">-- Sélectionnez une nationalité --</option>
                                    @foreach (['Maroc', 'Algérie', 'Tunisie', 'Libye', 'Mauritanie', 'Égypte'] as $nationalite)
                                        <option value="{{ $nationalite }}" {{ old('nationalite') == $nationalite ? 'selected' : '' }}>{{ $nationalite }}</option>
                                    @endforeach
                                </select>
                                @error('nationalite') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>



                            <div class="col-md-4">
                                <label class="form-label">Club</label>
                                <input type="text" name="club" class="form-control @error('club') is-invalid @enderror" value="{{ old('club') }}">
                                @error('club') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-success px-5">S'inscrire</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
