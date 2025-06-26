@extends('template')

@section('contenu')

<!-- Menu Start -->
<div class="container-xxl py-5">
    <div class="container">
        <!-- Title Section -->
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title ff-secondary text-center text-primary fw-normal">Inscription en ligne</h3>
            <h1 class="mb-5">Nos événements</h1>
        </div>

        <!-- Filters -->
        <div class="row mt-4 g-3">
            <!-- Années -->
            <div class="col-md-3">
                <h5>ANNÉES</h5>
                <div id="year-buttons-container" style="white-space: nowrap; overflow-x: auto; padding: 10px 0;">
                    <div id="year-buttons" class="d-inline-flex gap-2"></div>
                </div>
            </div>

            <!-- Mois -->
            <div class="col-md-3">
                <h5>MOIS</h5>
                <select class="form-select filter-month">
                    <option value="">Récents</option>
                    <option value="janvier">Janvier</option>
                    <option value="février">Février</option>
                    <option value="mars">Mars</option>
                    <option value="avril">Avril</option>
                    <option value="mai">Mai</option>
                    <option value="juin">Juin</option>
                    <option value="juillet">Juillet</option>
                    <option value="août">Août</option>
                    <option value="septembre">Septembre</option>
                    <option value="octobre">Octobre</option>
                    <option value="novembre">Novembre</option>
                    <option value="décembre">Décembre</option>
                </select>
            </div>

            <!-- Sports -->
            <div class="col-md-3">
                <h5>SPORTS</h5>
                <select class="form-select filter-sport">
                    <option value="">(Tous les sports)</option>
                    <option value="athlétisme">Athlétisme</option>
                    <option value="football">Football</option>
                </select>
            </div>

            <!-- Recherche -->
            <div class="col-md-3">
                <h5>RECHERCHE</h5>
                <input type="text" class="form-control filter-search" placeholder="Nom / lieu de l'événement">
            </div>
        </div>

        <!-- Event Cards Grid -->
        <div class="row mt-5" id="eventGrid">
            @foreach($events as $event)
            <div class="col-md-3 mb-4">
                <div class="card shadow-lg border-0 rounded overflow-hidden">
                    <img src="{{ asset('storage/' . $event->image_couverture) }}" class="card-img-top img-fluid" alt="{{ $event->nom }}" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->nom }}</h5>
                        <p class="card-text text-muted">{{ $event->ville }}, {{ $event->date }}</p>

                        <a href="{{ route('public.event.epreuves', $event->id) }}" class="btn btn-primary">S'inscrire</a>

                    </div>
                </div>
            </div>
        @endforeach

        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentYear = new Date().getFullYear();
        const yearButtonsContainer = document.getElementById("year-buttons");
        const monthFilter = document.querySelector(".filter-month");
        const sportFilter = document.querySelector(".filter-sport");
        const searchFilter = document.querySelector(".filter-search");
        const eventContainer = document.getElementById("eventGrid");

        let events = @json($events);

        // 👉 Extract year, month name, and lowercase sport from event data
        events = events.map(event => {
            const dateObj = new Date(event.date);
            const monthNames = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
            return {
                ...event,
                year: dateObj.getFullYear(),
                month: monthNames[dateObj.getMonth()],
                sport: event.sport ? event.sport.toLowerCase() : ""
            };
        });

        function generateYearButtons(centerYear) {
            yearButtonsContainer.innerHTML = "";
            const years = [centerYear - 1, centerYear, centerYear + 1];

            years.forEach(year => {
                const btn = document.createElement("button");
                btn.className = "btn btn-dark filter-year";
                btn.dataset.year = year;
                btn.textContent = year;
                if (year === centerYear) btn.classList.add("active");

                btn.onclick = () => {
                    generateYearButtons(year);
                    filterEvents();
                };

                yearButtonsContainer.appendChild(btn);
            });
        }

function generateEventCards(filteredEvents) {
    eventContainer.innerHTML = "";
    filteredEvents.forEach(event => {
        const col = document.createElement("div");
        col.className = "col-md-3 mb-4";
        col.innerHTML = `
            <div class="card shadow-lg border-0 rounded overflow-hidden">
                <img src="/storage/${event.image_couverture}" class="card-img-top img-fluid" alt="${event.nom}" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">${event.nom}</h5>
                    <p class="card-text text-muted">${event.ville}, ${event.date}</p>

                    <a href="/inscription-en-ligne/${event.id}/epreuves" class="btn btn-primary">S'inscrire</a>
                </div>
            </div>
        `;
        eventContainer.appendChild(col);
    });
}


        function filterEvents() {
            const selectedYear = document.querySelector(".filter-year.active")?.dataset.year;
            const selectedMonth = monthFilter.value;
            const selectedSport = sportFilter.value;
            const searchText = searchFilter.value.toLowerCase();

            const filteredEvents = events.filter(event => {
                const matchYear = selectedYear ? event.year.toString() === selectedYear : true;
                const matchMonth = selectedMonth ? event.month === selectedMonth : true;
                const matchSport = selectedSport ? event.sport === selectedSport : true;
                const matchSearch = event.nom.toLowerCase().includes(searchText) || event.ville.toLowerCase().includes(searchText);
                return matchYear && matchMonth && matchSport && matchSearch;
            });

            generateEventCards(filteredEvents);
        }

        // Init
        generateYearButtons(currentYear);
        filterEvents();

        // Filter listeners
        monthFilter.addEventListener("change", filterEvents);
        sportFilter.addEventListener("change", filterEvents);
        searchFilter.addEventListener("input", filterEvents);
    });
</script>

@endsection
