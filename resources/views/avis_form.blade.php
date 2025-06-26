<!-- resources/views/avis_form.blade.php -->

@extends('template') <!-- Or your layout file -->

@section('contenu')


<div class="container py-5">
    <h2 class="mb-4">Laissez votre témoignage</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('avis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="client" class="form-label">Nom du client</label>
            <input type="text" class="form-control" name="client" required>
        </div>
        <div class="mb-3">
            <label for="organisation" class="form-label">Organisation (facultatif)</label>
            <input type="text" class="form-control" name="organisation">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" name="message" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Photo (facultatif)</label>
            <input type="file" class="form-control" name="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
@endsection
