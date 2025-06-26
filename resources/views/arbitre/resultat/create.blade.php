@extends('arbitre.events.show') {{-- Assuming you have a layout like layouts/arbitre.blade.php --}}

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            <h6 class="mb-0 text-uppercase">Ajouter un Résultat</h6>
            <hr/>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bx-trophy me-1 font-22 text-primary"></i></div>
                            <h5 class="mb-0 text-primary">Formulaire de création d'un résultat</h5>
                        </div>
                        <hr/>

                        <form action="{{ route('arbitre.resultats.store') }}" method="POST">
                            @csrf

                            <div id="resultat-container">
                                {{-- Optional: Load one blank result input initially --}}
                                @include('arbitre.resultat.form')
                            </div>

                            <div class="mb-3 text-end">
                                <button type="button" id="add-resultat" class="btn btn-primary">Ajouter un résultat</button>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-9 offset-sm-3 d-flex gap-2">
                                    <button type="submit" class="btn btn-success">Enregistrer</button>
                                    <a href="{{ route('arbitre.events.index') }}" class="btn btn-secondary">Annuler</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript unchanged --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addBtn = document.getElementById('add-resultat');
        const container = document.getElementById('resultat-container');
        const form = document.querySelector('form');

        addBtn?.addEventListener('click', function () {
            const row = document.createElement('div');
            row.classList.add('resultat-group', 'border', 'rounded', 'p-3', 'mb-4');
            row.innerHTML = `
                <div class="row g-3">
                    <div class="col-md-3">
                        <label>Rang</label>
                        <input type="number" name="rang[]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Dossard</label>
                        <input type="text" name="dossard[]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Nom</label>
                        <input type="text" name="nom[]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Prénom</label>
                        <input type="text" name="prenom[]" class="form-control">
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-3">
                        <label>Genre</label>
                        <select name="genre[]" class="form-control">
                            <option value="male">Homme</option>
                            <option value="female">Femme</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Catégorie</label>
                        <input type="text" name="categorie[]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Temps</label>
                        <input type="text" name="temps[]" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label>Club</label>
                        <input type="text" name="club[]" class="form-control">
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label>Épreuve</label>
                        <select name="epreuve_id[]" class="form-control">
                            @foreach($epreuves as $epreuve)
                                <option value="{{ $epreuve->id }}">{{ $epreuve->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-danger remove-resultat">Supprimer</button>
                    </div>
                </div>
            `;
            container.appendChild(row);
        });

        container.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-resultat')) {
                e.target.closest('.resultat-group')?.remove();
            }
        });

        form?.addEventListener('submit', function (e) {
            const rangInputs = form.querySelectorAll('input[name="rang[]"]');
            const dossardInputs = form.querySelectorAll('input[name="dossard[]"]');
            let valid = false;

            for (let i = 0; i < rangInputs.length; i++) {
                if (rangInputs[i].value.trim() !== "" && dossardInputs[i].value.trim() !== "") {
                    valid = true;
                    break;
                }
            }

            if (!valid) {
                e.preventDefault();
                alert('Veuillez ajouter au moins un résultat complet.');
            }
        });
    });
</script>
@endsection
