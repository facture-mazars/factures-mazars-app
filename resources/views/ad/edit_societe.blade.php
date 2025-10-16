@extends('layouts.app')

@section('content')



<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2>Modifier Chèque Banque</h2>
            </div>
        </div>
        <div class="col-md-6">
            <div style="text-align: end;">
               <!-- Bouton pour retourner à la liste des sociétés -->
    <a href="{{ route('enregistrement.create') }}" class="btn btn-secondary mb-3">Voir la Liste des Sociétés</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-style settings-card-2 mb-30">
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

          

    <!-- Formulaire de modification de société -->
    <form action="{{ route('societe.update', $societe->id_societe) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Champ nom de la société -->
            <div class="col-xxl-4">
                <div class="input-style-1">
                    <label for="nom_societe">Nom de la société :</label>
                    <input type="text" id="nom_societe" name="nom_societe" value="{{ old('nom_societe', $societe->nom_societe) }}" required>
                </div>
            </div>

            <!-- Champ rue -->
            <div class="col-xxl-4">
                <div class="input-style-1">
                    <label for="rue">Rue :</label>
                    <input type="text" id="rue" name="rue" value="{{ old('rue', $societe->rue) }}" required>
                </div>
            </div>

            <!-- Champ addresse -->
            <div class="col-xxl-4">
                <div class="input-style-1">
                    <label for="addresse">Adresse :</label>
                    <input type="text" id="addresse" name="addresse" value="{{ old('addresse', $societe->addresse) }}" required>
                </div>
            </div>

            <!-- Champ téléphone -->
            <div class="col-xxl-4">
                <div class="input-style-1">
                    <label for="telephone">Téléphone :</label>
                    <input type="text" id="telephone" name="telephone" value="{{ old('telephone', $societe->telephone) }}" required>
                </div>
            </div>

            <!-- Champ email -->
            <div class="col-xxl-4">
                <div class="input-style-1">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $societe->email) }}" required>
                </div>
            </div>

            <!-- Champ raison sociale -->
            <div class="col-xxl-4">
                <div class="input-style-1">
                    <label for="raison_sociale">Raison sociale :</label>
                    <input type="text" id="raison_sociale" name="raison_sociale" value="{{ old('raison_sociale', $societe->raison_sociale) }}" required>
                </div>
            </div>

            <!-- Champ NIF -->
            <div class="col-xxl-4">
                <div class="input-style-1">
                    <label for="n_is">N° IS :</label>
                    <input type="text" id="n_is" name="n_is" value="{{ old('n_is', $societe->n_is) }}" required>
                </div>
            </div>

            <!-- Champ CIF -->
            <div class="col-xxl-4">
                <div class="input-style-1">
                    <label for="n_if">N° IF :</label>
                    <input type="text" id="n_if" name="n_if" value="{{ old('n_if', $societe->n_if) }}" required>
                </div>
            </div>

            <!-- Champ NCIF -->
            <div class="col-xxl-4">
                <div class="input-style-1">
                    <label for="n_cif">N° CIF :</label>
                    <input type="text" id="n_cif" name="n_cif" value="{{ old('n_cif', $societe->n_cif) }}" required>
                </div>
            </div>
</div>
            <!-- Bouton de soumission -->
            <div class="col-12">
                <button type="submit" class="main-btn primary-btn btn-hover">Mettre à jour</button>
            </div>
     
    </form>
</div>
</div>
</div>
@endsection
