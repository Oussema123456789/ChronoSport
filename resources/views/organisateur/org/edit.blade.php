@extends('organisateur.template')
@section('content')
<div class="page-wrapper">
    <div class="page-content">
<div class="max-w-xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Modifier l'Organisateur</h1>

    <form action="{{ route('organisateur.org.update', $organisateur) }}" method="POST" class="bg-white shadow rounded-2xl p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Nom</label>
            <input type="text" name="nom" value="{{ $organisateur->nom }}" class="w-full border rounded-xl p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Prénom</label>
            <input type="text" name="prenom" value="{{ $organisateur->prenom }}" class="w-full border rounded-xl p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Email</label>
            <input type="email" name="email" value="{{ $organisateur->email }}" class="w-full border rounded-xl p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Téléphone</label>
            <input type="text" name="telephone" value="{{ $organisateur->telephone }}" class="w-full border rounded-xl p-2">
        </div>

        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl">Mettre à jour</button>
        <a href="{{ route('organisateur.org.index') }}" class="ml-4 text-gray-600">Annuler</a>
    </form>
</div>
    </div>
</div>
@endsection
