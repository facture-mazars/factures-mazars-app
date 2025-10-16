<!-- resources/views/client/listClients.blade.php -->

@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')
  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Liste des Budget</h2>
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
                <div class="title d-flex flex-wrap align-items-center justify-content-between">
                  <div class="left">
                   
                  </div>
                  <div class="right">
                    <div class="select-style-1">
                      <div class="select-position select-sm">
                        <select class="light-bg">
                          <option value="">Today</option>
                          <option value="">Yesterday</option>
                        </select>
                      </div>
                    </div>
                    <!-- end select -->
                  </div>
                </div>
                <!-- End Title -->
                <div class="table-responsive">

    @if ($budget->isEmpty())
        <p>Aucun budget trouvé.</p>
    @else
                  <table class="table top-selling-table">
                    <thead>
                      <tr>
                        <th>
                          <h6 class="text-sm text-medium">Code chantier</h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                          Nom client 
                          </h6>
                        </th>

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Responsable
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                          Nom responsable
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Jour homme
                          </h6>
                        </th>

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Taux
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

                    @foreach ($budget as $c)
                      <tr>
                       
                        <td>
                          <p class="text-sm">{{ $c->chantier->code_chantier }}</p>
                        </td>

                        <td>
                          <span class="text-sm">{{ $c->chantier->mission->client->nom_client }}</span>
                        </td>
                        <td>
                          <span class="text-sm">{{ $c->responsable->types }}</span>
                        </td>
                        <td>
                          <span class="text-sm">{{ $c->nom }}</span>
                        </td>


                        <td>
                          <span class="text-sm">{{ $c->nb_jour_homme }}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $c->taux }}</span>
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



