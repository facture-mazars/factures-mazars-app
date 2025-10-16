<!-- resources/views/client/listClients.blade.php -->

@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')
  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Liste des facture</h2>
                </div>
              </div>
            
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->


    <div class="container-fluid">
    <div class="row">
    <div class="col-lg-12">
              <div class="card-style mb-30">
                
                <!-- End Title -->
                <div class="table-responsive">

    @if ($facture->isEmpty())
        <p>Aucun facture trouvé.</p>
    @else
                  <table class="table top-selling-table">
                    <thead>
                      <tr>
                        
                          

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Reference facture emise
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Libele facture
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                        Total debours
                          </h6>
                        </th>

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                        Total honoraire
                          </h6>
                        </th>

                       
                      
                        <th>
                          <h6 class="text-sm text-medium">
                            Actions 
                          </h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($facture as $c)
                      <tr>
                     

                        <td>
                          <span class="text-sm">{{ $c->budget->chantier->mission->client->nom_client }}</span>
                        </td>
                        <td>
                          <span class="text-sm">{{ $c->ref_facture_emise }}</span>
                        </td>
                        <td>
                          <span class="text-sm"></span>
                        </td>


                        <td>
                          <span class="text-sm">{{ $c->total_debours }}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $c->total_honoraire }}</span>
                        </td>

                     

                            <td>
                         
                                <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="lni lni-more-alt"></i>
                                </button>
                  
                          
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                        <li class="dropdown-item">
                                          
                                            <a href="#0" class="text-gray">Supprimer</a>
                                        </li>
                                        
                                        <li class="dropdown-item">
                                            <a href="#0" class="text-gray"> Modifier</a>
                                         </li>
                                     </ul>
                                     </td>

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



