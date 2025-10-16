<!-- resources/views/check_encaissement.blade.php -->
@extends('layouts.app')

@section('content')
<!-- ========== title-wrapper start ========== -->
<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2>Liste mission cloturé</h2>
            </div>
        </div>


          <!-- end col -->
          <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  
                  <nav aria-label="breadcrumb">
                  <div class="d-none d-md-flex">
     

                  <form method="POST" action="{{ route('listesCloture.show') }}">
                    @csrf
                    <div class="row">
                    <div class="col-xxl-6">
                      <div class="input-style-1">
                        <label>Nom client</label>
                        <input style="background-color: white; " type="text" name="search" class="form-control" value="{{ request('search') }}">
      
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

 
                  <table class="table top-selling-table">
                    <thead>
                      <tr>
                        
                      <th class="min-width">
                          <h6 class="text-sm text-medium">
                        Reference client
                          </h6>
                        </th>

                       

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
                          Taux Honoraire
                          </h6>
                        </th>

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                          Taux Débours
                          </h6>
                        </th>
               


                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Total honoraire
                          </h6>
                        </th>

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                        Total debours
                          </h6>
                        </th>
                        <th></th>
                      

                  
                      </tr>
                    </thead>
                    <tbody>
              
@foreach($encaissements as $encaissement)
                    
        <!-- Afficher la tranche -->
 
                

                      <tr>
                     
                      <td>
                          <span class="text-sm">{{ $encaissement->code_client }}</span>
                        </td>

                 
                        <td>
                          <span class="text-sm">{{ $encaissement->nom_client }}</span>
                        </td>
                      

                        <td>
                        
                        <span class="text-sm">{{ $encaissement->reference_chantier }}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $encaissement->total_taux_honoraire }} %</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $encaissement->total_taux_debours }} %</span>
                        </td>

                        <td>
                          <h5><span class="text-success">{{ number_format($encaissement->total_montant_honoraire , 0, ',', ' ') }}</span> Ar</h5>
                        </td>

                        <td>
                          <h5><span class="text-success">{{ number_format($encaissement->total_montant_debours, 0, ',', ' ') }}</span> Ar</h5>
                        </td>
                        <td>
                        <a href="{{ route('rapport.final', ['id_facture' => $encaissement->id_facture]) }}" class="main-btn primary-btn btn-hover" >Details</a>


                        </td>

                           
                                   
                      </tr>
               
                      @endforeach
                    </tbody>
                  </table>
                  <!-- End Table -->
              
                </div>
              </div>
            </div>
            <!-- End Col -->
            </div>
          <!-- End Row -->
        </div>
        <!-- end container -->
@endsection
