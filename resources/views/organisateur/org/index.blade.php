@extends('organisateur.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Gestion</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('organisateur.template') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Organisateurs</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('organisateur.org.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                    <i class="bx bxs-user-plus"></i> Ajouter un Organisateur
                </a>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Organisateurs Table -->
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <h5 class="mb-0">Liste des Organisateurs</h5>
                    <div class="ms-auto">
                        <input type="text" class="form-control radius-30 ps-4" placeholder="Rechercher un organisateur...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                                <th>Détails</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($users as $user)
   @if ($user->role === 'organisateur')

    <tr>
        <td><strong>#{{ $user->id }}</strong></td>
        <td>{{ $user->nom }}</td>
        <td>{{ $user->prenom }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <span class="badge rounded-pill bg-light-secondary text-dark px-3 py-2">
                {{ $user->telephone ?? 'Non spécifié' }}
            </span>
        </td>
        <td>
            <a href="{{ route('organisateur.org.show', $user) }}" class="btn btn-sm btn-info radius-30 px-3">
                <i class="bx bx-show"></i> Voir
            </a>
        </td>
        <td>
            <div class="d-flex gap-2">
                <a href="{{ route('organisateur.org.edit', $user) }}" class="btn btn-sm btn-warning radius-30 px-3">
                    <i class="bx bxs-edit"></i>
                </a>
                <form action="{{ route('organisateur.org.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer cet organisateur ?')">
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

                <!-- Pagination (if applicable) -->

            </div>
        </div>
        <!-- End Table -->

    </div>
</div>
@endsection
