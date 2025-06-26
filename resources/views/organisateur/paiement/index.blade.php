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
                        <li class="breadcrumb-item active" aria-current="page">Paiements</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <a href="{{ route('paiements.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                    <i class="bx bxs-plus-square"></i> Ajouter Paiement
                </a>
            </div>
        </div>
        <!-- End Breadcrumb -->

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Paiements Table -->
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    <h5 class="mb-0">Liste des Paiements</h5>
                    <div class="ms-auto">
                        <input type="text" class="form-control radius-30 ps-4" placeholder="Rechercher un paiement...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Utilisateur</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>View Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paiements as $paiement)
                            <tr>
                                <td><strong>#{{ $paiement->id }}</strong></td>
                                <td>{{ $paiement->user ? $paiement->user->nom : 'Utilisateur inconnu' }}</td>

                                <td>
                                    <span class="badge rounded-pill text-info bg-light-info px-3 py-2">${{ $paiement->montant }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($paiement->date)->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('paiements.show', $paiement->id) }}" class="btn btn-info px-4 radius-30">
                                        <i class="bx bx-show"></i> Afficher
                                    </a>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('paiements.edit', $paiement->id) }}" class="btn btn-sm btn-warning radius-30 px-3">
                                            <i class="bx bxs-edit"></i>
                                        </a>
                                        <form action="{{ route('paiements.destroy', $paiement->id) }}" method="POST" onsubmit="return confirm('Supprimer ce paiement ?')">
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

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $paiements->links() }}
                </div>
            </div>
        </div>
        <!-- End Paiements Table -->

    </div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />

<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
@endsection
