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
                        <li class="breadcrumb-item active" aria-current="page">Liste des Épreuves</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- End of breadcrumb -->

        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <h5 class="mb-0">Liste des Épreuves</h5>
                    <div class="ms-auto">
                        <a href="{{ route('events.epreuves.create', $event->id) }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                            <i class="bx bxs-plus-square"></i> Ajouter une épreuve
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table id="epreuvesTable" class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                                <th>Tarif</th>
                                <th>Genre</th>
                                <th>Dates</th>
                                <th>Résultat</th>
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($epreuves as $epreuve)
                            <tr>
                                <td>{{ $epreuve->nom }}</td>
                                <td>{{ $epreuve->tarif }}€</td>
                                <td>{{ $epreuve->genre }}</td>
                                <td>{{ \Carbon\Carbon::parse($epreuve->date_debut)->format('d/m/Y') }} → {{ \Carbon\Carbon::parse($epreuve->date_fin)->format('d/m/Y') }}</td>
                                <td>{{ $epreuve->publier_resultat ? 'Oui' : 'Non' }}</td>
                                <td>
                                    <a href="{{ route('events.epreuves.show', [$event->id, $epreuve->id]) }}" class="btn btn-info px-4 radius-30">
                                        <i class="bx bx-show"></i> Afficher
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('events.epreuves.edit', [$event->id, $epreuve->id]) }}" class="btn btn-sm btn-warning radius-30 px-3">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                        <form action="{{ route('events.epreuves.destroy', [$event->id, $epreuve->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger radius-30 px-3">
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
</div>
@endsection

@section('scripts')
<script src="/DataTables/datatables.js"></script>
<script>
    $(document).ready(function() {
        $('#epreuvesTable').DataTable({
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
