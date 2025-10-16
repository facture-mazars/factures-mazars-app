<!-- resources/views/client/listClients.blade.php -->

@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')
  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Liste tranche facture à encaisser</h2>
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

    @if ($trancheFacture->isEmpty())
        <p>Aucun encaissement facture trouvé.</p>
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
                        Numero facture
                          </h6>
                        </th>

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Numero tranche facture
                          </h6>
                        </th>

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                        Date probable
                          </h6>
                        </th>

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                      Date reel
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

                    @foreach ($trancheFacture as $c)
                      <tr>
                     

                        <td>
                          <span class="text-sm">{{ $c->facture->budget->chantier->mission->client->nom_client }}</span>
                        </td>
                        <td>
                          <span class="text-sm">{{ $c->id_facture }}</span>
                        </td>
                        <td>
                          <span class="text-sm">{{ $c->num_tranche }}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $c->dateprobable_emissionfacture }}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $c->datereel_emissionfacture }}</span>
                        </td>

                        
                        <td>
                          <span class="text-sm">{{ $c->tranche_debours }}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $c->tranche_honoraire }}</span>
                        </td>

                     

                            <td>
                         
                            <div class="buttons-group">
                          <a href="{{ route('encaissement.create', ['id_tranche_facture' => $c->id_tranche_facture]) }}" class="main-btn active-btn btn-hover">Encaissement</a>
                            </div>
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



