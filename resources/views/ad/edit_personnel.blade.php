@extends('layouts.app')

@section('content')
<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2>{{ isset($societe) ? 'Modifier' : 'Créer' }} Enregistrements</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">



<div class="col-lg-6">
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

      
        <div class="title d-flex flex-wrap justify-content-between align-items-center">
                  <div class="left">

                  </div>
                  <div class="right">
                  <a href="{{ route('personnel.index') }}" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-list"></i> Voir la liste
                  </a>
                    <!-- end select -->
                  </div>
                </div>
         

        <!-- Formulaire de Modification Liste Personnel -->
        <h3>Modifier Personnel</h3>
        <form action="{{ route('pers.update', $liste_personnel->id_liste_personnel) }}" method="POST">
            @csrf
            @method('PUT') <!-- Directive pour utiliser la méthode PUT -->
            
            <div class="row">
                <div class="col-xxl-4">
                    <div class="input-style-1">
                        <label for="nom_personnel">Nom :</label>
                        <input type="text" id="nom_personnel" name="nom" value="{{ old('nom', $liste_personnel->nom) }}" required>
                    </div>
                </div>

                <div class="col-xxl-4">
                    <div class="input-style-1">
                        <label for="prenom_personnel">Prénom :</label>
                        <input type="text" id="prenom_personnel" name="prenom" value="{{ old('prenom', $liste_personnel->prenom) }}" required>
                    </div>
                </div>

                <!-- Grade -->
                <div class="col-xxl-4">
                    <div class="select-style-1">
                        <label for="id_grade">Grade : </label>
                        <div class="select-position">
                            <select id="id_grade" name="id_grade">
                                <option value="">Sélectionner</option>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade->id_grade }}" {{ old('id_grade', $liste_personnel->id_grade) == $grade->id_grade ? 'selected' : '' }}>
                                        {{ $grade->types }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Matricule -->
                <div class="col-xxl-4">
                    <div class="input-style-1">
                        <label for="matricule">Matricule :</label>
                        <input type="text" id="matricule" name="matricule" value="{{ old('matricule', $liste_personnel->matricule) }}" required>
                    </div>
                </div>

       
            </div>

            <button type="submit" class="main-btn">Mettre à jour le Personnel</button>
        </form>
    </div>
</div>
</div>

@endsection