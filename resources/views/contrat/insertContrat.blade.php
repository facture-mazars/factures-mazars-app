<!-- resources/views/mission/insertMission.blade.php -->

@extends('layouts.app')

@section('content')


          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Nouveau contrat</h2>
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

    <form action="{{ route('contrat.store') }}" method="POST">
        @csrf
        <div class="row">
       
                    <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="id_clients">CLIENT :</label>
                        <div class="select-position">
                          <select class="light-bg" id="id_client" name="id_client" required>
                            @foreach($clients as $c)
                                <option value="{{ $c->id_client }}">{{ $c->nom_client }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>


      
             <!-- id_monnaie -->
                <div class="col-xxl-4">
                   <div class="select-style-1">
                     <label for="id_monnaie">Monnais</label>
                       <div class="select-position">
                         <select name="id_monnaie" id="id_monnaie" class="form-control">
                           @foreach($monnaie as $row)
                             <option value="{{ $row->id_monnaie }}">{{ $row->nom_monnaie }}</option>
                           @endforeach
                         </select>
                      </div>
                   </div>
                </div>

                <!-- lp_contrat -->
                <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="lp_contrat">LP Contrat :</label>
                          <div class="select-position">
                            <select class="light-bg" id="lp_contrat" name="lp_contrat" required>
                                <option value="LP">LP</option>
                                <option value="Contrat">Contrat</option>
                                </select>
                      </div>
                   </div>
                </div>


              
              <!-- exercice_clos -->
        <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="exercice_clos">Exercice Clos</label>
            <input type="date" name="exercice_clos" id="exercice_clos" class="form-control" required>
        </div>
        </div>


        <!-- debut_mandat -->
        <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="debut_mandat">Début Mandat</label>
            <input type="date" name="debut_mandat" id="debut_mandat" class="form-control" required>
        </div>
        </div>


        <!-- fin_mandat -->
        <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="fin_mandat">Fin Mandat</label>
            <input type="date" name="fin_mandat" id="fin_mandat" class="form-control" required>
        </div>
        </div>

     

        <!-- date_lp_contrat -->
        <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="date_lp_contrat">Date LP Contrat</label>
            <input type="date" name="date_lp_contrat" id="date_lp_contrat" class="form-control">
        </div>
        </div>

    



              

       

  <!-- id_partner_1 -->
        <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="id_partner_1">Partner 1</label>
           <div class="select-position">
            <select name="id_partner_1" id="id_partner_1" class="form-control">
                @foreach($partners1 as $partner)
                    <option value="{{ $partner->id_partner }}">{{ $partner->nom_partner }}</option>
                @endforeach
            </select>
        </div>
        </div>
                </div>


                <!-- id_partner_2 -->
        <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="id_partner_2">Partner 2</label>
           <div class="select-position">
            <select name="id_partner_2" id="id_partner_2" class="form-control">
                @foreach($partners2 as $partner)
                    <option value="{{ $partner->id_partner }}">{{ $partner->nom_partner }}</option>
                @endforeach
            </select>
        </div>
        </div>
            </div>

           

         

       

      

            <!-- client_refere -->

        <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="client_refere">Client Référé</label>
           <div class="select-position">
            <select name="client_refere" id="client_refere" class="form-control">
               
                    <option value="Référé">Référé</option>
                    <option value="Non référé">Non référé</option>
               
            </select>
        </div>
        </div>           
      </div>


      <!-- mission_recurente -->
        <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="mission_recurente">Mission Récurente/Ponctuelle</label>
           <div class="select-position">
            <select name="mission_recurente" id="mission_recurente" class="form-control">
             
                    <option value="Récurrente">Récurrente</option>
                    <option value="Ponctuelle">Ponctuelle</option>
            
            </select>
        </div>
        </div>
                 </div>


                 <!-- restrictions_specifiques -->
                 <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="restrictions_specifiques">Restrictions Spécifiques</label>
           <div class="select-position">
            <select name="restrictions_specifiques" id="restrictions_specifiques" class="form-control" required>
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
        </div>
        </div>
            </div>

          

            <!-- client_domestique -->
            <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="client_domestique_export">Client Domestique/Export</label>
           <div class="select-position">
            <select name="client_domestique_export" id="client_domestique_export" class="form-control" required>
                <option value="Domestique">Domestique</option>
                <option value="Export">Export</option>
            </select>
        </div>
        </div>
            </div>

     
            <!-- engagement_with_individuel -->
        <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="engagement_with_individuel">Engagement with Individuel</label>
           <div class="select-position">
            <select name="engagement_with_individuel" id="engagement_with_individuel" class="form-control" required>
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
        </div>
        </div>
            </div>


            <!-- details_engagement_with_individuel -->
            <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="details_engagement_with_individuel">Details Engagement WI</label>
            <input type="text" name="details_engagement_with_individuel" id="details_engagement_with_individuel" class="form-control" required>
        </div>
        </div>


            <!-- engagement_with_mazars_entity -->
        <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="engagement_with_mazars_entity">Engagement With Another Mazars Entity</label>
           <div class="select-position">
            <select name="engagement_with_mazars_entity" id="engagement_with_mazars_entity" class="form-control" required>
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
        </div>
        </div>
          </div>

          <!-- details_engagement_with_mazars_entity -->
          <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="details_engagement_with_mazars_entity">Details Engagement WAME</label>
            <input type="text" name="details_engagement_with_mazars_entity" id="details_engagement_with_mazars_entity" class="form-control" required>
        </div>
        </div>




 
        <!-- framework_agreement -->
        <div class="col-xxl-4">
              <div class="select-style-1">
            <label for="framework_agreement">Framework Agreement</label>
           <div class="select-position">
            <select name="framework_agreement" id="framework_agreement" class="form-control" required>
                <option value="1">Oui</option>
                <option value="0">Non</option>
            </select>
        </div>
        </div>
            </div>
 


            <!-- details_framework_agreement -->
            <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="details_framework_agreement">Details Framework Agreement</label>
            <input type="text" name="details_framework_agreement" id="details_framework_agreement" class="form-control" required>
        </div>
        </div>


        <!-- reviseur_independant -->
        <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="reviseur_independant">Réviseur Indépendant</label>
            <input type="text" name="reviseur_independant" id="reviseur_independant" class="form-control">
        </div>
        </div>
         

        <!-- ref_ic_we_check -->
        <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="ref_ic_we_check">Ref IC We Check</label>
            <input type="text" name="ref_ic_we_check" id="ref_ic_we_check" class="form-control">
        </div>
        </div>


        <!-- project_code -->
        <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="project_code">Code Projet</label>
            <input type="text" name="project_code" id="project_code" class="form-control" required>
        </div>
        </div>


       


        <!-- numero_lp_contrat -->
        <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="numero_lp_contrat">Numéros LP Contrat</label>
            <input type="text" name="numero_lp_contrat" id="numero_lp_contrat" class="form-control">
        </div>
        </div>



        <!-- nombre_annee -->
        <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="nombre_annee">Nombre année</label>
            <input type="number" name="nombre_annee" id="nombre_annee" class="form-control" required>
        </div>
        </div>
       
        <!-- evaluation_horaire -->

        <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="evaluation_horaire">Evaluation horaire</label>
            <input type="number" name="evaluation_horaire" id="evaluation_horaire" class="form-control">
        </div>
        </div>

        <!-- bureau_mazars -->
        <div class="col-xxl-4">
              <div class="input-style-1">
            <label for="bureau_mazars">Bureau Mazars</label>
            <input type="text" name="bureau_mazars" id="bureau_mazars" class="form-control">
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


@endsection
