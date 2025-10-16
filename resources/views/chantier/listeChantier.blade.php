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
                     Statut Création
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
                          <div class="statut-creation-container">
                        @if ($row->statut_completion == 'complet')
                          <span class="badge-statut badge-complet">Complet</span>
                          @else
                            <span class="badge-statut badge-encours">Étape: {{ ucfirst($row->etape_actuelle ?? 'chantier') }}</span>
                            @php
                              // Déterminer l'URL en fonction de l'étape actuelle
                              $continueUrl = '#';
                              switch($row->etape_actuelle) {
                                case 'date':
                                  $continueUrl = route('getdate.create', ['id_chantier' => $row->id_chantier]);
                                  break;
                                case 'equipe':
                                  $continueUrl = route('equipe.create', ['id_chantier' => $row->id_chantier]);
                                  break;
                                case 'budget':
                                  $continueUrl = route('budget.create', ['id_chantier' => $row->id_chantier]);
                                  break;
                                case 'facture':
                                  $continueUrl = route('facture.create', ['id_chantier' => $row->id_chantier]);
                                  break;
                                case 'tranche':
                                  $facture = $row->factures->first();
                                  if ($facture) {
                                    $continueUrl = route('tranche.create', ['id_facture' => $facture->id_facture]);
                                  }
                                  break;
                                case 'banque':
                                  $facture = $row->factures->first();
                                  if ($facture) {
                                    $continueUrl = route('choix.create', ['id_facture' => $facture->id_facture]);
                                  }
                                  break;
                              }
                            @endphp
                            <a href="{{ $continueUrl }}" class="link-continuer">Continuer →</a>
                        @endif
                          </div>
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
                            <a href="{{ route('detailsChantiers', $row->id_chantier) }}" class="edit">
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

<style>
/* Container pour aligner les éléments */
.statut-creation-container {
    display: flex;
    flex-direction: column;
    gap: 5px;
    min-height: 50px;
    justify-content: center;
}

/* Badge statut */
.badge-statut {
    display: inline-block;
    padding: 4px 10px;
    font-size: 11px;
    font-weight: 500;
    border-radius: 4px;
    white-space: nowrap;
}

.badge-complet {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.badge-encours {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Lien Continuer */
.link-continuer {
    color: #4285f4;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
    display: inline-block;
    transition: all 0.2s ease;
}

.link-continuer:hover {
    color: #1a73e8;
    text-decoration: underline;
}
</style>

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
