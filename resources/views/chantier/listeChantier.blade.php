<!-- resources/views/client/listClients.blade.php -->

@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')


   <!-- ========== title-wrapper start ========== -->
   <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6" >
                <div class="title">
                  <h2>Chantier</h2>
                </div>
              </div>






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
        <p>Aucun chantier trouvé.</p>
    @else

                  <table class="table top-selling-table">
                    <thead>
                      <tr>
                      <th>
                          <h6 class="text-sm text-medium">Reference chantier</h6>
                        </th>
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
                                Type mission
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                         Sous type mission
                          </h6>
                        </th>
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                        Debut exerice
                          </h6>
                        </th>
                        <th class="min-width">
                        <h6 class="text-sm text-medium">
                        Fin exerice
                        <span style="color: transparent;">....</span>
                          </h6>
                        </th>

                        <th class="min-width">
                        <h6 class="text-sm text-medium">
                        <span style="color: transparent;">....</span>
                     Etat <span style="color: transparent;">.........</span>
                          </h6>
                        </th>
                      
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                      Details
                          </h6>
                        </th>
                        @if (Auth::user()->role === 'Admin') 
                        <th class="min-width">
                          <h6 class="text-sm text-medium">
                      Actions
                          </h6>
                        </th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($con as $row)
                      <tr id="client-row-{{ $row->id_chantier }}">

                      <td>
                          <p class="text-sm">{{ $row->getDate->first()->reference_chantier ?? '-'}}</p>
                        </td>
                       
                        <td>
                          <p class="text-sm">{{ $row->client->code_client ?? '-'}}</p>
                        </td>
                        <td>
                          <span class="text-sm">{{ $row->client->nom_client ?? '-'}}</span>
                        </td>
                        <td>
                          <span class="text-sm">{{ $row->typeMission->types ?? '-' }}</span>
                        </td>
                        <td>
                          <span class="text-sm">{{ $row->sousTypeMission->types ?? '-' }}</span>
                        </td>

                        <td>
                          <p class="text-sm">{{ $row->debut_exercice ?? '-' }}</p>
                        </td>
                        <td>
                          <span class="text-sm">{{ $row->fin_exercice ?? '-' }}</span>
                        </td>

                      
                     
                        <td>
                        @if ($row->etat == 'false')
                          <span class="status-btn close-btn">Cloturé</span>
                          @else
                          <span class="status-btn success-btn">En cours</span>
                        @endif
                        </td>

                        <td>
                          <div class="action text-sm">
                        
                            <a style="margin-left:20px;" href="{{ route('detailsChantiers', $row->id_chantier) }}" class="edit">
                              <i class="lni lni-circle-plus"></i>
                            </a>
                            </div>
                        </td>

                        @if (Auth::user()->role === 'Admin') 
                        <td>
                         
                         <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                             <i class="lni lni-more-alt"></i>
                         </button>
           
                   
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                 <li class="dropdown-item">
                                   
                                     <a href="{{ route('chantier.modifier2', ['id_chantier' => $row->id_chantier]) }}" class="text-gray">Modifier</a>
                                 </li>
                                 
                                 <li class="dropdown-item">
                                 <a class="btn-delete-client" data-id_chantier="{{ $row->id_chantier }}" class="text-gray"> Supprimer</a>
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

<script src="{{ asset('assets/js/jquery.min.js')}}"></script>  
<script>
    $(document).ready(function() {
        // Quand l'utilisateur clique sur le bouton Supprimer
        $('.btn-delete-client').click(function(e) {
            e.preventDefault();

            var clientId = $(this).data('id_chantier'); // Récupère l'ID du client
            var token = $('meta[name="csrf-token"]').attr('content'); // Récupère le CSRF token pour Laravel

            // Confirmation de la suppression
            if (confirm('Êtes-vous sûr de vouloir cette ce chantier id ' + clientId + ' ?')) {
                $.ajax({
                    url: '/chantier/' + clientId, // URL pour la route de suppression
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
