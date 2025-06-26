@extends('template')

@section('contenu')
<div class="container py-5">
  <h2 class="mb-5 text-center">
    Classement de « {{ $epreuve->nom }} » — {{ $event->nom }}
  </h2>

  <div class="gv">
    <table id="example" class="table table-striped table-bordered grid" style="width:100%; text-align:center;">
      <thead>
        <tr>
          <th>Événement</th>
          <th>Année</th>
          <th>Course</th>
          <th>Dossard</th>
          <th>Nom & Prénom</th>
          <th>Nationalité</th>
          <th>Sexe</th>
          <th>Temps</th>
          <th>Catégorie</th>
          <th>Classement</th>
          <th>Diplôme</th>
        </tr>
      </thead>
      <tbody>
        @foreach($resultats as $index => $resultat)
          <tr>
            <td>{{ $event->nom }}</td>
            <td>{{ \Carbon\Carbon::parse($event->date)->format('Y') }}</td>
            <td>{{ $epreuve->nom }}</td>
            <td>{{ $resultat->dossard }}</td>
            <td>{{ $resultat->nom }} {{ $resultat->prenom }}</td>
            <td>{{ $resultat->nationalité ?? '—' }}</td>
            <td>{{ ucfirst($resultat->genre) }}</td>
            <td>{{ $resultat->temps }}</td>
            <td>{{ $resultat->categorie }}</td>
            <td>{{ $index + 1 }}</td>
            <td>
              <a href="{{ url('diplome/'.$resultat->id) }}" class="text-danger" title="Télécharger le diplôme">
                🏅
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(function(){
    $('#example').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
      }
    });
  });
</script>
@endpush
