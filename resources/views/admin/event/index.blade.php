@extends('admin.home1')

@section('contenu')
<div class="page-wrapper">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Gestion</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.event.index') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Événements</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('admin.event.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                    <i class="bx bxs-plus-square"></i> Ajouter Événement
                </a>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Events Table -->
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <h5 class="mb-0">Liste des Événements</h5>
                    <div class="ms-auto">
                        <form action="{{ route('admin.event.index') }}" method="GET" id="searchForm">
                            <input type="text" name="search" id="searchInput" class="form-control radius-30 ps-4" placeholder="Rechercher un événement..." value="{{ request()->query('search') }}">
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Ville</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($evenements as $event)
                        @if($event->id)  <!-- Check if the event has an ID -->
                            <tr>
                                <td><strong>#{{ $loop->iteration }}</strong></td>
                                <td>{{ $event->nom }}</td>
                                <td>{{ $event->ville }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>
                                <td>{{ $event->type }}</td>
                                <td>
                                    <a href="{{ route('admin.template', $event->id) }}" class="btn btn-info px-4 radius-30">
                                        <i class="bx bx-show"></i> Afficher
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.event.edit', $event->id) }}" class="btn btn-sm btn-warning radius-30 px-3">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.event.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger radius-30 px-3">
                                                <i class="bx bxs-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- End Events Table -->

    </div>
</div>

@section('scripts')
<script>
    // Listen for the input event on the search input
    document.getElementById('searchInput').addEventListener('input', function() {
        document.getElementById('searchForm').submit();
    });
</script>
@endsection

@endsection
