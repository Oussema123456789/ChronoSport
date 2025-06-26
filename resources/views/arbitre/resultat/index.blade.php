@extends('arbitre.events.show')

@section('content')
<div class="page-wrapper">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liste des Résultats</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title">Liste des Résultats</h5>
                    <a href="{{ route('arbitre.resultats.create', $event->id) }}" class="btn btn-primary">Ajouter Résultat</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table id="resultatsTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Rang</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Temps</th>
                                <th>Épreuve</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resultats as $resultat)
                                <tr>
                                    <td>{{ $resultat->rang }}</td>
                                    <td>{{ $resultat->nom }}</td>
                                    <td>{{ $resultat->prenom }}</td>
                                    <td>{{ $resultat->temps }}</td>
                                    <td>{{ $resultat->epreuve->nom ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('arbitre.resultats.show', [$event->id, $resultat->id]) }}" class="btn btn-info btn-sm">Voir</a>
                                        <a href="{{ route('arbitre.resultats.edit', [$event->id, $resultat->id]) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('arbitre.resultats.destroy', [$event->id, $resultat->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce résultat ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables CSS/JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#resultatsTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
            },
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "responsive": true
        });
    });
</script>
@endsection
