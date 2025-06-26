@extends('template')
@section('contenu')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
    .how-other-disclosure {
        display: none;
        margin: 5px 0 0 5px;
    }

    #how-other:checked ~ .how-other-disclosure {
        display: block;
    }
</style>

<div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
    <!-- Section Événements à venir -->
    <section class="container my-5">
        <h2 class="text-center fw-bold">Évènements à venir</h2>

        <!-- Filtres -->
        <div class="row mt-4">
            <div class="col-md-3">
                <h5>ANNÉES</h5>
                <div class="btn-group" role="group" aria-label="Année" id="year-buttons"></div>
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

        <!-- Tableau des événements -->
        <table class="table table-hover mt-4 rounded shadow-lg">
            <thead class="bg-primary text-white">
                <tr>
                    <th>ÉVÉNEMENT</th>
                    <th>Organisateur</th>
                    <th>Emplacement</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody id="eventsTable">
                @foreach ($evenements as $event)
                    <tr
                        data-year="{{ \Carbon\Carbon::parse($event->date)->format('Y') }}"
                        data-month="{{ \Carbon\Carbon::parse($event->date)->format('F') }}"
                        data-sport="{{ $event->sport }}"
                        data-href="{{ route('admin.event.show', $event->id) }}"
                        style="cursor: pointer;"
                    >
                        <td>
                            <img src="{{ asset('storage/' . $event->image_couverture) }}"

                                 width="50"
                                 class="img-thumbnail">
                            🏃 {{ $event->nom }}
                        </td>
                        <td>{{ $event->organisateur }}</td>
                        <td>{{ $event->emplacement }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentYear = new Date().getFullYear();
        const yearButtonsContainer = document.getElementById("year-buttons");
        const monthFilter = document.querySelector(".filter-month");
        const sportFilter = document.querySelector(".filter-sport");
        const searchFilter = document.querySelector(".filter-search");
        const eventRows = document.querySelectorAll("#eventsTable tr");

        let activeYear = currentYear;

        function generateYearButtons(centerYear) {
            yearButtonsContainer.innerHTML = "";
            const yearsToShow = [centerYear - 1, centerYear, centerYear + 1];
            yearsToShow.forEach(year => {
                const button = document.createElement("button");
                button.classList.add("btn", "btn-dark", "filter-year", "mx-1");
                button.setAttribute("data-year", year);
                button.textContent = year;
                if (year === centerYear) button.classList.add("active");
                button.addEventListener("click", function () {
                    activeYear = parseInt(this.dataset.year);
                    generateYearButtons(activeYear);
                    filterEvents();
                });
                yearButtonsContainer.appendChild(button);
            });
        }

        function filterEvents() {
            const selectedMonth = monthFilter.value.toLowerCase();
            const selectedSport = sportFilter.value.toLowerCase();
            const searchText = searchFilter.value.trim().toLowerCase();

            eventRows.forEach(row => {
                const eventYear = parseInt(row.dataset.year);
                const eventMonth = row.dataset.month.toLowerCase();
                const eventSport = row.dataset.sport.toLowerCase();
                const eventText = row.innerText.toLowerCase();

                let showRow = false;

                if (searchText !== "") {
                    const matchSearch = eventText.includes(searchText);
                    const matchMonth = !selectedMonth || eventMonth === selectedMonth;
                    const matchSport = !selectedSport || eventSport === selectedSport;
                    showRow = matchSearch && matchMonth && matchSport;
                } else {
                    const matchYear = eventYear === activeYear;
                    const matchMonth = !selectedMonth || eventMonth === selectedMonth;
                    const matchSport = !selectedSport || eventSport === selectedSport;
                    showRow = matchYear && matchMonth && matchSport;
                }

                row.style.display = showRow ? "" : "none";
            });
        }

        generateYearButtons(currentYear);
        activeYear = currentYear;
        filterEvents();

        monthFilter.addEventListener("change", filterEvents);
        sportFilter.addEventListener("change", filterEvents);
        searchFilter.addEventListener("input", filterEvents);
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll("#eventsTable tr").forEach(row => {
            row.addEventListener("click", function () {
                const url = row.dataset.href;
                if (url) {
                    window.location.href = url;
                }
            });
        });
    });
</script>
@endsection
