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
                  <h2>Tranche facture de : {{$facture->chantier->client->nom_client }} : {{ $facture->chantier->client->code_client }} - {{ $facture->chantier->sousTypeMission->types ?? '-' }}</h2>
                </div>
              </div>
            
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->

                 

<form action="{{ route('tranche.store') }}" method="POST">
            @csrf


        

            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



            <input type="hidden" name="id_facture" value="{{ $facture->id_facture }}">
          
            @for ($i = 0; $i < $facture->nb_tranche_facture; $i++)

            @if ($i === 0)
            <div class="row">
           
<div class="col-xxl-2">
  <div class="select-style-1">
  <label for="id_taux_{{ $i }}"> TAXE Honoraire:</label>
    <div class="select-position">
    <select style="background-color: white;" class="bg-ligh" id="id_taux_{{ $i }}" name="tranches[{{ $i }}][id_taux]">
       <option value="">Selectionner</option>
        @foreach ($tauxOptions as $taux)
            <option value="{{ $taux->id_taux }}" {{ old('tranches.0.id_taux') == $taux->id_taux ? 'selected' : '' }}>
                {{ $taux->types }} ({{ $taux->pourcentage }}%)
            </option>
        @endforeach
    </select>
    </div>
  </div>
</div>





           
           <div class="col-xxl-2">
             <div class="select-style-1">
             <label for="id_pourcentage_debours_{{ $i }}"> TAXE Debours:</label>
               <div class="select-position">
               <select style="background-color: white;" class="bg-ligh" id="id_pourcentage_debours_{{ $i }}" name="tranches[{{ $i }}][id_pourcentage_debours]">
                  <option value="">Selectionner</option>
                   @foreach ($tauxOptions as $taux)
                       <option value="{{ $taux->id_taux }}" {{ old('tranches.0.id_pourcentage_debours') == $taux->id_taux ? 'selected' : '' }}>
                           {{ $taux->types }} ({{ $taux->pourcentage }}%)
                       </option>
                   @endforeach
               </select>
               </div>
             </div>
           </div>
           
           </div>     

@endif
            <div class="row">
          <div class="col-lg-12">
              <div class="card-style settings-card-2 mb-30">

              <div class="row" id="tranches-container">

              <h3>Tranche {{ $i + 1 }}</h3>

                    <div class="col-xxl-1 col-custom">
                        <div class="input-style-1">
                          <label for="taux_honoraire_{{ $i }}">% Honoraire:</label>
                          <input type="number" id="taux_honoraire_{{ $i }}" name="tranches[{{ $i }}][taux_honoraire]" required oninput="calculateTauxEtMontants({{ $i }})" value="0">
                   
                        </div>
                    </div>

                    
                  <div class="col-xxl-2">
                      <div class="input-style-1">
                      <label for="montant_honoraire_{{ $i }}">Montant Honoraire ({{ $facture->chantier->monnaie->nom_monnaie }}):</label>
                        <input type="number" id="montant_honoraire_{{ $i }}" name="tranches[{{ $i }}][montant_honoraire]" step="0.01" readonly>
                      </div>
                    </div>

                    <div class="col-xxl-1 col-custom">
                      <div class="input-style-1">
                      <label for="taux_debours_{{ $i }}">% Débours:</label>
                      <input type="number" id="taux_debours_{{ $i }}" name="tranches[{{ $i }}][taux_debours]" required oninput="calculateTauxEtMontants({{ $i }})" value="0">
                      </div>
                    </div>

                    <div class="col-xxl-2">
                      <div class="input-style-1">
                      <label for="montant_debours_{{ $i }}">Montant Débours ({{ $facture->chantier->monnaie->nom_monnaie }}):</label>
                      <input type="number" id="montant_debours_{{ $i }}" name="tranches[{{ $i }}][montant_debours]" step="0.01" readonly>
                      </div>
                    </div>

       

 
                
             

                    <div class="col-xxl-2">
                    <div class="input-style-1">
                    <label for="date_prevision_facture_{{ $i }}">Prévision Facture:</label>
                    <input type="date" id="date_prevision_facture_{{ $i }}" name="tranches[{{ $i }}][date_prevision_facture]" required>
                      </div>
                    </div>

                    <div class="col-xxl-2">
                    <div class="input-style-1">
                    <label for="date_prevision_recouvrement_{{ $i }}">Prévision Recouvrement:</label>
                    <input type="date" id="date_prevision_recouvrement_{{ $i }}" name="tranches[{{ $i }}][date_prevision_recouvrement]" required>
                      </div>
                    </div>

                      <!-- Ajoutez un champ caché pour le nom de la tranche -->
                      <input type="hidden" name="tranches[{{ $i }}][nom_tranche]" value="Tranche {{ $i + 1 }}">

<!-- ... autres champs ... -->
                    
              </div>
                <!-- end row  -->
            </div>
              <!-- end card -->
            </div>
            <!-- end col -->
        </div>
         <!-- end row -->
         @endfor


          <div class="col-12">
          <a href="{{ route('facture.modifier', ['id_facture' => $facture->id_facture]) }}" class="main-btn primary-btn btn-hover" >Précédent</a>

                      <button style="float: inline-end;"  class="main-btn primary-btn btn-hover" type="submit">
                        Suivant
                      </button>
                    </div>
        </form>
              




   
  




@endsection


<script>
            // Calcul du taux et des montants
            function calculateTauxEtMontants(index) {
                const totalTranches = {{ $facture->nb_tranche_facture }};
                let totalTauxHonoraire = 0;
                let totalTauxDebours = 0;
                const totalHonoraire = @json($totalHonoraire);
                const totalDebours = @json($totalDebours);

                for (let i = 0; i < totalTranches; i++) {
                    if (i < totalTranches - 1) {
                        const tauxHonoraire = parseFloat(document.getElementById(`taux_honoraire_${i}`).value) || 0;
                        const tauxDebours = parseFloat(document.getElementById(`taux_debours_${i}`).value) || 0;

                        totalTauxHonoraire += tauxHonoraire;
                        totalTauxDebours += tauxDebours;

                     


                        // Calculer les montants pour les tranches non finales
                        document.getElementById(`montant_honoraire_${i}`).value = ((totalHonoraire * tauxHonoraire) / 100).toFixed(0);
                        document.getElementById(`montant_debours_${i}`).value = ((totalDebours * tauxDebours) / 100).toFixed(0);
                    }
                }

                // Calcul automatique pour la dernière tranche
                const tauxHonoraireFinal = 100 - totalTauxHonoraire;
                const tauxDeboursFinal = 100 - totalTauxDebours;

                document.getElementById(`taux_honoraire_${totalTranches - 1}`).value = tauxHonoraireFinal.toFixed(2);
                document.getElementById(`montant_honoraire_${totalTranches - 1}`).value = ((totalHonoraire * tauxHonoraireFinal) / 100).toFixed(0);

                document.getElementById(`taux_debours_${totalTranches - 1}`).value = tauxDeboursFinal.toFixed(2);
                document.getElementById(`montant_debours_${totalTranches - 1}`).value = ((totalDebours * tauxDeboursFinal) / 100).toFixed(0);
            }
        
        </script>