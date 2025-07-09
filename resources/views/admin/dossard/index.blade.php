@extends('admin.home')

@section('contenu')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Gestion</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Conception des Dossards</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-header px-4 py-3">
                        <h5 class="mb-0">Conception des Dossards</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <p class="text-muted">Sélectionnez un événement et une épreuve pour commencer la conception des dossards.</p>
                            </div>
                        </div>

                        <!-- Sélection d'événement et d'épreuve -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="event_select" class="form-label">Événement</label>
                                    <select class="form-select" id="event_select" name="event_id">
                                        <option value="">Sélectionner un événement</option>
                                        @foreach($events as $event)
                                            <option value="{{ $event->id }}">{{ $event->nom }} - {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="epreuve_select" class="form-label">Épreuve</label>
                                    <select class="form-select" id="epreuve_select" name="epreuve_id" disabled>
                                        <option value="">Sélectionner une épreuve</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" id="start_design" disabled>
                                    <i class="bx bx-design"></i> Commencer la Conception
                                </button>
                            </div>
                        </div>

                        <!-- Informations sur les épreuves -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h6>Événements Disponibles</h6>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Événement</th>
                                                <th>Date</th>
                                                <th>Épreuves</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($events as $event)
                                                <tr>
                                                    <td>{{ $event->nom }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</td>
                                                    <td>
                                                        @if($event->epreuves->count() > 0)
                                                            <span class="badge bg-success">{{ $event->epreuves->count() }} épreuve(s)</span>
                                                        @else
                                                            <span class="badge bg-warning">Aucune épreuve</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($event->epreuves->count() > 0)
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                    Concevoir
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    @foreach($event->epreuves as $epreuve)
                                                                        <li>
                                                                            <a class="dropdown-item" href="{{ route('admin.dossards.create', ['epreuve_id' => $epreuve->id]) }}">
                                                                                {{ $epreuve->nom }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
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
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const eventSelect = document.getElementById('event_select');
    const epreuveSelect = document.getElementById('epreuve_select');
    const startDesignBtn = document.getElementById('start_design');
    
    // Données des événements et épreuves
    const eventsData = @json($events);
    
    eventSelect.addEventListener('change', function() {
        const eventId = this.value;
        epreuveSelect.innerHTML = '<option value="">Sélectionner une épreuve</option>';
        epreuveSelect.disabled = true;
        startDesignBtn.disabled = true;
        
        if (eventId) {
            const selectedEvent = eventsData.find(event => event.id == eventId);
            if (selectedEvent && selectedEvent.epreuves.length > 0) {
                epreuveSelect.disabled = false;
                selectedEvent.epreuves.forEach(epreuve => {
                    const option = document.createElement('option');
                    option.value = epreuve.id;
                    option.textContent = epreuve.nom;
                    epreuveSelect.appendChild(option);
                });
            }
        }
    });
    
    epreuveSelect.addEventListener('change', function() {
        startDesignBtn.disabled = !this.value;
    });
    
    startDesignBtn.addEventListener('click', function() {
        const epreuveId = epreuveSelect.value;
        if (epreuveId) {
            window.location.href = `{{ route('admin.dossards.create') }}?epreuve_id=${epreuveId}`;
        }
    });
});
</script>
@endsection
