<!DOCTYPE html>
<html>
<head>
    <title>Test Configuration Formulaire</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Test Configuration Formulaire - Événement: {{ $event->nom }}</h2>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('test.form-config.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="card">
                <div class="card-header">
                    <h5>Configuration des Champs</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Champ</th>
                                <th>Activé</th>
                                <th>Obligatoire</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $fieldLabels = [
                                    'nom' => 'Nom',
                                    'prenom' => 'Prénom',
                                    'email' => 'Email',
                                    'telephone' => 'Téléphone',
                                    'date_naissance' => 'Date de naissance',
                                    'cin' => 'CIN',
                                    'genre' => 'Genre',
                                    'nationalite' => 'Nationalité',
                                    'club' => 'Club',
                                ];
                            @endphp
                            
                            @foreach($fieldLabels as $fieldName => $label)
                            <tr>
                                <td><strong>{{ $label }}</strong></td>
                                <td>
                                    <input type="hidden" name="fields[{{ $fieldName }}][enabled]" value="0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" 
                                               name="fields[{{ $fieldName }}][enabled]" 
                                               id="enabled_{{ $fieldName }}"
                                               value="1"
                                               {{ ($fieldConfig[$fieldName]['enabled'] ?? true) ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <input type="hidden" name="fields[{{ $fieldName }}][required]" value="0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" 
                                               name="fields[{{ $fieldName }}][required]" 
                                               id="required_{{ $fieldName }}"
                                               value="1"
                                               {{ ($fieldConfig[$fieldName]['required'] ?? false) ? 'checked' : '' }}>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
                <a href="/debug-form-config.php" class="btn btn-secondary" target="_blank">Voir Debug</a>
            </div>
        </form>
        
        <div class="mt-4">
            <h5>Configuration actuelle :</h5>
            <pre>{{ json_encode($fieldConfig, JSON_PRETTY_PRINT) }}</pre>
        </div>
    </div>
</body>
</html>
