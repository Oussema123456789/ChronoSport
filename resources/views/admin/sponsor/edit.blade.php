@extends('admin.template')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <h6 class="mb-0 text-uppercase">Modifier un Sponsor</h6>
                <hr/>
                <div class="card border-top border-0 border-4 border-warning">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bxs-megaphone me-1 font-22 text-warning"></i></div>
                                <h5 class="mb-0 text-warning">Formulaire de modification du Sponsor</h5>
                            </div>
                            <hr/>

                            {{-- Errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Oups !</strong> Des erreurs sont survenues :
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Form --}}
                            <form action="{{ route('events.sponsors.update', ['event' => $sponsor->evenement_id, 'sponsor' => $sponsor->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Hidden input for event ID --}}
                                <input type="hidden" name="evenement_id" value="{{ $sponsor->evenement_id }}">

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Nom du Sponsor</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nom" value="{{ old('nom', $sponsor->nom) }}" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Image actuelle</label>
                                    <div class="col-sm-9">
                                        @if ($sponsor->image)
                                            <img src="{{ asset('storage/' . $sponsor->image) }}" class="img-thumbnail mb-2" style="height: 80px;">
                                        @endif
                                        <input type="file" name="image" class="form-control mt-2">
                                        <small class="text-muted">Laissez vide si vous ne souhaitez pas changer l’image.</small>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 d-flex gap-2">
                                        <button type="submit" class="btn btn-warning px-4">Mettre à jour</button>
                                        <a href="{{ route('events.sponsors.index', ['event' => $sponsor->evenement_id]) }}" class="btn btn-secondary px-4">Annuler</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
