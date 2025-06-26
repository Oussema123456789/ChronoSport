@extends('organisateur.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <h6 class="mb-0 text-uppercase">Ajout de Paiement</h6>
                <hr/>
                <div class="card border-top border-0 border-4 border-primary shadow">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center mb-4">
                            <div><i class="bx bx-credit-card me-2 font-22 text-primary"></i></div>
                            <h4 class="mb-0 text-primary">Nouveau Paiement</h4>
                        </div>

                        <form class="row g-3" action="{{ route('paiements.store') }}" method="POST">
                            @csrf

                            <div class="col-md-12">
                                <label for="montant" class="form-label">Montant</label>
                                <input type="number" name="montant" id="montant" class="form-control" placeholder="Entrez le montant à payer" required>
                            </div>

                            <!-- Dropdown for selecting a user -->
                            <div class="col-md-12">
                                <label for="user_id" class="form-label">Utilisateur</label>
                                <select class="form-select" id="user_id" name="user_id" required>
                                    <option selected disabled>-- Sélectionner un utilisateur --</option>
                                        @foreach($users->where('role', 'organisateur') as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $paiement->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                                {{ $user->nom }}
                                            </option>
                                        @endforeach

                                </select>
                            </div>
                            <!-- Date Input -->
                            <div class="col-md-12">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>

                            <div class="col-12 text-end mt-4">
                                <button type="submit" class="btn btn-success px-5">
                                    <i class="bi bi-check-circle me-1"></i>Enregistrer
                                </button>
                                <a href="{{ route('paiements.index') }}" class="btn btn-secondary px-4 ms-2">
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
