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
                        Mission
                          </h6>
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
                        <th>
                          <h6 class="text-sm text-medium">
                            Actions 
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

                            <td>
                         
                                <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="lni lni-more-alt"></i>
                                </button>
                  
                          
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                        <li class="dropdown-item">
                                          
                                            <a href="{{ route('client.modifier', ['id_client' => $client->id_client]) }}" class="text-gray">Modifier</a>
                                        </li>
                                        
                                        <li class="dropdown-item">
                                            <a class="btn-delete-client" data-id_client="{{ $client->id_client }}" class="text-gray"> Supprimer</a>
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




        <script src="{{ asset('assets/js/jquery.min.js')}}"></script>  
<script>
    $(document).ready(function() {
        // Quand l'utilisateur clique sur le bouton Supprimer
        $('.btn-delete-client').click(function(e) {
            e.preventDefault();

            var clientId = $(this).data('id_client'); // Récupère l'ID du client
            var token = $('meta[name="csrf-token"]').attr('content'); // Récupère le CSRF token pour Laravel

            // Confirmation de la suppression
            if (confirm('Êtes-vous sûr de vouloir supprimer ce client ?')) {
                $.ajax({
                    url: '/client/' + clientId, // URL pour la route de suppression
                    type: 'DELETE',
                    data: {
                        "_token": token
                    },
                    success: function(response) {
                          if (response.success) {
                              $('#client-row-' + clientId).remove();
                              alert(response.message); // Affiche le message de succès
                          } else {
                              alert(response.message); // Affiche le message d'erreur
                          }
                      },
                    error: function(xhr) {
                        // Si une erreur se produit
                        console.error(xhr);
                        alert('Erreur lors de la suppression. Veuillez réessayer.');
                    }
                });
            }
        });
    });
</script>
        
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