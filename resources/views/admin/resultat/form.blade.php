<div class="resultat-group border rounded p-3 mb-4">
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
</div>
