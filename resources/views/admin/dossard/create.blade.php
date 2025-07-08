@extends('admin.home1')

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
                        <li class="breadcrumb-item active" aria-current="page">Conception</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <!-- Formulaire de conception -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header px-4 py-3">
                        <h5 class="mb-0">
                            Conception des Dossards
                            @if($epreuve)
                                - {{ $epreuve->nom }} ({{ $epreuve->evenement->nom }})
                            @endif
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bx bx-error"></i> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(!extension_loaded('gd'))
                            <div class="alert alert-warning" role="alert">
                                <i class="bx bx-warning"></i>
                                <strong>Extension GD manquante :</strong>
                                Veuillez activer l'extension GD dans Laragon : Menu → PHP → Extensions → Cocher GD, puis redémarrer Laragon.
                            </div>
                        @endif



                        
                        <!-- Formulaire principal -->
                        <form action="{{ route('admin.dossards.generate') }}" method="POST" enctype="multipart/form-data" id="dossardForm">
                            @csrf
                            
                            <!-- Sélection de l'épreuve -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="epreuve_id" class="form-label">Épreuve</label>
                                    <select class="form-select" name="epreuve_id" id="epreuve_id" required>
                                        <option value="">Sélectionner une épreuve</option>
                                        @foreach($events as $event)
                                            @foreach($event->epreuves as $epr)
                                                <option value="{{ $epr->id }}" 
                                                    {{ $epreuve && $epreuve->id == $epr->id ? 'selected' : '' }}>
                                                    {{ $event->nom }} - {{ $epr->nom }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Upload de l'image de fond -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="background" class="form-label">Image de fond du dossard</label>
                                    <input type="file" class="form-control" name="background" id="background" 
                                           accept="image/jpeg,image/png" required>
                                    <div class="form-text">Formats acceptés: JPEG, PNG. Taille recommandée: 800x600px</div>
                                </div>
                            </div>

                            <!-- Configuration du texte -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="font_size" class="form-label">
                                        Taille de la police: <span id="font_size_value">48</span>px
                                    </label>
                                    <input type="range" class="form-range" name="font_size" id="font_size"
                                           value="48" min="12" max="200" required>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">12px</small>
                                        <small class="text-muted">200px</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="color" class="form-label">Couleur du texte</label>
                                    <input type="color" class="form-control form-control-color" name="color"
                                           id="color" value="#000000" required>
                                </div>
                            </div>

                            <!-- Position du texte avec curseurs -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="position_x" class="form-label">
                                        Position X (horizontal): <span id="position_x_value">400</span>px
                                    </label>
                                    <input type="range" class="form-range" name="position_x" id="position_x"
                                           value="400" min="0" max="800" required>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">0px</small>
                                        <small class="text-muted">800px</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="position_y" class="form-label">
                                        Position Y (vertical): <span id="position_y_value">300</span>px
                                    </label>
                                    <input type="range" class="form-range" name="position_y" id="position_y"
                                           value="300" min="0" max="600" required>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted">0px</small>
                                        <small class="text-muted">600px</small>
                                    </div>
                                </div>
                            </div>





                            <!-- Options supplémentaires -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="with_name"
                                               id="with_name" value="1">
                                        <label class="form-check-label" for="with_name">
                                            Inclure le nom du participant sur le dossard
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons d'action -->
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    @if($epreuve && $inscriptions->count() > 0)
                                    <button type="submit" class="btn btn-primary me-2" id="generateAllBtn">
                                        <i class="bx bx-download"></i> Générer Tous les Dossards
                                        <span class="badge bg-light text-dark ms-1">{{ $inscriptions->count() }}</span>
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-secondary me-2" disabled>
                                        <i class="bx bx-info-circle"></i> Sélectionnez une épreuve avec des inscriptions
                                    </button>
                                    @endif

                                    <a href="{{ route('admin.dossards.index') }}" class="btn btn-outline-secondary ms-2">
                                        <i class="bx bx-arrow-back"></i> Retour
                                    </a>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

            <!-- Aperçu -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header px-4 py-3">
                        <h6 class="mb-0">Aperçu du Dossard</h6>
                    </div>
                    <div class="card-body p-4">
                        <div id="preview-container" class="text-center">
                            <div class="border rounded p-4 bg-light" style="min-height: 300px;">
                                <i class="bx bx-image-add" style="font-size: 48px; color: #ccc;"></i>
                                <p class="text-muted mt-2">Sélectionnez une image de fond pour voir l'aperçu</p>
                            </div>
                        </div>
                        
                        <!-- Informations sur l'épreuve -->
                        @if($epreuve)
                        <div class="mt-3">
                            <div class="alert alert-info">
                                <h6><i class="bx bx-info-circle"></i> Informations de l'épreuve</h6>
                                <ul class="list-unstyled mb-0">
                                    <li><strong>Événement:</strong> {{ $epreuve->evenement->nom }}</li>
                                    <li><strong>Épreuve:</strong> {{ $epreuve->nom }}</li>
                                    <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($epreuve->evenement->date)->format('d/m/Y') }}</li>
                                    <li><strong>Participants inscrits:</strong>
                                        <span class="badge bg-success fs-6">{{ $inscriptions->count() }} participant(s)</span>
                                    </li>
                                </ul>
                            </div>

                            @if($inscriptions->count() > 0)
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="bx bx-list-ul"></i> Liste des participants</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Dossard</th>
                                                    <th>Nom</th>
                                                    <th>Prénom</th>
                                                    <th>Genre</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($inscriptions as $inscription)
                                                <tr>
                                                    <td><span class="badge bg-primary">{{ $inscription->dossard }}</span></td>
                                                    <td>{{ $inscription->nom }}</td>
                                                    <td>{{ $inscription->prenom }}</td>
                                                    <td>{{ $inscription->genre }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="alert alert-warning mt-3">
                                <i class="bx bx-warning"></i> Aucune inscription trouvée pour cette épreuve.
                                <a href="{{ route('inscriptions.index', ['event' => $epreuve->evenement->id, 'epreuve' => $epreuve->id]) }}" class="alert-link">
                                    Gérer les inscriptions
                                </a>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
#preview-container canvas {
    max-width: 100%;
    height: auto;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Styles pour les curseurs */
.form-range {
    height: 6px;
    background: linear-gradient(to right, #007bff 0%, #007bff 50%, #e9ecef 50%, #e9ecef 100%);
    border-radius: 3px;
    outline: none;
    transition: all 0.3s ease;
}

.form-range::-webkit-slider-thumb {
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #007bff;
    cursor: pointer;
    border: 2px solid #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.form-range::-webkit-slider-thumb:hover {
    background: #0056b3;
    transform: scale(1.1);
}

.form-range::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #007bff;
    cursor: pointer;
    border: 2px solid #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}

/* Animation pour les valeurs */
.form-label span {
    font-weight: bold;
    color: #007bff;
    transition: all 0.2s ease;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const backgroundInput = document.getElementById('background');
    const previewContainer = document.getElementById('preview-container');
    const fontSizeInput = document.getElementById('font_size');
    const colorInput = document.getElementById('color');
    const positionXInput = document.getElementById('position_x');
    const positionYInput = document.getElementById('position_y');
    const withNameCheckbox = document.getElementById('with_name');


    // Éléments pour afficher les valeurs
    const fontSizeValue = document.getElementById('font_size_value');
    const positionXValue = document.getElementById('position_x_value');
    const positionYValue = document.getElementById('position_y_value');

    let currentImage = null;

    // Fonction pour synchroniser les curseurs avec les valeurs affichées
    function updateSliderValues() {
        fontSizeValue.textContent = fontSizeInput.value;
        positionXValue.textContent = positionXInput.value;
        positionYValue.textContent = positionYInput.value;
    }

    // Fonction pour ajuster automatiquement les limites des curseurs selon l'image
    function adjustSliderLimits() {
        if (currentImage) {
            positionXInput.max = currentImage.width;
            positionYInput.max = currentImage.height;

            // Mettre à jour les labels des limites
            const xMaxLabel = positionXInput.parentElement.querySelector('.d-flex .text-muted:last-child');
            const yMaxLabel = positionYInput.parentElement.querySelector('.d-flex .text-muted:last-child');
            if (xMaxLabel) xMaxLabel.textContent = currentImage.width + 'px';
            if (yMaxLabel) yMaxLabel.textContent = currentImage.height + 'px';
        }
    }

    // Initialiser les valeurs
    updateSliderValues();

    // Gestion de l'upload d'image
    backgroundInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                currentImage = new Image();
                currentImage.onload = function() {
                    adjustSliderLimits();
                    updatePreview();
                };
                currentImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Mise à jour de l'aperçu
    function updatePreview() {
        if (!currentImage) return;

        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        // Définir la taille du canvas
        canvas.width = currentImage.width;
        canvas.height = currentImage.height;

        // Dessiner l'image de fond
        ctx.drawImage(currentImage, 0, 0);

        // Configurer le texte
        const fontSize = parseInt(fontSizeInput.value) || 48;
        const color = colorInput.value || '#000000';
        const x = parseInt(positionXInput.value) || 400;
        const y = parseInt(positionYInput.value) || 300;

        ctx.font = `${fontSize}px Arial`;
        ctx.fillStyle = color;
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';

        // Dessiner un exemple de numéro de dossard
        const dossardNumber = '123';
        ctx.fillText(dossardNumber, x, y);

        // Dessiner un exemple de nom si l'option est cochée
        if (withNameCheckbox.checked) {
            ctx.font = `${Math.round(fontSize * 0.6)}px Arial`;
            ctx.fillText('Jean DUPONT', x, y + fontSize + 10);
        }

        // Remplacer le contenu de l'aperçu
        previewContainer.innerHTML = '';
        previewContainer.appendChild(canvas);
    }
    
    // Événements pour les curseurs (mise à jour en temps réel)
    [fontSizeInput, positionXInput, positionYInput].forEach(input => {
        input.addEventListener('input', function() {
            updateSliderValues();
            updatePreview();
        });
    });

    // Gestion du changement d'épreuve pour recharger les inscriptions
    const epreuveSelect = document.getElementById('epreuve_id');
    if (epreuveSelect) {
        epreuveSelect.addEventListener('change', function() {
            if (this.value) {
                // Recharger la page avec la nouvelle épreuve sélectionnée
                window.location.href = '{{ route("admin.dossards.create") }}?epreuve_id=' + this.value;
            }
        });
    }

    // Événements pour les autres contrôles
    colorInput.addEventListener('input', updatePreview);
    withNameCheckbox.addEventListener('change', updatePreview);

    // Gestion des positions prédéfinies
    document.querySelectorAll('.position-preset').forEach(button => {
        button.addEventListener('click', function() {
            if (!currentImage) {
                alert('Veuillez d\'abord sélectionner une image de fond.');
                return;
            }

            const xPercent = parseInt(this.dataset.x);
            const yPercent = parseInt(this.dataset.y);

            // Calculer les positions en pixels
            const newX = Math.round((currentImage.width * xPercent) / 100);
            const newY = Math.round((currentImage.height * yPercent) / 100);

            // Mettre à jour les curseurs et champs
            positionXInput.value = newX;
            positionYInput.value = newY;
            updateSliderValues();
            updatePreview();

            // Animation visuelle
            this.classList.add('btn-primary');
            this.classList.remove('btn-outline-secondary');
            setTimeout(() => {
                this.classList.remove('btn-primary');
                this.classList.add('btn-outline-secondary');
            }, 200);
        });
    });


});
</script>
@endsection
