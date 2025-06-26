@extends('arbitre.home') {{-- Layout for arbitre --}}

@section('contenu')
<div class="page-wrapper">
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Mes Événements</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('arbitre.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Événements Assignés</li>
                    </ol>
                </nav>
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
                    <h5 class="mb-0">Liste de Mes Événements Assignés</h5>
                </div>

                @if($events->isEmpty())
                    <div class="alert alert-info">
                        Aucun événement ne vous a encore été assigné.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Lieu</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Détails</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td><strong>#{{ $loop->iteration }}</strong></td>
                                        <td>{{ $event->nom }}</td>
                                        <td>{{ $event->lieu ?? $event->ville ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>
                                        <td>{{ $event->type }}</td>
                                        <td>
                                            <a href="{{ route('arbitre.event.show', $event->id) }}" class="btn btn-info btn-sm radius-30 px-3">
                                                <i class="bx bx-show"></i> Voir
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <!-- End Events Table -->

    </div>
</div>
@endsection
