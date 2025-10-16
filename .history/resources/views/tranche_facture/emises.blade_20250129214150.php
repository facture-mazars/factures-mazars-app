<!-- resources/views/client/listClients.blade.php -->

@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

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
              <div class="col-md-6">
                <div class="title">
                  <h2>Liste facture emise</h2>
                </div>
              </div>


 
            
            </div>


 
    

      </div>
   
          <!-- ========== title-wrapper end ========== -->


    <div class="container-fluid">
    <div class="row">
    <div class="col-lg-12">
              <div class="card-style mb-30">
              
                <!-- End Title -->
                <div class="table-responsive">

    @if ($emises->isEmpty())
        <p>Aucun tranche facture trouvé.</p>
    @else
                  <table class="table top-selling-table">
                    <thead>
                      <tr>
                      <th class="min-width">
                          <h6 class="text-sm text-medium">
                      Numero facture
                          </h6>
                        </th>
               

                      <th class="min-width">
                          <h6 class="text-sm text-medium">
                        Client
                          </h6>
                        </th>

                       

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                          Tranche 
                          </h6>
                        </th>

                   

                    
                 
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Date réel facture
                          </h6>
                        </th>

                    
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                     Total honoraire <span style="color: transparent;">........</span>
                          </h6>
                        </th> 

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                          Taxe 
                          
                          </h6>
                        </th>    


                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                          Total debours<span style="color: transparent;">........</span>
                          </h6>
                        </th> 


                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                          Total à payer<span style="color: transparent;">........</span>
                          </h6>
                        </th> 


                   

                        <th>
                          <h6 class="text-sm text-medium">
                             
                          </h6>
                        </th>
                        @if (Auth::user()->role === 'Admin')     
                        <th>
                          <h6 class="text-sm text-medium">
                             
                          </h6>
                        </th>

                        <th>
                          <h6 class="text-sm text-medium">
                             Actions
                          </h6>
                        </th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                    @php

        
        @endphp

                    @foreach ($emises as $c)
                    
        <!-- Afficher la tranche -->
 
                

                      <tr>
                      <td>
                          <span class="text-sm">{{ $c->numero_facture }}</span>
                        </td>

                        <td>
                         
                          @if(isset($c->facture->budgets->first()->chantier->client->nom_client))
                                  <span class="text-sm">{{ $c->facture->budgets->first()->chantier->client->nom_client }}</span>
                          @else
                          <span class="text-sm">N/A</span>
                          @endif
                        </td>

                        <td>{{ $c->nom_tranche }} </span>
                        </td>

              
                     
                        <td>
                          <span class="text-sm">{{ $c->date_reel_fac }}</span>
                        </td>

                        <td>
                          <h5><span class="text-success">{{  number_format($c->montant_honoraire, 0, ',', ' ')  }}</span> </h5>
                        </td>

                        <td>
    @if ($c->id_taux)
        {{-- Si id_taux est défini, afficher le type correspondant --}}
        <span class="text-sm">{{ $c->taux->types }}</span>
    @elseif ($c->id_pourcentage_debours)
        {{-- Si id_taux est null mais id_pourcentage_debours est défini, afficher son type --}}
        <span class="text-sm">{{ $c->pourcentageDebours->types }}</span>
    @else
        {{-- Si les deux sont null --}}
        <span class="text-sm">-</span>
    @endif
</td>

                        <td>
                          <h5><span class="text-success">{{  number_format($c->montant_debours, 0, ',', ' ')  }}</span> </h5>
                        </td>

                  

                          <td>
            <h5><span class="text-danger">{{ number_format($totals[$c->id_tranche_facture] ?? 0, 0, ',', ' ') }}</span></h5>
        </td>
                    
                        <td>
                        @if($c->date_facture_annule)
                            <a href="{{ route('tranche.detailsAnnuler', ['id_tranche_facture' => $c->id_tranche_facture]) }}" class="status-btn active-btn">facture</a>
                            @else
                            <a href="{{ route('tranche.details', ['id_tranche_facture' => $c->id_tranche_facture]) }}" class="status-btn active-btn">Facture</a>
                           
                            @endif
                          </td>

                          @if (Auth::user()->role === 'Admin')     
                        <td>
                            <a href="{{ route('encaissement.create', ['id_tranche_facture' => $c->id_tranche_facture]) }}" class="status-btn success-btn">Encaisser</a>
                          </td>
                          @endif
                          <td>
                        
                 




                 <div class="notification-box" >

                 <button class="dropdown-toggle status-btn close-btn" type="button" id="notification" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                  
                  Annuler 
                 </button>
<ul style="width: 333px;" class="dropdown-menu dropdown-menu-end" aria-labelledby="notification">

<div class="card-style settings-card-1 mb-30">

<form action="{{ route('facturer.trancheAnnuler', $c->id_tranche_facture) }}" method="POST">
@csrf
<div class="row">
    <!-- Champ pour le numéro de facture -->
    <div class="col-12">
     <div class="input-style-1">
         <label style="color: #d50100;" for="numero_facture_annule">Nouvelle numéro de facture</label>
         <input type="text" id="numero_facture_annule" name="numero_facture_annule" value=" {{ $c->numero_facture }}" required />
     </div>
 </div>

 <div class="col-12">
   <div class="input-style-1">
   <label style="color: #d50100;" for="date_facture_annule">Nouvelle date facture</label>
   <input type="date" id="date_facture_annule" name="date_facture_annule" value=" {{ $c->date_reel_fac }}" required />
   </div>
 </div>

 <div class="col-6">
   <button class="main-btn primary-btn btn-hover">
    Valider
   </button>
 </div>
</div>
</form>
</div>
<!-- end card -->


</ul>
</div>
                          </td>
                      @endif
                       
                                   
                      </tr>
               
                      @endforeach
                    </tbody>
                  </table>
                  <!-- End Table -->
                  @endif
                </div>
              </div>
            </div>
            <!-- End Col -->
            </div>
          <!-- End Row -->
        </div>
        <!-- end container -->







        
@endsection


