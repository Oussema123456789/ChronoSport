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
            <div class="ms-auto">
                <a href="{{ route('admin.inscriptions.create', ['event' => $event->id, 'epreuve' => request()->route('epreuve')]) }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                    <i class="bx bxs-plus-square"></i> Ajouter une Inscription
                </a>
            </div>
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
                        <th>Actions</th>
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
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.inscriptions.edit', ['event' => $event->id, 'epreuve' => $inscription->epreuve_id, 'inscription' => $inscription->id]) }}"
                                       class="btn btn-sm btn-warning radius-30 px-3" title="Modifier">
                                        <i class="bx bxs-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.inscriptions.destroy', ['event' => $event->id, 'epreuve' => $inscription->epreuve_id, 'inscription' => $inscription->id]) }}"
                                          method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette inscription ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger radius-30 px-3" title="Supprimer">
                                            <i class="bx bxs-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    </div>

<style>
.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    border-radius: 0.375rem;
}

.d-flex.gap-2 {
    gap: 0.5rem !important;
}

.table td {
    vertical-align: middle;
}

.btn-warning:hover {
    background-color: #e0a800;
    border-color: #d39e00;
}

.btn-danger:hover {
    background-color: #c82333;
    border-color: #bd2130;
}
</style>
@endsection
