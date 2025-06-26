@extends('admin.home1')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <h6 class="mb-0 text-uppercase">Modifier l'Événement</h6>
                <hr/>
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-calendar me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Formulaire de modification de l'événement</h5>
                            </div>
                            <hr/>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Oups !</strong> Des erreurs sont survenues.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

<form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-3">

        <!-- Nom -->
        <div class="col-md-6">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $event->nom) }}" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pays -->
        <div class="col-md-6">
            <label for="pays" class="form-label">Pays</label>
            <select name="pays" id="pays" class="form-select @error('pays') is-invalid @enderror" required>
                <option value="">-- Sélectionnez un pays --</option>
                @foreach (['Maroc', 'Algérie', 'Tunisie', 'Libye', 'Égypte', 'Mauritanie'] as $pays)
                    <option value="{{ $pays }}" {{ old('pays', $event->pays) == $pays ? 'selected' : '' }}>{{ $pays }}</option>
                @endforeach
            </select>
            @error('pays')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Ville -->
                                        <div class="col-md-6">
                                            <label for="ville" class="form-label">Ville</label>
                                            <select name="ville" id="ville" class="form-select @error('ville') is-invalid @enderror" required>
                                                <option value="{{ $pays }}" {{ old('pays', $event->pays ?? '') == $pays ? 'selected' : '' }}>{{ $pays }}</option>

                                            </select>
                                            @error('ville')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

        <!-- Adresse -->
        <div class="col-md-6">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse', $event->adresse) }}" required>
            @error('adresse')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date -->
        <div class="col-md-6">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror"
                value="{{ old('date', $event->date ? \Carbon\Carbon::parse($event->date)->format('Y-m-d') : '') }}"
                min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
            @error('date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Type -->
        <div class="col-md-6">
            <label for="type" class="form-label">Type d'événement</label>
            <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                <option value="">-- Sélectionnez un type --</option>
                @foreach (['Course à pied', 'Trail', 'Cyclisme', 'VTT', 'Triathlon', 'Duathlon', 'Natation', 'Randonnée', 'Marche', "Course d'obstacle"] as $type)
                    <option value="{{ $type }}" {{ old('type', $event->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $event->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Site Web -->
        <div class="col-md-6">
            <label for="site_web" class="form-label">Site Web</label>
            <input type="url" name="site_web" id="site_web" class="form-control @error('site_web') is-invalid @enderror"
                value="{{ old('site_web', $event->site_web) }}">
            @error('site_web')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Téléphone -->
        <div class="col-md-6">
            <label for="tel" class="form-label">Téléphone</label>
            <input type="text" name="tel" id="tel" class="form-control @error('tel') is-invalid @enderror"
                value="{{ old('tel', $event->tel) }}" required>
            @error('tel')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Réseaux sociaux -->
        @foreach (['facebook', 'instagram', 'youtube'] as $social)
            <div class="col-md-6">
                <label for="{{ $social }}" class="form-label">{{ ucfirst($social) }}</label>
                <input type="url" name="{{ $social }}" id="{{ $social }}" class="form-control @error($social) is-invalid @enderror"
                    value="{{ old($social, $event->$social) }}">
                @error($social)
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        @endforeach

        <!-- Description -->
        <div class="col-12">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="6" required>{{ old('description', $event->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

<!-- Règlement PDF -->
<div class="col-12">
    <label for="reglement" class="form-label">Règlement (PDF seulement)</label>

    {{-- Show existing PDF if available --}}
    @if (!empty($event->reglement))
        <div class="mb-2">
            <a href="{{ asset('storage/' . $event->reglement) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                📄 Voir le règlement actuel
            </a>
        </div>
    @endif

    <input type="file" name="reglement" id="reglement" class="form-control @error('reglement') is-invalid @enderror" accept="application/pdf">

    @error('reglement')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


        <!-- Bouton -->
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>

    </div>
</form>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /row -->
    </div>
</div>
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>

<script>
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#description'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', '|',
                'fontColor', 'fontSize', 'alignment', '|',
                'bulletedList', 'numberedList', '|',
                'link', 'imageUpload', '|',
                'undo', 'redo'
            ],
            fontColor: {
                colors: [
                    { color: '#000000', label: 'Black' },
                    { color: '#FF0000', label: 'Red' },
                    { color: '#00FF00', label: 'Green' },
                    { color: '#0000FF', label: 'Blue' },
                    { color: '#FFFF00', label: 'Yellow' },
                    { color: '#FF00FF', label: 'Magenta' },
                    { color: '#00FFFF', label: 'Cyan' },
                    { color: '#D3D3D3', label: 'Light Grey' }
                ]
            },
            fontSize: {
                options: [12, 14, 16, 18, 20, 24, 30, 36]
            },
            alignment: {
                options: ['left', 'center', 'right', 'justify']
            },
            image: {
                toolbar: ['imageTextAlternative', '|', 'imageStyle:full', 'imageStyle:side']
            },

        })
        .catch(error => {
            console.error(error);
        });
</script>

<script>
    // Live preview of social media links
    function livePreview(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        input.addEventListener('input', () => {
            preview.textContent = input.value ? 'Aperçu du lien : ' + input.value : '';
        });
    }

    livePreview('facebookInput', 'facebookPreview');
    livePreview('instagramInput', 'instagramPreview');
    livePreview('youtubeInput', 'youtubePreview');
</script>

<script>
    const citiesByCountry = {
        "Maroc": ["Casablanca", "Rabat", "Fès", "Marrakech", "Agadir", "Tanger", "Meknès", "Oujda", "Tétouan", "Safi", "El Jadida", "Khouribga", "Béni Mellal", "Nador", "Kénitra", "Laâyoune", "Mohammédia"],
        "Algérie": ["Alger", "Oran", "Constantine", "Annaba", "Blida", "Batna", "Sétif", "Béjaïa", "Tlemcen", "Tizi Ouzou", "Ouargla", "Ghardaïa", "Skikda", "Biskra", "Mostaganem"],
        "Tunisie": ["Tunis", "Sfax", "Sousse", "Kairouan", "Gabès", "Bizerte", "Ariana", "Gafsa", "Nabeul", "Monastir", "Ben Arous", "Kasserine", "Médenine", "Tozeur", "Mahdia"],
        "Libye": ["Tripoli", "Benghazi", "Misrata", "Zawiya", "Zliten", "Ajdabiya", "Tobrouk", "Sabha", "Derna", "Khoms", "Sirte", "Ghadames"],
        "Égypte": ["Le Caire", "Alexandrie", "Gizeh", "Shubra El-Kheima", "Port-Saïd", "Suez", "Luxor", "Assouan", "Mansoura", "Tanta", "Ismaïlia", "Faiyum", "Damanhur", "Zagazig", "Asyut"],
        "Mauritanie": ["Nouakchott", "Nouadhibou", "Kaédi", "Zouérat", "Rosso", "Kiffa", "Sélibaby", "Atar", "Tidjikja", "Néma", "Boutilimit", "Akjoujt"]
    };

    document.addEventListener('DOMContentLoaded', function () {
        const paysSelect = document.getElementById('pays');
        const villeSelect = document.getElementById('ville');

        // Get old or existing values from Laravel
        const selectedPays = "{{ old('pays', $event->pays ?? '') }}";
        const selectedVille = "{{ old('ville', $event->ville ?? '') }}";

        function updateCities(pays, selectedCity = '') {
            villeSelect.innerHTML = '<option value="">-- Sélectionnez une ville --</option>';

            if (citiesByCountry[pays]) {
                citiesByCountry[pays].forEach(function (ville) {
                    const option = document.createElement('option');
                    option.value = ville;
                    option.textContent = ville;
                    if (ville === selectedCity) {
                        option.selected = true;
                    }
                    villeSelect.appendChild(option);
                });
            }
        }

        // Initial population on page load
        if (selectedPays) {
            paysSelect.value = selectedPays;
            updateCities(selectedPays, selectedVille);
        }

        // Update cities dynamically on country change
        paysSelect.addEventListener('change', function () {
            updateCities(this.value);
        });
    });
</script>

@endpush
@endsection
