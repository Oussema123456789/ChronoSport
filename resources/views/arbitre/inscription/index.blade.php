@extends('arbitre.events.show')

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
