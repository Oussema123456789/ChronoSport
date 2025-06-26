@extends('admin.home1')

@section('contenu')
<div class="page-wrapper">
    <div class="page-content">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
<div class="row">
    <div class="col-xl-8 mx-auto">
        <h6 class="mb-0 text-uppercase">Ajout d'Événement</h6>
        <hr/>
        <div class="card border-top border-0 border-4 border-danger shadow">

            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center mb-4">
                    <div><i class="bx bxs-calendar-event me-2 font-22 text-primary"></i></div>
                    <h4 class="mb-0 text-primary">Nouvel Événement</h4>
                </div>
        <form action="{{ route('evenements.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf


                    <div class="card">
                        <div class="card-body">
                            <div class="p-4 border rounded">

                                <div class="row g-3">

                                    <!-- Nom -->
                                    <div class="col-md-6">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @elseif(old('nom')) is-valid @enderror" value="{{ old('nom') }}" required>
                                        <div class="valid-feedback">Looks good!</div>
                                        @error('nom')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                        <!-- Pays -->
                                        <div class="col-md-6">
                                            <label for="pays" class="form-label">Pays</label>
                                            <select name="pays" id="pays" class="form-select @error('pays') is-invalid @enderror" required>
                                                <option value="">-- Sélectionnez un pays --</option>
                                                <option value="Maroc" {{ old('pays') == 'Maroc' ? 'selected' : '' }}>Maroc</option>
                                                <option value="Algérie" {{ old('pays') == 'Algérie' ? 'selected' : '' }}>Algérie</option>
                                                <option value="Tunisie" {{ old('pays') == 'Tunisie' ? 'selected' : '' }}>Tunisie</option>
                                                <option value="Libye" {{ old('pays') == 'Libye' ? 'selected' : '' }}>Libye</option>
                                                <option value="Égypte" {{ old('pays') == 'Égypte' ? 'selected' : '' }}>Égypte</option>
                                                <option value="Mauritanie" {{ old('pays') == 'Mauritanie' ? 'selected' : '' }}>Mauritanie</option>
                                            </select>
                                            @error('pays')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Ville -->
                                        <div class="col-md-6">
                                            <label for="ville" class="form-label">Ville</label>
                                            <select name="ville" id="ville" class="form-select @error('ville') is-invalid @enderror" required>
                                                <option value="">-- Sélectionnez une ville --</option>
                                            </select>
                                            @error('ville')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    <!-- Adresse -->
                                    <div class="col-md-6">
                                        <label for="adresse" class="form-label">Adresse</label>
                                        <input type="text" name="adresse" id="adresse" class="form-control @error('adresse') is-invalid @elseif(old('adresse')) is-valid @enderror" value="{{ old('adresse') }}" required>
                                        @error('adresse')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Date -->
                                    <div class="col-md-6">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" name="date" id="date"
                                            class="form-control @error('date') is-invalid @elseif(old('date')) is-valid @enderror"
                                            value="{{ old('date') }}"
                                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                            required>
                                        @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Image de couverture -->
                                    <div class="col-md-6">
                                        <label for="image_couverture" class="form-label">Image de couverture</label>
                                        <input type="file" name="image_couverture" id="image_couverture" class="form-control @error('image_couverture') is-invalid @enderror" required>
                                        @error('image_couverture')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Image de profil -->
                                    <div class="col-md-6">
                                        <label for="image_profile" class="form-label">Image de profil</label>
                                        <input type="file" name="image_profile" id="image_profile" class="form-control @error('image_profile') is-invalid @enderror" required>
                                        @error('image_profile')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Type -->
                                    <div class="col-md-6">
                                        <label for="type" class="form-label">Type d'événement</label>
                            <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez un type --</option>
                                <option value="Course à pied" {{ old('type') == 'Course à pied' ? 'selected' : '' }}>Course à pied</option>
                                <option value="Trail" {{ old('type') == 'Trail' ? 'selected' : '' }}>Trail</option>
                                <option value="Cyclisme" {{ old('type') == 'Cyclisme' ? 'selected' : '' }}>Cyclisme</option>
                                <option value="VTT" {{ old('type') == 'VTT' ? 'selected' : '' }}>VTT</option>
                                <option value="Triathlon" {{ old('type') == 'Triathlon' ? 'selected' : '' }}>Triathlon</option>
                                <option value="Duathlon" {{ old('type') == 'Duathlon' ? 'selected' : '' }}>Duathlon</option>
                                <option value="Natation" {{ old('type') == 'Natation' ? 'selected' : '' }}>Natation</option>
                                <option value="Randonnée" {{ old('type') == 'Randonnée' ? 'selected' : '' }}>Randonnée</option>
                                <option value="Marche" {{ old('type') == 'Marche' ? 'selected' : '' }}>Marche</option>
                                <option value="Course d'obstacle" {{ old('type') == "Course d'obstacle" ? 'selected' : '' }}>Course d'obstacle</option>
                            </select>

                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Site Web -->
                                    <div class="col-md-6">
                                        <label for="site_web" class="form-label">Site Web</label>
                                        <input type="text" name="site_web" id="site_web" class="form-control @error('site_web') is-invalid @enderror" value="{{ old('site_web') }}">
                                        @error('site_web')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Téléphone -->
                                    <div class="col-md-6">
                                        <label for="tel" class="form-label">Téléphone</label>
                                        <input type="text" name="tel" id="tel" class="form-control @error('tel') is-invalid @enderror" value="{{ old('tel') }}" required>
                                        @error('tel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Facebook -->
                                    <div class="col-md-6">
                                        <label for="facebookInput" class="form-label">Lien Facebook</label>
                                        <input type="url" name="facebook" id="facebookInput" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook') }}">
                                        <small id="facebookPreview" class="text-muted"></small>
                                        @error('facebook')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Instagram -->
                                    <div class="col-md-6">
                                        <label for="instagramInput" class="form-label">Lien Instagram</label>
                                        <input type="url" name="instagram" id="instagramInput" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram') }}">
                                        <small id="instagramPreview" class="text-muted"></small>
                                        @error('instagram')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- YouTube -->
                                    <div class="col-md-6">
                                        <label for="youtubeInput" class="form-label">Lien YouTube</label>
                                        <input type="url" name="youtube" id="youtubeInput" class="form-control @error('youtube') is-invalid @enderror" value="{{ old('youtube') }}">
                                        <small id="youtubePreview" class="text-muted"></small>
                                        @error('youtube')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Description Editor -->
                                    <div class="col-12">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" rows="10" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Règlement -->
                                    <div class="col-12">
                                        <label for="reglement" class="form-label">Règlement (PDF seulement)</label>
                                        <input type="file" name="reglement" id="reglement" class="form-control @error('reglement') is-invalid @enderror" accept="application/pdf" required>
                                        @error('reglement')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>

                                </div>

                            </div> <!-- .p-4 -->
                        </div> <!-- .card-body -->
                    </div> <!-- .card -->

                </div>

        </div>            </form>
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
    // Pays -> Ville dynamic selection
    const citiesByCountry = {
        "Maroc": [
            "Casablanca", "Rabat", "Fès", "Marrakech", "Agadir", "Tanger",
            "Meknès", "Oujda", "Tétouan", "Safi", "El Jadida", "Khouribga",
            "Béni Mellal", "Nador", "Kénitra", "Laâyoune", "Mohammédia"
        ],
        "Algérie": [
            "Alger", "Oran", "Constantine", "Annaba", "Blida", "Batna",
            "Sétif", "Béjaïa", "Tlemcen", "Tizi Ouzou", "Ouargla", "Ghardaïa",
            "Skikda", "Biskra", "Mostaganem"
        ],
        "Tunisie": [
            "Tunis", "Sfax", "Sousse", "Kairouan", "Gabès", "Bizerte",
            "Ariana", "Gafsa", "Nabeul", "Monastir", "Ben Arous", "Kasserine",
            "Médenine", "Tozeur", "Mahdia"
        ],
        "Libye": [
            "Tripoli", "Benghazi", "Misrata", "Zawiya", "Zliten",
            "Ajdabiya", "Tobrouk", "Sabha", "Derna", "Khoms", "Sirte", "Ghadames"
        ],
        "Égypte": [
            "Le Caire", "Alexandrie", "Gizeh", "Shubra El-Kheima", "Port-Saïd",
            "Suez", "Luxor", "Assouan", "Mansoura", "Tanta", "Ismaïlia", "Faiyum",
            "Damanhur", "Zagazig", "Asyut"
        ],
        "Mauritanie": [
            "Nouakchott", "Nouadhibou", "Kaédi", "Zouérat", "Rosso", "Kiffa",
            "Sélibaby", "Atar", "Tidjikja", "Néma", "Boutilimit", "Akjoujt"
        ]
    };

    document.addEventListener('DOMContentLoaded', function() {
        const paysSelect = document.getElementById('pays');
        const villeSelect = document.getElementById('ville');

        function updateCities() {
            const selectedPays = paysSelect.value;
            villeSelect.innerHTML = '<option value="">-- Sélectionnez une ville --</option>';

            if (citiesByCountry[selectedPays]) {
                citiesByCountry[selectedPays].forEach(function(ville) {
                    const option = document.createElement('option');
                    option.value = ville;
                    option.textContent = ville;
                    villeSelect.appendChild(option);
                });
            }
        }

        paysSelect.addEventListener('change', updateCities);

        // Auto-load old selected pays/cities if available (Laravel old input)
        @if(old('pays'))
            updateCities();
            @if(old('ville'))
                document.addEventListener('DOMContentLoaded', function() {
                    villeSelect.value = "{{ old('ville') }}";
                });
            @endif
        @endif
    });
</script>
@endpush

@endsection
