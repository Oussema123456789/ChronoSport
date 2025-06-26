@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Tables</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liste des Résultats</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End of breadcrumb -->

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title">Liste des Résultats</h5>
                    <a href="{{ route('admin.resultats.create') }}" class="btn btn-primary">Ajouter Résultat</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table id="exemple2" class="table table-striped table-bordered">
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
                                        <a href="{{ route('admin.resultats.show', $resultat->id) }}" class="btn btn-info btn-sm">Voir</a>
                                        <a href="{{ route('admin.resultats.edit', $resultat->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                        <form action="{{ route('admin.resultats.destroy', $resultat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce résultat ?');">
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
<script src="/DataTables/datatables.js"></script>
<script>
    $(document).ready(function() {
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
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
@endsection
