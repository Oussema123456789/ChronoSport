<!DOCTYPE html>
<html>
<head>
    <title>Test Affichage Sponsors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Test d'Affichage des Sponsors</h2>
        
        <h3>Événement : {{ $event->nom }}</h3>
        
        <div class="row">
            @if($sponsors->count() > 0)
                @foreach($sponsors as $sponsor)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5>{{ $sponsor->nom }}</h5>
                            
                            <p><strong>Chemin image :</strong> {{ $sponsor->image }}</p>
                            <p><strong>URL complète :</strong> {{ asset('storage/' . $sponsor->image) }}</p>
                            <p><strong>Fichier existe :</strong> 
                                @if($sponsor->image && file_exists(storage_path('app/public/' . $sponsor->image)))
                                    ✅ Oui
                                @else
                                    ❌ Non
                                @endif
                            </p>
                            
                            @if($sponsor->image && file_exists(storage_path('app/public/' . $sponsor->image)))
                                <div class="mb-2">
                                    <strong>Image :</strong><br>
                                    <img src="{{ asset('storage/' . $sponsor->image) }}" 
                                         alt="{{ $sponsor->nom }}" 
                                         class="img-fluid" 
                                         style="max-height: 100px; border: 1px solid #ddd;">
                                </div>
                            @else
                                <div class="mb-2">
                                    <div style="padding: 20px; background: #f8f9fa; border: 1px solid #ddd;">
                                        <i class="fas fa-image"></i> Image manquante
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Test avec différents chemins -->
                            <div class="mt-3">
                                <small><strong>Tests d'affichage :</strong></small><br>
                                
                                <!-- Test 1: Chemin normal -->
                                <div class="mb-1">
                                    <small>Normal: </small>
                                    <img src="{{ asset('storage/' . $sponsor->image) }}" 
                                         style="max-height: 30px;" 
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';"
                                         alt="Test 1">
                                    <span style="display: none; color: red;">❌</span>
                                </div>
                                
                                <!-- Test 2: Sans storage/ -->
                                <div class="mb-1">
                                    <small>Direct: </small>
                                    <img src="{{ asset($sponsor->image) }}" 
                                         style="max-height: 30px;" 
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';"
                                         alt="Test 2">
                                    <span style="display: none; color: red;">❌</span>
                                </div>
                                
                                <!-- Test 3: URL complète -->
                                <div class="mb-1">
                                    <small>URL: </small>
                                    <img src="{{ url('storage/' . $sponsor->image) }}" 
                                         style="max-height: 30px;" 
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';"
                                         alt="Test 3">
                                    <span style="display: none; color: red;">❌</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12">
                    <p>Aucun sponsor trouvé pour cet événement.</p>
                </div>
            @endif
        </div>
        
        <hr>
        <div class="mt-4">
            <h4>Informations de debug :</h4>
            <ul>
                <li><strong>URL de base :</strong> {{ url('/') }}</li>
                <li><strong>Asset URL :</strong> {{ asset('storage/test.png') }}</li>
                <li><strong>Nombre de sponsors :</strong> {{ $sponsors->count() }}</li>
            </ul>
        </div>
        
        <div class="mt-3">
            <a href="/admin/template/{{ $event->id }}" class="btn btn-primary">Retour au tableau de bord</a>
        </div>
    </div>
</body>
</html>
