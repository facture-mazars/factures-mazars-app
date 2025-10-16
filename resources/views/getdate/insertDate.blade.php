<!-- resources/views/mission/insertMission.blade.php -->

@extends('layouts.app')

@section('content')



      <!-- Afficher le message de succès -->
      @if(session('success'))
          
         <div id="success-message" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-12">
                <div class="title">
                  <h3>{{ $client->nom_client }} : {{ $client->code_client }} - {{ $chantier->sousTypeMission->types ?? '-'}} </h3>
                </div>
              </div>
            
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->



          <div class="row">
          <div class="col-lg-6">
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

    <form action="{{ route('getdate.store', $chantier->id_chantier) }}" method="POST">
        @csrf
        <div class="row">
       
                

    
        <input type="hidden" name="id_chantier" value="{{ $chantier->id_chantier }}">
           
          <!-- reference_date -->
          <div class="col-xxl-6">
                      <div class="input-style-1">
                      <label for="reference_date">Référence date :</label>
                      <input type="text" id="reference_date" name="reference_date" value="{{ old('reference_date') }}" oninput="updateReferenceChantier()">
                      </div>
                    </div>


             <!-- Référence Chantier pré-remplie -->
        <div class="col-xxl-6">
            <div class="input-style-1">
                <label for="reference_chantier">Référence Chantier</label>
                <input type="text" id="reference_chantier" name="reference_chantier" value="{{ $referenceChantier }}">
            </div>
        </div>



   
             <!-- date_initialisation -->
                    <div class="col-xxl-6">
                      <div class="input-style-1">
                      <label for="date_initialisation">Date d'initialisation :</label>
                      <input type="date" id="date_initialisation" name="date_initialisation" value="{{ old('date_initialisation', date('Y-m-d')) }}">
                      </div>
                    </div>

                  
                       <!-- date_debut_intervention -->
                       <div class="col-xxl-6">
                      <div class="input-style-1">
                      <label for="date_debut_intervention">Date debut intervention :</label>
                      <input type="date" id="date_debut_intervention" name="date_debut_intervention" value="{{ old('date_debut_intervention') }}">
                      </div>
                    </div>

                       <!-- date_fin_intervention -->
                       <div class="col-xxl-6">
                      <div class="input-style-1">
                      <label for="date_fin_intervention">Date fin intervention :</label>
                      <input type="date" id="date_fin_intervention" name="date_fin_intervention" value="{{ old('date_fin_intervention') }}">
                      </div>
                    </div>

      
           

    

       

            <div class="col-12">
            <a href="{{ route('chantier.modifier', ['id_chantier' => $chantier->id_chantier]) }}" class="main-btn primary-btn btn-hover" >Précédent</a>

                      <button style="float: inline-end;" class="main-btn primary-btn btn-hover" type="submit">
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

<script>
    function updateReferenceChantier() {
        // Récupère la valeur du champ reference_date
        const referenceDateValue = document.getElementById('reference_date').value;

        // Récupère le champ reference_chantier
        const referenceChantierInput = document.getElementById('reference_chantier');

        // Modifie la valeur de reference_chantier en ajoutant la valeur du champ reference_date
        referenceChantierInput.value = "{{ $referenceChantier }}" + referenceDateValue;
    }
</script>

