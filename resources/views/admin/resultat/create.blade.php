@extends('admin.template')

@section('content')
<div class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-6 mt-6">
    <h2 class="text-2xl font-bold mb-4 text-center">Ajouter Résultats</h2>

    <form action="{{ route('admin.resultats.store', $event) }}" method="POST">
        @csrf

        <div id="resultat-container">
            <div class="resultat-group grid grid-cols-6 gap-4 mb-4 p-4 border rounded-lg bg-gray-50">
                <!-- Dossard -->
                <div>
                    <label class="block font-medium">Dossard</label>
                    <input type="text" name="dossard[]" class="form-control dossard-input w-full border p-2 rounded" required>
                </div>

                <!-- Nom -->
                <div>
                    <label class="block font-medium">Nom</label>
                    <input type="text" name="nom[]" class="form-control nom-input w-full border p-2 rounded bg-gray-100" readonly>
                </div>

                <!-- Prénom -->
                <div>
                    <label class="block font-medium">Prénom</label>
                    <input type="text" name="prenom[]" class="form-control prenom-input w-full border p-2 rounded bg-gray-100" readonly>
                </div>

                <!-- Genre -->
                <div>
                    <label class="block font-medium">Genre</label>
                    <input type="text" name="genre[]" class="form-control genre-input w-full border p-2 rounded bg-gray-100" readonly>
                </div>

                <!-- Catégorie -->
                <div>
                    <label class="block font-medium">Catégorie</label>
                    <input type="text" name="categorie[]" class="form-control categorie-input w-full border p-2 rounded bg-gray-100" readonly>
                </div>

                <!-- Club -->
                <div>
                    <label class="block font-medium">Club</label>
                    <input type="text" name="club[]" class="form-control club-input w-full border p-2 rounded bg-gray-100" readonly>
                </div>

                <!-- Temps -->
                <div>
                    <label class="block font-medium">Temps</label>
                    <input type="text" name="temps[]" class="form-control w-full border p-2 rounded" placeholder="HH:MM:SS" required>
                </div>

                <!-- Rang -->
                <div>
                    <label class="block font-medium">Rang</label>
                    <input type="number" name="rang[]" class="form-control w-full border p-2 rounded" required>
                </div>

                <!-- Epreuve ID caché -->
                <input type="hidden" name="epreuve_id[]" class="epreuve-id-hidden">
            </div>
        </div>

        <!-- Ajouter une ligne -->
        <div class="mb-6">
            <button type="button" id="add-line" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                Ajouter une ligne
            </button>
        </div>

        <!-- Boutons -->
        <div class="flex justify-between">
            <a href="{{ route('admin.resultats.index', $event) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">Retour</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded">Enregistrer</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    function attachDossardListeners() {
        document.querySelectorAll('.dossard-input').forEach(function (input) {
            input.removeEventListener('change', handleDossardChange); // avoid duplicates
            input.addEventListener('change', handleDossardChange);
        });
    }

    function handleDossardChange() {
        const dossard = this.value;
        const row = this.closest('.resultat-group');

        fetch('/admin/concurrent/' + dossard)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    row.querySelector('.nom-input').value = data.nom;
                    row.querySelector('.prenom-input').value = data.prenom;
                    row.querySelector('.genre-input').value = data.genre;
                    row.querySelector('.categorie-input').value = data.epreuve.categorie || '';
                    row.querySelector('.club-input').value = data.club;
                    row.querySelector('.epreuve-id-hidden').value = data.epreuve.id;
                } else {
                    alert('Concurrent introuvable pour ce dossard');
                }
            })
            .catch(() => {
                alert('Erreur lors de la récupération du concurrent.');
            });
    }

    document.getElementById('add-line').addEventListener('click', function () {
        const container = document.getElementById('resultat-container');
        const clone = container.querySelector('.resultat-group').cloneNode(true);

        // Clear inputs
        clone.querySelectorAll('input').forEach(input => {
            input.value = '';
        });

        container.appendChild(clone);
        attachDossardListeners();
    });

    attachDossardListeners();
});
</script>
@endsection
