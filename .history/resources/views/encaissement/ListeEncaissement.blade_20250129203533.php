<!-- resources/views/client/listClients.blade.php -->

@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')
  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Liste factures encaissés</h2>
                </div>
                </div>

                <div class="col-md-6">
                    <div class="breadcrumb-wrapper">
                  
                       <nav aria-label="breadcrumb">
                          <div class="d-none d-md-flex">
     

                      <form method="POST" action="{{ route('encaissement.show') }}">
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

    @if ($encaissement->isEmpty())
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
                       Reference chantier
                          </h6>
                        </th>

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                      Date reel
                          </h6>
                        </th>


                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                       TOTAL À PAYER
                          </h6>
                        </th>

                     

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                      Encaissé
                          </h6>
                        </th>


                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                     Reste à encaisser
                          </h6>
                        </th>

                       <th></th>
                      
                        <th>
                          <h6 class="text-sm text-medium">
                            Actions 
                          </h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($encaissement as $c)
                      <tr>
                     
                        <td>
                          <span class="text-sm">{{ $c->trancheFacture->facture->chantier->client->nom_client }}</span>
                        </td>
                        <td>
                          <span class="text-sm">{{ $c->trancheFacture->facture->chantier->getDate->first()->reference_chantier ?? 'Non spécifié'}}</span>
                        </td>
        
                        <td>
                          <span class="text-sm">{{ $c->datereel_encaissement }}</span>
                        </td>

                        <td>
                          <h5><span class="text-success">{{ number_format($totals[$c->trancheFacture->id_tranche_facture] ?? 0, 0, ',', ' ') }}</span></h5>
                      </td>
                                      
                        
                        <td>
                        <h5><span class="text-danger">{{ number_format($c->montant_a_encaisse ?? 0, 0, ',', ' ') }}</span></h5>
                  
                        </td>

                      

                        <td>
                        <h5>  <span style="color : blue;">{{ number_format($c->reste_a_payer ?? 0, 0, ',', ' ') }}</span>
                     
                      </h5>
                        </td>
                        <td>
                        @if(($c->reste_a_payer ?? 0) != ($c->montant_a_encaisse ?? 0))
                          <a href="{{ route('encaissement.create', ['id_tranche_facture' => $c->trancheFacture->id_tranche_facture]) }}" class="main-btn info-btn-light rounded-full btn-hover"">Payer</a>
                        @endif
                        </td>
                        
               
                   
                     

                            <td>
                         
                      
                          @if($c->trancheFacture->date_facture_annule)
                              <a href="{{ route('tranche.detailsansEncaissAnnuler', ['id_tranche_facture' => $c->id_tranche_facture]) }}" class="main-btn secondary-btn-light rounded-full btn-hover">
                              <i class="lni lni-eye"></i> Facture 
                              </a>
                          @else
                              <a href="{{ route('tranche.detailsansEncaiss', ['id_tranche_facture' => $c->id_tranche_facture]) }}" class="main-btn secondary-btn-light rounded-full btn-hover">
                              <i class="lni lni-eye"></i>  Voir facture
                              </a>
                          @endif

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



