<!-- resources/views/client/listClients.blade.php -->

@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')
   <!-- Afficher le message de succès -->
   @if(session('success'))
          <br><br>
            <div id="success-message" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif




  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Liste des Clients</h2>
                </div>     
              </div>

                 <!-- end col -->
                 <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  
                  <nav aria-label="breadcrumb">
                  <div class="searchname d-none d-md-flex">

                  <form action="{{ route('clients.search') }}" method="GET">
                  <button><i class="lni lni-search-alt"></i></button>
                    <input type="text" name="nom_client" placeholder="Recherche client..." />
                   
                  </form>
                </div>

                
                  </nav>
                </div>
              </div>
              <!-- end col -->
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
              
                </div>
                <!-- End Title -->
                <div class="table-responsive">

    @if ($clients->isEmpty())
        <p>Aucun client trouvé.</p>
    @else
                  <table class="table top-selling-table">
                    <thead>
                      <tr>
                        <th>
                          <h6 class="text-sm text-medium">Code Client</h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                          Nom Client 
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                          Sigle 
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Type
                          </h6>
                        </th>

                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                        Mission                          </h6>
                        </th> 
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                          Adresse Client 
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Pays
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                          Details 
                          </h6>
                        </th>
                     
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($clients as $client)
                      <tr id="client-row-{{ $client->id_client }}">
                       
                        <td>
                          <p class="text-sm">{{ $client->code_client }}</p>
                        </td>
                        <td>
                          <span class="text-sm">{{ $client->nom_client }}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $client->sigle_client ?? '-'}}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $client->type ?? '-'}}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $client->secteurActivite->nom_secteur_activite ?? '-'}}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $client->adresse_client ?? '-'}}</span>
                        </td>

                        <td>
                          <span class="text-sm">{{ $client->pays->nom_pays ?? '-' }} </span>
                        </td>

                        <td>
                          <div class="action text-sm">
                        
                            <a style="text-align:center;" href="{{ route('detailsClients', $client->id_client) }}" class="edit">
                              <i class="lni lni-circle-plus"></i>
                            </a>
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




<script>
    // Masquer le message de succès après 8 secondes (8000 millisecondes)
    document.addEventListener('DOMContentLoaded', function () {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function () {
                successMessage.style.display = 'none';
            }, 3000); // 8 secondes
        }
    });
</script>