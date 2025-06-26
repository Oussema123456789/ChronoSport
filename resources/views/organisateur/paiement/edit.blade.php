@extends('organisateur.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-xl-8 mx-auto">
                <h6 class="mb-0 text-uppercase">Modifier un Paiement</h6>
                <hr/>
                <div class="card border-top border-0 border-4 border-warning">
                    <div class="card-body p-4">
                        <div class="card-title d-flex align-items-center mb-3">
                            <div><i class="bx bx-credit-card me-1 font-22 text-warning"></i></div>
                            <h5 class="mb-0 text-warning">Informations du Paiement</h5>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Oups !</strong> Des erreurs sont survenues :
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('paiements.update', $paiement) }}" method="POST" class="row g-3">
                            @csrf
                            @method('PUT')

                            <div class="col-md-6">
                                <label class="form-label">Montant</label>
                                <input type="number" name="montant" value="{{ old('montant', $paiement->montant) }}" class="form-control" required>
                            </div>
<div class="col-md-12">
    <label for="date" class="form-label">Date</label>
 <input type="date" class="form-control" id="date" name="date"
       value="{{ old('date', \Carbon\Carbon::parse($paiement->date)->format('Y-m-d')) }}"
       required>

</div>

                            <div class="col-md-6">
                                <label class="form-label">Utilisateur</label>
                                <select name="user_id" class="form-select" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($user->id == $paiement->user_id) selected @endif>
                                            {{ $user->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 text-end mt-3">
                                <button type="submit" class="btn btn-warning px-4">Mettre Ã  jour</button>
                                <a href="{{ route('paiements.index') }}" class="btn btn-secondary px-4">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
