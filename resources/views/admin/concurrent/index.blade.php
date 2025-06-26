@extends('admin.template')

@section('content')
<div class="page-content">
  <h3>Liste des concurrents</h3>
  <table class="table">
    <thead>
      <tr>
        <th>Dossard</th><th>Nom</th><th>Prénom</th><th>Épreuve</th>
      </tr>
    </thead>
    <tbody>
      @foreach($concurrents as $c)
      <tr>
        <td>{{ $c->dossard }}</td>
        <td>{{ $c->nom }}</td>
        <td>{{ $c->prenom }}</td>
        <td>{{ $c->epreuve->nom ?? '—' }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
