@extends('admin.template')

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
                        <li class="breadcrumb-item active" aria-current="page">{{ $event->nom }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <!-- En-tête de l'événement -->
        <div class="row">
            <div class="col-12">
                <div class="card border-top border-0 border-4 border-primary">
                    @if($event->image_couverture)
                    <div class="card-header p-0">
                        <img src="{{ asset('storage/' . $event->image_couverture) }}"
                             alt="{{ $event->nom }}"
                             class="img-fluid w-100"
                             style="height: 200px; object-fit: cover;"
                             onerror="this.parentElement.style.display='none';">
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h4 class="mb-0 text-primary">{{ $event->nom }}</h4>
                                <p class="mb-0 text-muted">
                                    <i class="bx bx-calendar me-1"></i>{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}
                                    <i class="bx bx-map ms-3 me-1"></i>{{ $event->ville }}, {{ $event->pays }}
                                </p>
                            </div>
                            <div class="text-end">
                                @if($event->image_profile)
                                <img src="{{ asset('storage/' . $event->image_profile) }}"
                                     alt="{{ $event->nom }}"
                                     class="rounded-circle me-2"
                                     style="width: 50px; height: 50px; object-fit: cover; border: 1px solid #ddd;"
                                     onerror="this.style.display='none';">
                                @endif
                                <span class="badge bg-success fs-6">{{ $event->type }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques principales -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card radius-10 bg-gradient-deepblue">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $epreuves->count() }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-run fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 100%"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Épreuves</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card radius-10 bg-gradient-orange">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $totalInscriptions }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-user-plus fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 100%"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Inscriptions</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card radius-10 bg-gradient-ohhappiness">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $sponsors->count() }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-building-house fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 100%"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Sponsors</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card radius-10 bg-gradient-ibiza">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 text-white">{{ $arbitres->count() }}</h5>
                            <div class="ms-auto">
                                <i class='bx bx-user-check fs-3 text-white'></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-white" role="progressbar" style="width: 100%"></div>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <p class="mb-0">Arbitres</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Détails des épreuves -->
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bx bx-run me-2"></i>Épreuves de l'événement</h6>
                    </div>
                    <div class="card-body">
                        @if($epreuves->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Genre</th>
                                        <th>Tarif</th>
                                        <th>Inscriptions</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($epreuves as $epreuve)
                                    <tr>
                                        <td><strong>{{ $epreuve->nom }}</strong></td>
                                        <td>
                                            <span class="badge bg-{{ $epreuve->genre == 'male' ? 'primary' : ($epreuve->genre == 'female' ? 'danger' : 'success') }}">
                                                {{ ucfirst($epreuve->genre) }}
                                            </span>
                                        </td>
                                        <td>{{ number_format($epreuve->tarif, 2) }} TND</td>
                                        <td>
                                            <span class="badge bg-info">{{ $epreuve->inscriptions_count }} participants</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('inscriptions.index', ['event' => $event->id, 'epreuve' => $epreuve->id]) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bx bx-list-ul"></i> Voir
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-4">
                            <i class="bx bx-run fs-1 text-muted"></i>
                            <p class="text-muted">Aucune épreuve créée pour cet événement</p>
                            <a href="{{ route('events.epreuves.create', $event->id) }}" class="btn btn-primary">
                                <i class="bx bx-plus"></i> Créer une épreuve
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <!-- Sponsors -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bx bx-building-house me-2"></i>Sponsors</h6>
                    </div>
                    <div class="card-body">
                        @if($sponsors->count() > 0)
                        <div class="row">
                            @foreach($sponsors as $sponsor)
                            <div class="col-6 mb-3">
                                <div class="text-center">
                                    @if($sponsor->image)
                                        <img src="{{ asset('storage/' . $sponsor->image) }}"
                                             alt="{{ $sponsor->nom }}"
                                             class="img-fluid rounded"
                                             style="max-height: 60px; object-fit: contain; border: 1px solid #ddd;"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                        <div style="display: none; padding: 10px; background: #f8f9fa; border-radius: 5px; border: 1px solid #ddd;">
                                            <i class="bx bx-image fs-3 text-muted"></i>
                                            <br><small class="text-muted">Image non trouvée</small>
                                        </div>
                                    @else
                                        <div style="padding: 10px; background: #f8f9fa; border-radius: 5px; border: 1px solid #ddd;">
                                            <i class="bx bx-image fs-3 text-muted"></i>
                                            <br><small class="text-muted">Pas d'image</small>
                                        </div>
                                    @endif
                                    <p class="small mt-1 mb-0">{{ $sponsor->nom }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-3">
                            <i class="bx bx-building-house fs-1 text-muted"></i>
                            <p class="text-muted small">Aucun sponsor</p>
                        </div>
                        @endif
                        <div class="text-center">
                            <a href="{{ route('events.sponsors.index', $event->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bx bx-cog"></i> Gérer les sponsors
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bx bx-cog me-2"></i>Actions rapides</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('events.epreuves.create', $event->id) }}" class="btn btn-outline-primary">
                                <i class="bx bx-plus"></i> Ajouter une épreuve
                            </a>
                            <a href="{{ route('admin.form-config.edit', $event->id) }}" class="btn btn-outline-success">
                                <i class="bx bx-cog"></i> Configurer le formulaire
                            </a>
                            <a href="{{ route('admin.dossards.create', ['epreuve_id' => $epreuves->first()->id ?? '']) }}" 
                               class="btn btn-outline-warning {{ $epreuves->isEmpty() ? 'disabled' : '' }}">
                                <i class="bx bx-id-card"></i> Générer des dossards
                            </a>
                            <a href="{{ route('events.sponsors.create', $event->id) }}" class="btn btn-outline-info">
                                <i class="bx bx-building-house"></i> Ajouter un sponsor
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations détaillées -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="bx bx-info-circle me-2"></i>Informations de l'événement</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Description :</strong></p>
                                <p class="text-muted">{{ $event->description ?? 'Aucune description disponible' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Contact :</strong></p>
                                @if($event->email)
                                <p><i class="bx bx-envelope me-1"></i>{{ $event->email }}</p>
                                @endif
                                @if($event->tel)
                                <p><i class="bx bx-phone me-1"></i>{{ $event->tel }}</p>
                                @endif
                                @if($event->site_web)
                                <p><i class="bx bx-globe me-1"></i><a href="{{ $event->site_web }}" target="_blank">{{ $event->site_web }}</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
