<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Nom</label>
    <div class="col-sm-9">
        <input type="text" name="nom" class="form-control" value="{{ old('nom', $epreuve?->nom) }}">
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Tarif (€)</label>
    <div class="col-sm-9">
        <input type="number" step="5" name="tarif" class="form-control" value="{{ old('tarif', $epreuve?->tarif) }}">
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Genre</label>
    <div class="col-sm-9">
        <select name="genre" class="form-select" required>
            <option value="">Choisir le genre</option>
            <option value="male" {{ old('genre', $epreuve?->genre) == 'male' ? 'selected' : '' }}>Homme</option>
            <option value="female" {{ old('genre', $epreuve?->genre) == 'female' ? 'selected' : '' }}>Femme</option>
            <option value="mixte" {{ old('genre', $epreuve?->genre) == 'mixte' ? 'selected' : '' }}>Mixte</option>
        </select>
    </div>
</div>


<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Date Début</label>
    <div class="col-sm-9">
        <input type="datetime-local" name="date_debut" class="form-control" value="{{ old('date_debut', $epreuve?->date_debut) }}">
    </div>
</div>


<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Date Fin</label>
    <div class="col-sm-9">
        <input type="datetime-local" name="date_fin" class="form-control" value="{{ old('date_fin', $epreuve?->date_fin) }}">
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Début Inscriptions</label>
    <div class="col-sm-9">
        <input type="datetime-local" name="inscription_date_debut" class="form-control" value="{{ old('inscription_date_debut', $epreuve?->inscription_date_debut) }}">
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Fin Inscriptions</label>
    <div class="col-sm-9">
        <input type="datetime-local" name="inscription_date_fin" class="form-control" value="{{ old('inscription_date_fin', $epreuve?->inscription_date_fin) }}">
    </div>
</div>

<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Résultat Publié</label>
    <div class="col-sm-9">
        <select name="publier_resultat" class="form-select">
            <option value="1" {{ old('publier_resultat', $epreuve?->publier_resultat) ? 'selected' : '' }}>Oui</option>
            <option value="0" {{ old('publier_resultat', $epreuve?->publier_resultat) === 0 ? 'selected' : '' }}>Non</option>
        </select>
    </div>
</div>


