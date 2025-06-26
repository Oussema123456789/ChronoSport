@extends('template')

@section('contenu')

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h3 class="section-title ff-secondary text-center text-primary fw-normal">Classements des participants</h3>
                <h1 class="mb-5">Résultats de l'événement: {{ $event['name'] }}</h1>
            </div>

            <!-- Rankings Table -->
            <table id="rankingsTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Nom</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rankings as $ranking)
                        <tr>
                            <td>{{ $ranking['position'] }}</td>
                            <td>{{ $ranking['name'] }}</td>
                            <td>{{ $ranking['score'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Back to Events Button -->
            <a href="{{ route('resultat.index') }}" class="btn btn-secondary mt-4">Retour aux événements</a>
        </div>
    </div>
    @push('scripts')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/v/dt/dt-2.2.2/datatables.min.css" rel="stylesheet" integrity="sha384-2vMryTPZxTZDZ3GnMBDVQV8OtmoutdrfJxnDTg0bVam9mZhi7Zr3J1+lkVFRr71f" crossorigin="anonymous">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/v/dt/dt-2.2.2/datatables.min.js" integrity="sha384-2Ul6oqy3mEjM7dBJzKOck1Qb/mzlO+k/0BQv3D3C7u+Ri9+7OBINGa24AeOv5rgu" crossorigin="anonymous"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#rankingsTable').DataTable();
        });
    </script>
@endpush

@endsection


