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
                  <h2>Liste facture à emettre</h2>
                </div>
              </div>


        <!-- end col -->
        <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  
                  <nav aria-label="breadcrumb">
                  <div class="d-none d-md-flex">
     

                  <form method="POST" action="{{ route('tranche.show') }}">
                    @csrf
                    <div class="row">
                    <div class="col-xxl-3">
                      <div class="input-style-1">
                        <label>Nom client</label>
                        <input class="form-control" style="background-color: white; " type="text" name="nom_client">
                      </div>
                    </div>

                    <div class="col-xxl-3">
                      <div class="input-style-1">
                        <label>Date debut : </label>
                        <input class="form-control" type="date" name="date_debut"  style="background-color: white; ">
                      </div>
                    </div>

                    <div class="col-xxl-3">
                      <div class="input-style-1">
                        <label>Date fin : </label>
                        <input type="date" name="date_fin" class="form-control"  style="background-color: white;">
                      </div>
                    </div>

                 
                    <div class="col-1" style="margin-top:35px;">
                      <button type="submit" class="main-btn primary-btn btn-hover">
                      <i class="lni lni-search-alt"></i>
                      </button>
                    </div>
                   
                 
                    </div>
                </form>

                </div>

                
                  </nav>
                </div>
              </div>
              <!-- end col -->
            
            </div>


 
    

      </div>
   
          <!-- ========== title-wrapper end ========== -->


    <div class="container-fluid">
    <div class="row">
    <div class="col-lg-12">
              <div class="card-style mb-30">
              
                <!-- End Title -->
                <div class="table-responsive">

    @if ($trancheFacture->isEmpty())
        <p>Aucun tranche facture trouvé.</p>
    @else
                  <table class="table top-selling-table">
                    <thead>
                      <tr>
                        
                      <th class="min-width">
                          <h6 class="text-sm text-medium">
                        Client
                          </h6>
                        </th>

                  
                       

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Nombre tranche 
                          </h6>
                        </th>


                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                        Mission
                          </h6>
                        </th>
                    
                 
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Prevision facture
                          </h6>
                        </th>

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                      Recouvrement
                          </h6>
                        </th>
               

 
<th></th>
                       
@if (Auth::user()->role === 'Admin') 
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

            $trancheCounters = [];
        @endphp

                    @foreach ($trancheFacture as $c)
                    
        <!-- Afficher la tranche -->
 
                

                      <tr>
                     

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
                      <span class="text-sm"> {{ $c->facture->chantier->sousTypeMission->types ?? '-'  }}</span>
                     </td>
                     
                        <td>
                          <span class="text-sm">{{ $c->date_prevision_facture }}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $c->date_prevision_recouvrement }}</span>
                        </td>
                      


                        <td>
                            <a href="{{ route('tranche.voir', ['id_tranche_facture' => $c->id_tranche_facture]) }}" class="status-btn active-btn">Voir facture</a>
                          </td>

                          @if (Auth::user()->role === 'Admin')
                            <td>
                         
                                <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="lni lni-more-alt"></i>
                                </button>
                  
                          
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">

                                    <li class="dropdown-item">
                                            <a href="{{ route('tranche.modifier', ['id_facture' => $c->facture->id_facture]) }}" class="text-gray"> Modifier</a>
                                         </li>
                                         
                                  
                                        
                                      
                                     </ul>
                                     
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


