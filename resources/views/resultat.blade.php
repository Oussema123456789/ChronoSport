@extends('template')

@section('contenu')

<!-- Menu Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="section-title ff-secondary text-center text-primary fw-normal">Tous les Résultats</h3>
            <h1 class="mb-5">Nos événements</h1>
        </div>

        <!-- Filters -->
        <div class="row mt-4">
            <div class="col-md-3">
                <h5>ANNÉES</h5>
                <div class="btn-group d-flex justify-content-center align-items-center" role="group" aria-label="Année" id="year-buttons"></div>
            </div>
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
            <div class="col-md-3">
                <h5>SPORTS</h5>
                <select class="form-select filter-sport">
                    <option value="">(Tous les sports)</option>
                    <option value="athlétisme">Athlétisme</option>
                    <option value="football">Football</option>
                    <option value="cyclisme">Cyclisme</option>
                    <option value="natation">Natation</option>
                    <option value="marathon">Marathon</option>
                </select>
            </div>
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

                <a href="{{ route('resultatx.show', $event->id) }}" class="btn btn-primary">Résultats</a>



            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Menu End -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentYear = new Date().getFullYear();
        const yearButtonsContainer = document.getElementById("year-buttons");
        const monthFilter = document.querySelector(".filter-month");
        const sportFilter = document.querySelector(".filter-sport");
        const searchFilter = document.querySelector(".filter-search");
        const eventContainer = document.getElementById("eventGrid");

        // Pass events from Laravel to JavaScript
        // Example events (à remplacer par vos données dynamiques)


        // Generate event cards dynamically (4 cards per row)
        function generateEventCards(filteredEvents) {
            eventContainer.innerHTML = ''; // Clear existing cards

            // Create an array to store rows
            let eventRows = [];
            let row = [];
            filteredEvents.forEach((resultat, index) => {
                row.push(resultat);

                // After every 4th event or at the end of the array, push the row to the rows array
                if (row.length === 4 || index === filteredEvents.length - 1) {
                    eventRows.push(row);
                    row = []; // Reset row for next batch of events
                }
            });

            // Generate rows in the event container
            eventRows.forEach(row => {
                const rowDiv = document.createElement('div');
                rowDiv.classList.add('row', 'mt-4');

                row.forEach(resultat => {
                    const eventCard = document.createElement("div");
                    eventCard.classList.add("col-md-3", "mb-4", "event-card");

                    eventCard.innerHTML = `
                        <div class="card shadow-lg border-0 rounded overflow-hidden">
                            <img src="${resultat.image}" alt="${resultat.name}"
                                class="card-img-top img-fluid"
                                style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">${resultat.name}</h5>
                                <p class="card-text text-muted">${resultat.location}, ${resultat.month} ${resultat.year}</p>
                                <p class="card-text">${resultat.description}</p>
                                <a href="/resultats/${resultat.id}" class="btn btn-primary">Résultat</a>
                            </div>
                        </div>
                    `;
                    rowDiv.appendChild(eventCard);
                });

                eventContainer.appendChild(rowDiv); // Append row to the main event grid
            });
        }

        // Function to generate the year buttons dynamically
        function generateYearButtons(year) {
            yearButtonsContainer.innerHTML = ""; // Clear buttons

            const yearsToShow = [year - 1, year, year + 1];
            yearsToShow.forEach(y => {
                const button = document.createElement("button");
                button.classList.add("btn", "btn-dark", "filter-year", "me-1");
                button.setAttribute("data-year", y);
                button.textContent = y;

                if (y === year) {
                    button.classList.add("active");
                }

                button.addEventListener("click", function () {
                    document.querySelectorAll(".filter-year").forEach(btn => btn.classList.remove("active"));
                    this.classList.add("active");
                    generateYearButtons(Number(this.textContent)); // Update buttons dynamically
                    filterEvents();
                });

                yearButtonsContainer.appendChild(button);
            });
        }

        // Function to filter events based on the selected year, month, sport, and search
        function filterEvents() {
            const selectedYear = document.querySelector(".filter-year.active") ? document.querySelector(".filter-year.active").dataset.year : currentYear;
            const selectedMonth = monthFilter.value.toLowerCase();
            const selectedSport = sportFilter.value.toLowerCase();
            const searchText = searchFilter.value.toLowerCase();

            const filteredEvents = resultats.filter(resultat => {
                const matchYear = resultat.year.toString() === selectedYear;
                const matchMonth = selectedMonth === "" || resultat.month.toLowerCase() === selectedMonth;
                const matchSport = selectedSport === "" || resultat.sport.toLowerCase() === selectedSport;
                const matchSearch = resultat.name.toLowerCase().includes(searchText) || resultat.location.toLowerCase().includes(searchText);

                return matchYear && matchMonth && matchSport && matchSearch;
            });

            generateEventCards(filteredEvents);
        }

        // Initialize the page
        generateYearButtons(currentYear);
        filterEvents();

        // Add event listeners for filters
        monthFilter.addEventListener("change", filterEvents);
        sportFilter.addEventListener("change", filterEvents);
        searchFilter.addEventListener("input", filterEvents);
    });
</script>

@endsection
