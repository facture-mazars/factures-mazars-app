<!-- resources/views/mission/insertMission.blade.php -->

@extends('layouts.app')

@section('content')


          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Nouveau contrat / chantier</h2>
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

    <form action="{{ route('chantier.store') }}" method="POST">
        @csrf
        <div class="row">
       
                     <!-- id_client -->

         

           
                <div class="col-xxl-4 limited-width">
                  <div class="select2">
                    <label for="id_client">CLIENT : <span class="text-danger">*</span> </label>
                    <div>
                      <select id="id_client" name="id_client">
                    <option value="">Selectionner</option>
                        @foreach($clients as $c)
                          <option value="{{ $c->id_client }}">{{ $c->nom_client }} - {{ $c->code_client }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>


                     <!-- type_mission -->
                     <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="type_mission">Type de Mission : <span class="text-danger">*</span> </label>
                        <div class="select-position">
                          <select class="light-bg" id="id_type_mission" name="id_type_mission">
                          <option value="">Sélectionnez un type mission</option>
                            @foreach($types as $type)
                            <option value="{{ $type->id_type_mission }}">{{ $type->types }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>


                      <!-- sous_type_mission -->
                      <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="sous_type_mission">Sous type de Mission : <span class="text-danger">*</span> </label>
                        <div class="select-position">
                          <select class="light-bg" id="id_sous_type_mission" name="id_sous_type_mission" disabled>
                          <option value="">Sélectionnez un sous-type</option>
                          </select>
                        </div>
                      </div>
                    </div>




                         <!-- objet -->
                         <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="objet">OBJET : <span class="text-danger">*</span>  </label>
            <input type="text" name="objet" id="objet" class="form-control" required>
        </div>
        </div>
    
   

<!--    |  | id_type_mission | id_sous_type_mission | --> 


  <!-- debut_exercice -->
  <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="debut_exercice">Début Mandat</label>
            <input type="date" name="debut_exercice" id="debut_exercice" class="form-control">
        </div>
        </div>

           <!-- fin_exercice -->
           <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="fin_exercice">Fin Mandat</label>
            <input type="date" name="fin_exercice" id="fin_exercice" class="form-control">
        </div>
        </div>

             <!-- exercice_clos -->
             <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="exercice_clos">Exercice clos</label>
            <input type="date" name="exercice_clos" id="exercice_clos" class="form-control">
        </div>
        </div>



   


   




      <!-- bailleur -->
      <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="bailleur">Bailleur</label>
            <input type="text" name="bailleur" id="bailleur" class="form-control">
        </div>
        </div>



            <!-- lp_contrat -->
            <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="lp_contrat">LP Contrat :</label>
                          <div class="select-position">
                            <select class="light-bg" id="lp_contrat" name="lp_contrat">
                            <option value="">Sélectionner</option>
                                <option value="LP">LP</option>
                                <option value="Contrat">Contrat</option>
                                </select>
                      </div>
                   </div>
                </div>


                        <!-- numero_lp_contrat -->
        <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="numero_lp_contrat">Numéros LP Contrat</label>
            <input type="text" name="numero_lp_contrat" id="numero_lp_contrat" class="form-control">
        </div>
        </div>


           <!-- date_lp_contrat -->
           <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="date_lp_contrat">Date LP Contrat</label>
            <input type="date" name="date_lp_contrat" id="date_lp_contrat" class="form-control">
        </div>
        </div>

  <!-- id_pays -->
  <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="id_pays_intervention">Pays intervention :</label>
                        <div class="select-position">
                          <select class="light-bg" id="id_pays_intervention" name="id_pays_intervention" onchange="toggleNewCountryFormI(this.value)">
                
                            @foreach($pays as $pay)
                                <option value="{{ $pay->id_pays }}" @if($pay->id_pays == 1) selected @endif>{{ $pay->nom_pays }}</option>
                            @endforeach
                            <option value="add_new_country"><i class="mdi mdi-movie-plus">Nouveau pays</i></option>
                          </select>
                        </div>
                      </div>
                    </div>

                             <!-- adresse_client -->
                             <div class="col-xxl-4" id="new_country_form" style="display:none;">
                      <div class="input-style-1">
                    
                   
                                <label for="new_country_intervention">Nouveau pays :</label>
                                <input type="text" class="form-control" id="new_country_intervention" name="new_country_intervention">
                         
                        </div>
                    </div>

  <script>
    function toggleNewCountryFormI(value) {
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

  

          <!-- id_monnaie -->
          <div class="col-xxl-4">
                   <div class="select-style-1">
                     <label for="id_monnaie">Monnaie</label>
                       <div class="select-position">
                         <select name="id_monnaie" id="id_monnaie" class="form-control"  onchange="toggleNewCountryForm(this.value)">
                           @foreach($monnaie as $row)
                             <option value="{{ $row->id_monnaie }}" @if($row->id_monnaie == 1) selected @endif>{{ $row->nom_monnaie }}</option>
                           @endforeach
                           <option value="add_new_monnaie"><i class="mdi mdi-movie-plus">Nouveau monnaie</i></option>
                         </select>
                      </div>
                   </div>
                </div>



                      <!-- est_recurrent -->
      <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="est_recurrent">Est recurrent</label>
           <div class="select-position">
            <select name="est_recurrent" id="est_recurrent" class="form-control">
             
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
            
            </select>
        </div>
        </div>
    </div>




                             <!-- adresse_client -->
                             <div class="col-xxl-4" id="new_monnaie_form" style="display:none;">
                      <div class="input-style-1">
                    
                   
                                <label for="new_monnaie">Nouveau monnaie :</label>
                                <input type="text" class="form-control" id="new_monnaie" name="new_monnaie">
                         
                        </div>
                    </div>

                    <script>
    function toggleNewCountryForm(value) {
        var newCountryForm = document.getElementById('new_monnaie_form');
        if (value === 'add_new_monnaie') {
            // Afficher le formulaire pour entrer un nouveau pays
            newCountryForm.style.display = 'block';
        } else {
            // Masquer le formulaire pour entrer un nouveau pays
            newCountryForm.style.display = 'none';
        }
    }
</script>


         <!-- est_refere -->
         <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="est_refere">Est refere</label>
           <div class="select-position">
            <select name="est_refere" id="est_refere" class="form-control">
                    <option value="0">Non</option>
                    <option value="1">Oui</option>
                   
            
            </select>
        </div>
        </div>
    </div>


                           <!-- referant -->
      <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="referant">Referant</label>
            <input type="text" name="referant" id="referant" class="form-control">
        </div>
        </div>

  

     <!-- dom_export -->
     <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="dom_export">Domestique / Export :</label>
                          <div class="select-position">
                            <select class="light-bg" id="dom_export" name="dom_export">
                         
                                <option value="Domestique">Domestique</option>
                                <option value="Export">Export</option>
                                </select>
                        </div>
                      </div>
                    </div>


                         <!-- origine_contrat -->
      <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="origine_contrat">Origine contrat</label>
            <input type="text" name="origine_contrat" id="origine_contrat" class="form-control">
        </div>
        </div>

            <!-- engagement_with_individuel -->
            <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="engagement_with_individuel">Engagement with Individuel</label>
           <div class="select-position">
            <select name="engagement_with_individuel" id="engagement_with_individuel" class="form-control">
              <option value="0">Non</option>
                <option value="1">Oui</option>
                
            </select>
        </div>
        </div>
            </div>


               <!-- details_engagement_with_individuel -->
               <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="details_engagement_with_individuel">Details Engagement WI</label>
            <input type="text" name="details_engagement_with_individuel" id="details_engagement_with_individuel" class="form-control">
        </div>
        </div>




            <!-- engagement_with_other_mazars_entity -->
            <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="engagement_with_other_mazars_entity">Engagement With Another Mazars Entity</label>
           <div class="select-position">
            <select name="engagement_with_other_mazars_entity" id="engagement_with_other_mazars_entity" class="form-control">
                <option value="0">Non</option>
                <option value="1">Oui</option>
                
            </select>
        </div>
        </div>
          </div>

          <!-- details_engagement_with_other_mazars_entity -->
          <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="details_engagement_with_other_mazars_entity">Details Engagement WAME</label>
            <input type="text" name="details_engagement_with_other_mazars_entity" id="details_engagement_with_other_mazars_entity" class="form-control">
        </div>
        </div>


         <!-- framework_agreement -->
         <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="framework_agreement">Framework Agreement</label>
           <div class="select-position">
            <select name="framework_agreement" id="framework_agreement" class="form-control">
                <option value="0">Non</option>
                <option value="1">Oui</option>
                
            </select>
        </div>
        </div>
            </div>
 


            <!-- details_framework_agreement -->
            <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="details_framework_agreement">Details Framework Agreement</label>
            <input type="text" name="details_framework_agreement" id="details_framework_agreement" class="form-control">
        </div>
        </div>


                     

         
    

       

            <div class="col-12">
                      <button class="main-btn primary-btn btn-hover" type="submit">
                        Valider
                      </button>
                    </div>

        </div>

    </form>


    </div>
              <!-- end card -->
            </div>
            <!-- end col -->
        </div>
         <!-- end row -->

<!-- Votre CSS personnalisé -->
<style>
/* Styles personnalisés pour Select2 */
.select2-container--default .select2-selection--single {
margin-top: 6px;
  background-color: rgba(239, 239, 239, 0.5);
  border: 1px solid #e5e5e5;
  border-radius: 10px;
  padding: 16px;
  color: #5d657b;
  resize: none;
  transition: all 0.3s;

  position: relative;
  display: block;
  height: 60px;

  width: 200%;

 



    /* height: 60px;*/
    width: 400px; 
}

.limited-width {
    max-width: 50%;  /* Empêche l'élément de dépasser la taille maximale de la colonne */
    overflow: hidden; /* Cache le débordement si le contenu est trop large */
}

.select2-container--default .select2-results__option {
    color: #333;
    padding: 10px;
}

.select2-container--default .select2-results__option--highlighted {
    background-color: transparent;
    color: white;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
}

.select2-container {
    width: 100% !important;
    border: 0px !important;
}

.select2-container--default .select2-results__option {
    padding: 8px !important;
    background-color: transparent !important;
    color: #333 !important;
    cursor: pointer !important;
}

.select2-container--default .select2-results__option--highlighted {
    background-color: #f0f0f0 !important;
    color: #000 !important;
}

.select2-results {
    max-height: 300px !important;  /* Limite la hauteur du menu */
    overflow-y: auto !important;   /* Ajoute une barre de défilement si nécessaire */
}

.select2-container--default .select2-results__options::-webkit-scrollbar {
    width: 8px !important;  /* Largeur de la barre de défilement */
}

.select2-container--default .select2-results__options::-webkit-scrollbar-thumb {
    background-color: transparent !important;  /* Couleur de la barre de défilement */
    border-radius: 10px !important;
}

.select2-container--default .select2-results__options::-webkit-scrollbar-thumb:hover {
    background-color: transparent !important;  /* Couleur lors du survol */
}


</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $('#id_type_mission').on('change', function () {
        var typeId = $(this).val();
        if (typeId) {
            $.ajax({
                url: '/get-sous-types/' + typeId,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#id_sous_type_mission').empty().prop('disabled', false);
                    $.each(data, function (key, value) {
                        $('#id_sous_type_mission').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            $('#id_sous_type_mission').empty().prop('disabled', true);
        }
    });
</script>



<script>
    $(document).ready(function() {
        $('#id_client').select2({
            placeholder: 'Sélectionner un client',
            allowClear: true
        });
    });
</script>





@endsection
