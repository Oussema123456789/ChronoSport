@extends('admin.template')

@section('contenu')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Configuration</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.template', $event->id) }}">{{ $event->nom }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Configuration Formulaire</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-xl-12">
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bx-cog me-1 font-22 text-primary"></i></div>
                            <h5 class="mb-0 text-primary">Configuration du Formulaire d'Inscription</h5>
                        </div>
                        <hr>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bx bx-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Informations sur l'événement -->
                        <div class="alert alert-info">
                            <h6><i class="bx bx-info-circle"></i> Événement : {{ $event->nom }}</h6>
                            <p class="mb-0">
                                Configurez quels champs sont activés et obligatoires dans le formulaire d'inscription en ligne pour cet événement.
                                Les modifications s'appliqueront immédiatement aux nouvelles inscriptions.
                            </p>
                        </div>

                        <form action="{{ route('admin.form-config.update', $event->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="bx bx-list-ul"></i> Configuration des Champs</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Champ</th>
                                                    <th>Description</th>
                                                    <th class="text-center">Activé</th>
                                                    <th class="text-center">Obligatoire</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $fieldLabels = [
                                                        'nom' => ['label' => 'Nom', 'description' => 'Nom de famille du participant'],
                                                        'prenom' => ['label' => 'Prénom', 'description' => 'Prénom du participant'],
                                                        'email' => ['label' => 'Email', 'description' => 'Adresse email pour les communications'],
                                                        'telephone' => ['label' => 'Téléphone', 'description' => 'Numéro de téléphone (8 chiffres)'],
                                                        'date_naissance' => ['label' => 'Date de naissance', 'description' => 'Date de naissance pour calculer l\'âge'],
                                                        'cin' => ['label' => 'CIN', 'description' => 'Carte d\'identité nationale (8 chiffres)'],
                                                        'genre' => ['label' => 'Genre', 'description' => 'Genre du participant (Homme/Femme)'],
                                                        'nationalite' => ['label' => 'Nationalité', 'description' => 'Nationalité du participant'],
                                                        'club' => ['label' => 'Club', 'description' => 'Club sportif (optionnel par défaut)'],
                                                    ];
                                                @endphp

                                                @foreach($fieldLabels as $fieldName => $fieldInfo)
                                                <tr>
                                                    <td>
                                                        <strong>{{ $fieldInfo['label'] }}</strong>
                                                        <br><small class="text-muted">{{ $fieldName }}</small>
                                                    </td>
                                                    <td>{{ $fieldInfo['description'] }}</td>
                                                    <td class="text-center">
                                                        <!-- Champ caché pour s'assurer que la valeur est envoyée même si non coché -->
                                                        <input type="hidden" name="fields[{{ $fieldName }}][enabled]" value="0">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox"
                                                                   name="fields[{{ $fieldName }}][enabled]"
                                                                   id="enabled_{{ $fieldName }}"
                                                                   value="1"
                                                                   {{ ($fieldConfig[$fieldName]['enabled'] ?? true) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="enabled_{{ $fieldName }}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- Champ caché pour s'assurer que la valeur est envoyée même si non coché -->
                                                        <input type="hidden" name="fields[{{ $fieldName }}][required]" value="0">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input required-switch" type="checkbox"
                                                                   name="fields[{{ $fieldName }}][required]"
                                                                   id="required_{{ $fieldName }}"
                                                                   value="1"
                                                                   data-field="{{ $fieldName }}"
                                                                   {{ ($fieldConfig[$fieldName]['required'] ?? false) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="required_{{ $fieldName }}"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="bx bx-save"></i> Enregistrer la Configuration
                                    </button>
                                    <a href="{{ route('admin.form-config.reset', $event->id) }}" 
                                       class="btn btn-warning me-2"
                                       onclick="return confirm('Êtes-vous sûr de vouloir réinitialiser la configuration ?')">
                                        <i class="bx bx-refresh"></i> Réinitialiser
                                    </a>
                                    <a href="{{ route('admin.template', $event->id) }}" class="btn btn-outline-secondary">
                                        <i class="bx bx-arrow-back"></i> Retour
                                    </a>
                                </div>
                            </div>
                        </form>

                        <!-- Aperçu de l'impact -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="bx bx-show"></i> Aperçu de l'Impact</h6>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-warning">
                                    <h6><i class="bx bx-warning"></i> Important</h6>
                                    <ul class="mb-0">
                                        <li><strong>Champs désactivés :</strong> Ne s'afficheront pas dans le formulaire d'inscription</li>
                                        <li><strong>Champs obligatoires :</strong> Devront être remplis pour valider l'inscription</li>
                                        <li><strong>Application immédiate :</strong> Les changements s'appliquent aux nouvelles inscriptions</li>
                                        <li><strong>Inscriptions existantes :</strong> Ne sont pas affectées par ces changements</li>
                                    </ul>
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
    // Gestion de la logique : si un champ est obligatoire, il doit être activé
    const requiredSwitches = document.querySelectorAll('.required-switch');
    
    requiredSwitches.forEach(function(requiredSwitch) {
        requiredSwitch.addEventListener('change', function() {
            const fieldName = this.dataset.field;
            const enabledSwitch = document.getElementById('enabled_' + fieldName);
            
            // Si on rend un champ obligatoire, il doit être activé
            if (this.checked && !enabledSwitch.checked) {
                enabledSwitch.checked = true;
            }
        });
    });
    
    // Gestion inverse : si on désactive un champ, il ne peut pas être obligatoire
    const enabledSwitches = document.querySelectorAll('input[name*="[enabled]"]');
    
    enabledSwitches.forEach(function(enabledSwitch) {
        enabledSwitch.addEventListener('change', function() {
            const fieldName = this.id.replace('enabled_', '');
            const requiredSwitch = document.getElementById('required_' + fieldName);
            
            // Si on désactive un champ, il ne peut pas être obligatoire
            if (!this.checked && requiredSwitch.checked) {
                requiredSwitch.checked = false;
            }
        });
    });
});
</script>
@endsection
