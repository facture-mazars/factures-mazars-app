<!-- resources/views/client/listClients.blade.php -->

@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')


   <!-- ========== title-wrapper start ========== -->
   <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6" >
                <div class="title">
                  <h2>Clients et contrat</h2>
                </div>
              </div>




               <!-- end col -->
               <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                  
                      <div class="col-md-10">
                <div class="input-style-3">
                   <input type="text" placeholder="Recherche..." />
                   <span class="icon"><i class="lni lni-search-alt"></i></span>
                 </div>
                 </di>
                  
                  </nav>
                </div>
              </div>
              <!-- end col -->


              <!-- end col -->


            
              
                 
              <!-- end col -->
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

    @if ($con->isEmpty())
        <p>Aucun contrat trouvé.</p>
    @else

                  <table class="table top-selling-table">
                    <thead>
                      <tr>
                        <th>
                          <h6 class="text-sm text-medium">Code Client</h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                           Client 
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                                Debut mandat
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                          Fin mandat
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Code projet
                          </h6>
                        </th>
                        <th class="min-width">
                         
                        </th>
                      
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($con as $row)
                      <tr>
                       
                        <td>
                          <p class="text-sm">{{ $row->client->code_client }}</p>
                        </td>
                        <td>
                          <span class="text-sm">{{ $row->client->nom_client }}</span>
                        </td>

                        <td>
                          <p class="text-sm">{{ $row->debut_mandat }}</p>
                        </td>
                        <td>
                          <span class="text-sm">{{ $row->fin_mandat }}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $row->project_code }}</span>
                        </td>

                        <td>
                          <!-- <div class="buttons-group">
                          <a href="  {{ route('contrat.show', $row->id_contrat) }}  " class="main-btn active-btn btn-hover">Fiche</a>
                            </div> -->
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



