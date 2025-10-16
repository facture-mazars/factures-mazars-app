@extends('layouts.app')

@section('content')

  
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>Modifier le contrat / chantier</h2>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('banques.update', $banque->id_banque) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom_banque">Nom de la Banque</label>
            <input type="text" name="nom_banque" id="nom_banque" class="form-control" value="{{ $banque->nom_banque }}" required>
        </div>

        <div class="form-group">
            <label for="compte">Compte</label>
            <input type="text" name="compte" id="compte" class="form-control" value="{{ $banque->compte }}" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ $banque->type }}">
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('choix.create', ['id_facture' => $idFacture]) }}" class="btn btn-secondary">Annuler</a>
    </form>
            </div>
        </div>
    </div>

@endsection



