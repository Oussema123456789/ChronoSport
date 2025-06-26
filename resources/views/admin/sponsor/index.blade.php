@extends('admin.template')

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
                        <li class="breadcrumb-item"><a href="{{ route('admin.event.index') }}">Événements</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sponsors</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('events.sponsors.create', ['event' => $event->id]) }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                    <i class="bx bxs-plus-square"></i> Ajouter un Sponsor
                </a>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Sponsors Table -->
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <h5 class="mb-0">Liste des Sponsors pour l'événement : <strong>{{ $event->nom }}</strong></h5>
                    <div class="ms-auto">
                        <form action="{{ route('events.sponsors.index', ['event' => $event->id]) }}" method="GET" id="searchForm">
                            <input type="text" name="search" id="searchInput" class="form-control radius-30 ps-4" placeholder="Rechercher un sponsor..." value="{{ request()->query('search') }}">
                        </form>
                    </div>
                </div>

                @if($sponsors->isEmpty())
                    <p class="text-muted">Aucun sponsor trouvé pour cet événement.</p>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Image</th>
                                    <th>Voir</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sponsors as $sponsor)
                                    <tr>
                                        <td><strong>#{{ $loop->iteration }}</strong></td>
                                        <td>{{ $sponsor->nom }}</td>
                                        <td>
                                            @if($sponsor->image)
                                                <img src="{{ asset('storage/' . $sponsor->image) }}" alt="Image" class="img-thumbnail" style="height: 60px;">
                                            @else
                                                <span class="text-muted">Aucune image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('events.sponsors.show', ['event' => $event->id, 'sponsor' => $sponsor->id]) }}" class="btn btn-info btn-sm radius-30 px-3">
                                                <i class="bx bx-show"></i>Afficher
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('events.sponsors.edit', ['event' => $event->id, 'sponsor' => $sponsor->id]) }}" class="btn btn-warning btn-sm radius-30 px-3">
                                                    <i class="bx bxs-edit"></i>
                                                </a>
                                                <form action="{{ route('events.sponsors.destroy', ['event' => $event->id, 'sponsor' => $sponsor->id]) }}" method="POST" onsubmit="return confirm('Supprimer ce sponsor ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm radius-30 px-3">
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
                @endif

            </div>
        </div>
        <!-- End Sponsors Table -->

    </div>
</div>

@section('scripts')
<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        document.getElementById('searchForm').submit();
    });
</script>
@endsection

@endsection
