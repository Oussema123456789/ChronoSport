@extends('admin.template')

@section('contenu')
<div class="page-wrapper">
    <div class="page-content">


    <!-- Success message if inscription is successful -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Display inscriptions -->
    <div class="card">
    <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
            <h5 class="mb-0">Liste des Inscriptions - {{ $event->nom }} </h5>
        </div>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Dossard</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>CIN</th>
                        <th>Genre</th>
                        <th>Date de naissance</th>
                        <th>Nationalité</th>
                        <th>Club</th>
                        <th>Épreuve</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inscriptions as $inscription)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $inscription->dossard }}</td>
                            <td>{{ $inscription->nom }}</td>
                            <td>{{ $inscription->prenom }}</td>
                            <td>{{ $inscription->email }}</td>
                            <td>{{ $inscription->telephone }}</td>
                            <td>{{ $inscription->cin }}</td>
                            <td>{{ $inscription->genre }}</td>
                            <td>{{ $inscription->date_naissance }}</td>
                            <td>{{ $inscription->nationalite }}</td>
                            <td>{{ $inscription->club }}</td>
                            <td>{{ $inscription->epreuve->nom }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    </div>
@endsection
