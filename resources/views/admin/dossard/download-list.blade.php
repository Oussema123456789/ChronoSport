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
                        <li class="breadcrumb-item"><a href="{{ route('admin.dossards.index') }}">Dossards</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Téléchargement</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-12">
                <div class="card border-top border-0 border-4 border-success">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bx-download me-1 font-22 text-success"></i></div>
                            <h5 class="mb-0 text-success">Dossards Générés avec Succès</h5>
                        </div>
                        <hr>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bx bx-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Informations sur la génération -->
                        <div class="alert alert-info">
                            <h6><i class="bx bx-info-circle"></i> Informations de génération</h6>
                            <ul class="mb-0">
                                <li><strong>Épreuve :</strong> {{ $epreuve->nom }}</li>
                                <li><strong>Événement :</strong> {{ $epreuve->evenement->nom }}</li>
                                <li><strong>Nombre de dossards :</strong> <span class="badge bg-success">{{ $count }}</span></li>
                                <li><strong>Date de génération :</strong> {{ now()->format('d/m/Y à H:i') }}</li>
                            </ul>
                        </div>

                        <!-- Actions globales -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary me-2" id="downloadAllBtn">
                                    <i class="bx bx-download"></i> Télécharger Tous (un par un)
                                </button>
                                <a href="{{ route('admin.dossards.create', ['epreuve_id' => $epreuve->id]) }}" class="btn btn-outline-secondary me-2">
                                    <i class="bx bx-refresh"></i> Générer à Nouveau
                                </a>
                                <a href="{{ route('admin.dossards.index') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-arrow-back"></i> Retour
                                </a>
                            </div>
                        </div>

                        <!-- Liste des dossards -->
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="bx bx-list-ul"></i> Liste des Dossards Générés</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom du Fichier</th>
                                                <th>Taille</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($files as $index => $file)
                                            @php
                                                $filename = basename($file);
                                                $filesize = round(filesize($file) / 1024, 2); // Taille en KB
                                            @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <i class="bx bx-image text-primary me-2"></i>
                                                    {{ $filename }}
                                                </td>
                                                <td>{{ $filesize }} KB</td>
                                                <td>
                                                    <a href="{{ route('admin.dossards.download.single', ['folder' => $folderName, 'file' => $filename]) }}" 
                                                       class="btn btn-sm btn-success download-btn">
                                                        <i class="bx bx-download"></i> Télécharger
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Note importante -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const downloadAllBtn = document.getElementById('downloadAllBtn');
    const downloadBtns = document.querySelectorAll('.download-btn');
    
    // Fonction pour télécharger tous les fichiers un par un
    downloadAllBtn.addEventListener('click', function() {
        let currentIndex = 0;
        const totalFiles = downloadBtns.length;
        
        downloadAllBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Téléchargement en cours...';
        downloadAllBtn.disabled = true;
        
        function downloadNext() {
            if (currentIndex < totalFiles) {
                const btn = downloadBtns[currentIndex];
                const link = btn.href;
                
                // Créer un lien temporaire pour télécharger
                const tempLink = document.createElement('a');
                tempLink.href = link;
                tempLink.style.display = 'none';
                document.body.appendChild(tempLink);
                tempLink.click();
                document.body.removeChild(tempLink);
                
                // Marquer le bouton comme téléchargé
                btn.innerHTML = '<i class="bx bx-check"></i> Téléchargé';
                btn.classList.remove('btn-success');
                btn.classList.add('btn-secondary');
                
                currentIndex++;
                
                // Attendre un peu avant le prochain téléchargement
                setTimeout(downloadNext, 1000);
            } else {
                // Tous les fichiers ont été téléchargés
                downloadAllBtn.innerHTML = '<i class="bx bx-check"></i> Tous Téléchargés';
                downloadAllBtn.classList.remove('btn-primary');
                downloadAllBtn.classList.add('btn-success');
            }
        }
        
        downloadNext();
    });
});
</script>
@endsection
