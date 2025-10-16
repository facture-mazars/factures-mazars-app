@extends('layouts.app')
       
@section('content')

<form action="{{ route('client.store') }}" method="POST">
@csrf



          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-10">
                <div class="title">
                <h2>Créer un client</h2>
                </div>
              </div>
              <div class="col-xxl-2" style="float:inline-end;">
               
                      <div class="input-style-2" style="background-color:white;">
                    
                      <input type="text" name="code_client" id="code_client" class="form-control" placeholder="Code client">
                      </div>
                  
                
               
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->


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
               
                  <div class="row">

                       
                  <!-- nom_client -->
                    <div class="col-xxl-4">
                      <div class="input-style-1">
                        <label for="nom_client">CLIENT : <span class="text-danger">*</span>  </label>
                        <input type="text" id="nom_client" name="nom_client" value="{{ old('nom_client') }}" required>
       
                      </div>
                    </div>

                    <!-- sigle_client -->
                    <div class="col-xxl-4">
                      <div class="input-style-1">
                        <label for="sigle_client">Sigle client : <span class="text-danger">*</span> </label>
                        <input type="text" id="sigle_client" name="sigle_client" value="{{ old('sigle_client') }}" required>
      
                      </div>
                    </div>

                      <!-- adresse_client -->
                      <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="adresse_client">Adresse : <span class="text-danger">*</span> </label>
                        <input type="text" id="adresse_client" name="adresse_client" value="{{ old('adresse_client') }}" required>
                        </div>
                    </div>

                         <!-- telephone_societe -->
                         <div class="col-xxl-4">
                      <div class="input-style-1">
                        <label for="telephone_societe">Telephone société : <span class="text-danger">*</span> </label>
                        <input type="text" id="telephone_societe" name="telephone_societe" value="{{ old('telephone_societe') }}">
      
                      </div>
                    </div>

                      <!-- email_societe -->
                      <div class="col-xxl-4">
                      <div class="input-style-1">
                        <label for="email_societe">Email société : <span class="text-danger">*</span> </label>
                        <input type="text" id="email_societe" name="email_societe" value="{{ old('email_societe') }}">
      
                      </div>
                    </div>


                    <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="n_rcs">Numero RCS :</label>
                      <input type="text" id="n_rcs" name="n_rcs" value="{{ old('n_rcs') }}">
                      </div>
                    </div>


                    <div class="col-xxl-4">
                      <div class="input-style-1">
                       <label for="n_stat">Numero STAT:</label>
                        <input type="text" id="n_stat" name="n_stat" value="{{ old('n_stat') }}">
                      </div>
                    </div>


                    <div class="col-xxl-4">
                      <div class="input-style-1">
                        <label for="n_nif">Numero NIF :</label>
                            <input type="text" id="n_nif" name="n_nif" value="{{ old('n_nif') }}">
                      </div>
                    </div>


                    <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="n_cif">Numero CIF:</label>
                        <input type="text" id="n_cif" name="n_cif" value="{{ old('n_cif') }}">
                      </div>
                    </div>

                         <!-- type -->
            <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="type">Type :</label>
                          <div class="select-position">
                            <select class="light-bg" id="type" name="type">
                            <option value="">Sélectionner</option>
                                <option value="PIE">PIE</option>
                                <option value="OMB">OMB</option>
                                </select>
                      </div>
                   </div>
                </div>


                  <!-- id_pays -->
                    <div class="col-xxl-4">
                    <div class="select-style-1">
                        <label for="id_pays">Pays :</label>
                        <div class="select-position">
                        <select class="light-bg" id="id_pays" name="id_pays" onchange="toggleNewCountryForm(this.value)">
                            @foreach($pays as $pay)
                            <option value="{{ $pay->id_pays }}" 
                                @if($pay->id_pays == 1) selected @endif>
                                {{ $pay->nom_pays }}
                            </option>
                            @endforeach
                            <option value="add_new_country"><i class="mdi mdi-movie-plus">Nouveau pays</i></option>
                        </select>
                        </div>
                    </div>
                    </div>


                      <!-- pays -->
                      <div class="col-xxl-4" id="new_country_form" style="display:none;">
                      <div class="input-style-1">
                    
                   
                                <label for="new_country">Nouveau pays :</label>
                                <input type="text" class="form-control" id="new_country" name="new_country">
                         
                        </div>
                    </div>


                    <script>
    function toggleNewCountryForm(value) {
        var newCountryForm = document.getElementById('new_country_form');
        if (value === 'add_new_country') {
            // Afficher le formulaire pour entrer un nouveau pays
            newCountryForm.style.display = 'block';
        } else {
            // Masquer le formulaire pour entrer un nouveau pays
            newCountryForm.style.display = 'none';
        }
    }
</script>


                    <!-- ville_siege -->
                    <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="ville_siege">Ville siege:</label>
                        <input type="text" id="ville_siege" name="ville_siege" value="{{ old('ville_siege') }}">
                        </div>
                    </div>

                       <!-- zone_geographique -->
                       <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="zone_geographique">Zone geographique:</label>
                        <input type="text" id="zone_geographique" name="zone_geographique" value="{{ old('zone_geographique') }}">
                        </div>
                    </div>


                               <!-- id_secteur_activite -->
                               <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="id_subsector">Secteur d'activité :</label>
                        <div class="select-position">
                          <select class="light-bg" id="id_secteur_activite" name="id_secteur_activite">
                    
                            @foreach($secteurActivites as $row)
                                <option value="{{ $row->id_secteur_activite }}">{{ $row->code_secteur }} - {{ $row->nom_secteur_activite }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>

                <!-- contact_aupres_client -->
               <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="contact_aupres_client">Contact aupres du client:</label>
                        <input type="text" id="contact_aupres_client" name="contact_aupres_client" value="{{ old('contact_aupres_client') }}">
                        </div>
                    </div>

                      <!-- fonction_contact -->
               <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="fonction_contact">Fonction contact:</label>
                        <input type="text" id="fonction_contact" name="fonction_contact" value="{{ old('fonction_contact') }}">
                        </div>
                    </div>

                      <!-- tel_contact -->
               <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="tel_contact">Telephone contact:</label>
                        <input type="text" id="tel_contact" name="tel_contact" value="{{ old('tel_contact') }}">
                        </div>
                    </div>


                       <!-- mail_contact -->
               <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="mail_contact">Mail contact:</label>
                        <input type="email" id="mail_contact" name="mail_contact" value="{{ old('mail_contact') }}">
                        </div>
                    </div>


                                  <!-- nom_groupe -->
                                  <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="nom_groupe_">Nom groupe :</label>
                        <input type="text" id="nom_groupe" name="nom_groupe" value="{{ old('nom_groupe') }}">
                        </div>
                    </div>

                     <!-- id_pays_groupe -->
                     <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="id_pays_groupe">Pays Groupe:</label>
                        <div class="select-position">
                          <select class="light-bg" id="id_pays_groupe" name="id_pays_groupe" onchange="toggleNewCountryFormGroup(this.value)">
                            <option value="">Selectionner</option>
                          @foreach($pays as $pay)
                            <option value="{{ $pay->id_pays }}">
                                {{ $pay->nom_pays }}
                            </option>
                            @endforeach
                            <option value="add_new_country_groupe"><i class="mdi mdi-movie-plus">Nouveau pays</i></option>
                        </select>
                        </div>
                    </div>
                    </div>


                      <!-- Pays -->
                      <div class="col-xxl-4" id="new_country_form_group" style="display:none;">
                      <div class="input-style-1">
                    
                   
                                <label for="new_country_groupe">Nouveau pays :</label>
                                <input type="text" class="form-control" id="new_country_groupe" name="new_country_groupe">
                         
                        </div>
                    </div>


                    <script>
    function toggleNewCountryFormGroup(value) {
        var newCountryForm = document.getElementById('new_country_form_group');
        if (value === 'add_new_country_groupe') {
            // Afficher le formulaire pour entrer un nouveau pays
            newCountryForm.style.display = 'block';
        } else {
            // Masquer le formulaire pour entrer un nouveau pays
            newCountryForm.style.display = 'none';
        }
    }
</script>


            

                            <!-- bvdid -->
                            <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="bvdid_">BVDID :</label>
                        <input type="text" id="bvdid" name="bvdid" value="{{ old('bvdid') }}">
                        </div>
                    </div>

                      <!-- restrictions -->
                      <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="restrictions_">restrictions :</label>
                        <input type="text" id="restrictions" name="restrictions" value="{{ old('restrictions') }}">
                        </div>
                    </div>


                      <!-- id_forme_juridique -->
                      <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="id_forme_juridique">Forme juridique :</label>
                        <div class="select-position">
                          <select class="light-bg" id="id_forme_juridique" name="id_forme_juridique" onchange="toggleNewFormeJuridique(this.value)">
                        <option value="">Selectionner</option>
                            @foreach($formeJuridiques as $row)
                                <option value="{{ $row->id_forme_juridique }}">{{ $row->types }}</option>
                            @endforeach
                            <option value="add_new_forme_juridique"><i class="mdi mdi-movie-plus">Nouvelle forme juridique</i></option>
                          </select>
                        </div>
                      </div>
                    </div>


                             <!-- adresse_client -->
                             <div class="col-xxl-4" id="new_fj" style="display:none;">
                      <div class="input-style-1">
                    
                   
                                <label for="new_forme_juridique">Nouvelle forme juridique :</label>
                                <input type="text" class="form-control" id="new_forme_juridique" name="new_forme_juridique">
                         
                        </div>
                    </div>

                    <script>
    function toggleNewFormeJuridique(value) {
        var newCountryForm = document.getElementById('new_fj');
        if (value === 'add_new_forme_juridique') {
            // Afficher le formulaire pour entrer un nouveau pays
            newCountryForm.style.display = 'block';
        } else {
            // Masquer le formulaire pour entrer un nouveau pays
            newCountryForm.style.display = 'none';
        }
    }
</script>

                      <!-- dg -->
                      <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="dg_">Directeur general :</label>
                        <input type="text" id="dg" name="dg" value="{{ old('dg') }}">
                        </div>
                    </div>

                      <!-- daf -->
                      <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="daf_">DAF :</label>
                        <input type="text" id="daf" name="daf" value="{{ old('daf') }}">
                        </div>
                    </div>

                      <!-- directeur_juridique -->
                      <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="directeur_juridique_">directeur juridique :</label>
                        <input type="text" id="directeur_juridique" name="directeur_juridique" value="{{ old('directeur_juridique') }}">
                        </div>
                    </div>

                      <!-- controle_interne -->
                      <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="controle_interne_">Controle interne :</label>
                        <input type="text" id="controle_interne" name="controle_interne" value="{{ old('controle_interne') }}">
                        </div>
                    </div>

                      <!-- dsi -->
                      <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="dsi_">DSI :</label>
                        <input type="text" id="dsi" name="dsi" value="{{ old('dsi') }}">
                        </div>
                    </div>

                      <!-- ca -->
                      <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="ca_">Conseil d'administration:</label>
                        <input type="text" id="ca" name="ca" value="{{ old('ca') }}">
                        </div>
                    </div>



    
                    <div class="col-12">
                      <button class="main-btn primary-btn btn-hover" type="submit">
                        Valider
                      </button>
                    </div>
                  </div>
            
              </div>
              <!-- end card -->
            </div>
            <!-- end col -->
        </div>
         <!-- end row -->




   
         <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nomClientInput = document.getElementById('nom_client');
            const codeClientInput = document.getElementById('code_client');

            nomClientInput.addEventListener('input', function() {
                const nomClientValue = nomClientInput.value.trim();
                
                // Génération du code_client en fonction du nom_client
                if (nomClientValue) {
                    const prefix = nomClientValue.charAt(0).toUpperCase();
                    
                    // Fetch existing codes to determine the new number
                    fetch('/clients/generate-code?prefix=' + prefix)
                        .then(response => response.json())
                        .then(data => {
                            const newNumber = data.newNumber;
                            codeClientInput.value = prefix + newNumber;
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    codeClientInput.value = '';
                }
            });
        });
    </script> 


</form>

@endsection

