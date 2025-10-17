@extends('layouts.app')

@section('content')

  <!-- Afficher le message de succès -->
  @if(session('success'))
          <br><br>
            <div id="success-message" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2>Paramètres</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="alert alert-info" style="background: #dbeafe; color: #1e40af; border-color: #3b82f6; padding: 15px; border-radius: 8px; margin-bottom: 25px;">
            <i class="lni lni-cog"></i>
            <strong>Paramètres de l'application</strong><br>
            Cette page vous permet de modifier les paramètres généraux de l'application : informations de la société, personnel, modes d'encaissement (chèques et banques), et taux de conversion.
        </div>
    </div>
</div>




<div class="row">
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30" style="margin-left:40px;">
               
                <div class="content">

                @foreach($societes as $societe)
                
    

                  <h3 class="mb-10" style="text-align: center;">{{ $societe->nom_societe }}</h3>
                  <h6 class="text-bold mb-10" style="text-align: center;">{{ $societe->rue }}, {{ $societe->addresse }}</h6>
              
                   
                    <p class="text-gray" style="text-align: center;">{{ $societe->telephone }}</p>
                    <p class="text-gray" style="text-align: center;">{{ $societe->email }}</p>
                    <p class="text-gray" style="text-align: center;">{{ $societe->raison_sociale }}</p>
                  
                  
                    @endforeach
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>




            <div class="col-xl-3 col-lg-4 col-sm-6" style="margin-left:50px;">
              <div class="icon-card mb-30">
              
                <div class="content">

                @foreach($societes as $societe)
                
    

               
              
                   
                    <p class="text-gray">N IS : <span class="text-bold"> {{ $societe->n_is }}</span></p>
                    <p class="text-gray">N IF : <span class="text-bold"> {{ $societe->n_if }}</span></p>
                    <p class="text-gray">N CIF : <span class="text-bold"> {{ $societe->n_cif }}</span></p>
<br>
<br>
                    <a href="{{ route('societe.edit', $societe->id_societe) }}" class="btn btn-secondary"><i class="lni lni-pencil"></i></a>
                    @endforeach
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
   
          </div>



<div class="row">




<div class="col-lg-7">
    
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
         

            <!-- Formulaire Liste Personnel -->
            <h3>Nouveau Personnel</h3>
            <form action="{{ route('personnel.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label for="nom_personnel">Nom :</label>
                            <input type="text" id="nom_personnel" name="nom" value="{{ old('nom', $liste_personnel->nom ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label for="prenom_personnel">Prénom :</label>
                            <input type="text" id="prenom_personnel" name="prenom" value="{{ old('prenom', $liste_personnel->prenom ?? '') }}" required>
                        </div>
                    </div>


   <!-- type_mission -->
   <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="id_grade">Grade : </label>
                        <div class="select-position">
                          <select id="id_grade" name="id_grade">
                          <option value="">Sélectionner</option>
                            @foreach($grades as $grade)
                            <option value="{{ $grade->id_grade }}">{{ $grade->types }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>

                   
                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label for="matricule">Matricule :</label>
                            <input type="text" id="matricule" name="matricule" value="{{ old('matricule', $liste_personnel->matricule ?? '') }}" required>
                        </div>
                    </div>



                </div>

    
                  
                <button type="submit" class="main-btn">Enregistrer Personnel</button>
            </form>
            </div>
    </div>


<br>


    <div class="col-lg-7">
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
                  <a href="{{ route('cheque.index') }}" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-list"></i> Voir la liste
                  </a>

                    <!-- end select -->
                  </div>
                </div>

           

            <!-- Formulaire Chèque Banque -->
            <h3>Nouveau Chèque ou Banque</h3>
            <form action="{{ route('cheque.store') }}" method="POST">
                @csrf
                <div class="row">

                <div class="col-xxl-4">
            <div class="select-style-1">
                <label for="id_mode_encaissement">Mode d'Encaissement :</label>
                <div class="select-position">
                <select id="id_mode_encaissement" name="id_mode_encaissement" required>
                    <option value="">Sélectionner</option>
                    @foreach($modeEncaissements as $mode)
                        <option value="{{ $mode->id_mode_encaissement }}" {{ old('id_mode_encaissement', $cheque_banque->id_mode_encaissement ?? '') == $mode->id_mode_encaissement ? 'selected' : '' }}>
                            {{ $mode->types }}
                        </option>
                    @endforeach
                </select>
                </div>
            </div>
        </div>


                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label for="types_cheque">Nom banque ou chèque : :</label>
                            <input type="text" id="types_cheque" name="types" value="{{ old('types', $cheque_banque->types ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label for="compte">Compte :</label>
                            <input type="text" id="compte" name="compte" value="{{ old('compte', $cheque_banque->compte ?? '') }}">
                        </div>
                    </div>

              
                </div>
                <button type="submit" class="main-btn">Enregistrer Chèque Banque</button>
            </form>
            </div>
    </div>







          
    <div class="col-lg-7">
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
                  <a href="{{ route('taux.index') }}" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-list"></i> Voir la liste
                  </a>
                    <!-- end select -->
                  </div>
                </div>
         
            <!-- Formulaire Taux -->
            <h3>Taux</h3>
            <form action="{{ route('taux.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label for="types_taux">Types :</label>
                            <input type="text" id="types_taux" name="types" value="{{ old('types', $taux->types ?? '') }}" required>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label for="pourcentage">Pourcentage :</label>
                            <input type="number" step="0.01" id="pourcentage" name="pourcentage" value="{{ old('pourcentage', $taux->pourcentage ?? '') }}" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="main-btn">Enregistrer Taux</button>
            </form>
            </div>
    </div>
</div>

@endsection
