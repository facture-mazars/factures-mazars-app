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
                  <h2>Facture de {{$chantier->client->nom_client }} : {{ $chantier->client->code_client }} - {{ $chantier->sousTypeMission->types ?? '-' }}</h2>
                </div>
              </div>
            
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->

    



    
                <form action="{{ route('facture.store') }}" method="POST">
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
                                
          <div class="row">

            <div class="col-xl-3 col-lg-4 col-sm-6">

              <div class="icon-card mb-30">
               
                <div class="content">
                  <h6 class="mb-10">Total Honoraire</h6>
                  <p class="text-bold mb-10 text-success">{{ number_format($totalHonoraire, 0, ',', ' ') }} <span class="text-gray">&nbsp; {{ $chantier->monnaie->nom_monnaie }}</span></>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
             
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
              
                <div class="content">
                <h6 class="mb-10">Total Debours</h6>
                  <div style="display: inline-flex; align-items: center;">
                
                  <p id="total_debours" class="text-bold mb-10 text-success">0</p><span class="text-bold mb-10 text-gray">&nbsp; {{ $chantier->monnaie->nom_monnaie }}</span>
                
                  </div>
                 
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            </div>






     <div class="row">
          <div class="col-lg-6">
              <div class="card-style settings-card-2 mb-30">
                

                  <div class="row">
                  <input type="hidden" name="id_chantier" value="{{ $chantier->id_chantier }}">
                    

                    <div class="col-xxl-6">
                      <div class="input-style-1">
                      <label> Reference chantier :</label>
                    <a class="main-btn deactive-btn square-btn btn-hover"> &nbsp;&nbsp;&nbsp;&nbsp; {{ $getdates->reference_chantier }}&nbsp;&nbsp;&nbsp;&nbsp;  </a>
                      </div>
                    </div>
             
       

                    <p></p>
                 
                     <!-- debours_decaissable -->
                     <div class="col-xxl-6">
                      <div class="input-style-1">
                      <label for="debours_decaissable">Debours decaissable :</label>
                        <div style="display: inline-flex; align-items: center;">
                        <input type="number" id="debours_decaissable" name="debours_decaissable" oninput="calculateTotal()">
                        <span>&nbsp;&nbsp;{{ $chantier->monnaie->nom_monnaie }}</span>

                        </div>
                      
                      </div>
                    </div>


                      <!-- debours_non_decaissable -->
                      <div class="col-xxl-6">
                      <div class="input-style-1">
                                                
                          <label for="debours_non_decaissable">Debours non decaissable :</label>
                          <div style="display: inline-flex; align-items: center;">  
                          <input type="number" id="debours_non_decaissable" name="debours_non_decaissable" oninput="calculateTotal()">
                          <span>&nbsp;&nbsp;{{ $chantier->monnaie->nom_monnaie }}</span>
                        </div>

                      </div>
                    </div>

                  
                 
                    <p></p>

                     <!-- nb_tranche_facture -->
                     <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="nb_tranche_facture">Nombre tranche facture :</label>
                      <input type="number" id="nb_tranche_facture" name="nb_tranche_facture" required>
                      </div>
                    </div>


                       
                  <div class="col-12">
                
                 
            <!-- Lien pour modifier tous les budgets -->
            @if($budgets->count() > 0)
                                <a href="{{ route('budget.modifier', ['id_chantier' => $chantier->id_chantier]) }}" class="main-btn primary-btn btn-hover">
                                   Précédent
                                </a>
                            @else
                                <p>Aucun budget associé à ce chantier.</p>
                            @endif

                    <button style="float:inline-end;" class="main-btn primary-btn btn-hover" type="submit">
                        Suivant
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
        function calculateTotal() {
            // Obtenir les valeurs des champs
            var deboursDecaissable = parseFloat(document.getElementById('debours_decaissable').value) || 0;
            var deboursNonDecaissable = parseFloat(document.getElementById('debours_non_decaissable').value) || 0;

            // Calculer le total
            var total = deboursDecaissable + deboursNonDecaissable;

            // Afficher le total
      
            document.getElementById('total_debours').textContent = total.toLocaleString('fr-FR', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
  
        }
    </script>