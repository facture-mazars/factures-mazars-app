@extends('layouts.app')

@section('content')
<div class="container">
    <div class="title-wrapper pt-30">
        <h2>Modifier le Taux</h2>
    </div>

    <!-- Afficher les erreurs de validation -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Bouton pour retourner à la liste des taux -->
    <a href="{{ route('taux.index') }}" class="btn btn-secondary mb-3">Voir la Liste des Taux</a>

    <!-- Formulaire de modification -->
    <form action="{{ route('taux.update', $taux->id_taux) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Champ type -->
            <div class="col-xxl-4">
                <div class="input-style-1">
                    <label for="types">Type :</label>
                    <input type="text" id="types" name="types" value="{{ old('types', $taux->types) }}" required>
                </div>
            </div>

            <!-- Champ pourcentage -->
            <div class="col-xxl-4">
                <div class="input-style-1">
                    <label for="pourcentage">Pourcentage :</label>
                    <input type="number" id="pourcentage" name="pourcentage" value="{{ old('pourcentage', $taux->pourcentage) }}" required>
                </div>
            </div>

            <!-- Bouton de soumission -->
            <div class="col-12">
                <button type="submit" class="main-btn primary-btn btn-hover">Mettre à jour</button>
            </div>
        </div>
    </form>
</div>
@endsection
