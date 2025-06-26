@extends('admin.home1')

@section('content')
<div class="page-wrapper">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Gestion</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liste des Arbitres</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin.arbitre.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                    <i class="bx bxs-plus-square"></i> Ajouter un Arbitre
                </a>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Arbitres Table -->
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <h5 class="mb-0">Liste des Arbitres</h5>
                    <div class="ms-auto">
                        <input type="text" class="form-control radius-30 ps-4" placeholder="Rechercher un arbitre...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="arbitresTable" class="table table-striped table-bordered" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->nom }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->telephone ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.arbitre.show', $user->id) }}" class="btn btn-info btn-sm radius-30">
                                        <i class="bx bx-show"></i> Détails
                                    </a>
                                    <a href="{{ route('admin.arbitre.edit', $user->id) }}" class="btn btn-warning btn-sm radius-30">
                                        <i class="bx bxs-edit"></i> Modifier
                                    </a>

                                    @foreach($evenements as $event)
                                        <a href="{{ route('admin.event.assign_arbitres', ['event' => $event->id, 'arbitre' => $user->id]) }}" class="btn btn-primary btn-sm radius-30 mb-1">
                                            <i class="bx bxs-user-check"></i> Assigner à {{ $event->nom }}
                                        </a>
                                    @endforeach

                                    <form action="{{ route('admin.arbitre.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet arbitre ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm radius-30">
                                            <i class="bx bxs-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- End Arbitres Table -->

    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/v/dt/dt-2.2.2/datatables.min.css" rel="stylesheet">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/v/dt/dt-2.2.2/datatables.min.js"></script>

<!-- Initialize DataTable -->
<script>
    $(document).ready(function() {
        $('#arbitresTable').DataTable({
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
