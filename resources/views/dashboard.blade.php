@extends('layouts.app')
       
@section('content')

  <!-- ========== section start ========== -->
  <section class="section">
        <div class="container-fluid">

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
                  <h2>Tableau de bord</h2>
                </div>
              </div>
            
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->
         
          <div class="row">
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon purple">
                  <i class="lni lni-users"></i>
                </div>
                <div class="content">
                  <h6 class="mb-10" style="text-align: center;">Les clients</h6>
                  <h3 class="text-bold mb-10" style="text-align: center;">{{ number_format($clientCount, 0, ',', ' ') }}</h3>
                  @if ($variationClients['clientsRecents'] > 0)
                      <p class="text-sm text-success">
                          <i class="lni lni-arrow-up"></i> + {{ $variationClients['clientsRecents'] }}
                          <span class="text-gray">(30 jours)</span>
                      </p>
                    @elseif ($variationClients['clientsRecents'] < 0)
                        <p class="text-sm text-danger">
                            <i class="lni lni-arrow-down"></i> - {{ abs($variationClients['clientsRecents']) }}
                            <span class="text-gray">(30 jours)</span>
                        </p>
                   
                    @endif
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon success">
                  <i class="lni lni-home"></i>
                </div>
                <div class="content">
                  <h6 class="mb-10" style="text-align: center;">Les chantiers en cours</h6>
                  <h3 class="text-bold mb-10" style="text-align: center;">{{ number_format($chantierCount, 0, ',', ' ') }}</h3>
                  @if ($variationStatistiques['chantiersRecents'] > 0)
                      <p class="text-sm text-success">
                          <i class="lni lni-arrow-up"></i> + {{ $variationStatistiques['chantiersRecents'] }}
                          <span class="text-gray">(30 jours)</span>
                      </p>
                    @elseif ($variationStatistiques['chantiersRecents'] < 0)
                        <p class="text-sm text-danger">
                            <i class="lni lni-arrow-down"></i> - {{ abs($variationStatistiques['chantiersRecents']) }}
                            <span class="text-gray">(30 jours)</span>
                        </p>
                   
                    @endif
                                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon primary">
                  <i class="lni lni-user"></i>
                </div>
                <div class="content">
                  <h6 class="mb-10" style="text-align: center;">Jour homme effectué</h6>
                  <h3 class="text-bold mb-10" style="text-align: center;"> {{ number_format($totalAllJourHomme, 2, ',', ' ') }}</h3>
                  <p class="text-sm text-danger">
                   
                    <span class="text-gray"></span>
                  </p>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon orange">
                  <i class="lni lni-files"></i>
                </div>
                <div class="content">
                  <h6 class="mb-10" style="text-align: center;">Les factures</h6>
                  <h3 class="text-bold mb-10" style="text-align: center;">{{ number_format($facCount, 0, ',', ' ') }}</h3>
                  <p class="text-sm text-danger">
             
                    <span class="text-gray"> </span>
                  </p>
                </div>
              </div>
              <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
          </div>
          <!-- End Row -->

          <!-- Section Chantiers Incomplets -->
          @if($nbChantiersIncomplets > 0)
          <div class="row">
            <div class="col-lg-12">
              <div class="card-style mb-30">
                <div class="title d-flex flex-wrap align-items-center justify-content-between">
                  <div class="left">
                    <h6 class="text-medium mb-10">⚠️ Chantiers à compléter ({{ $nbChantiersIncomplets }})</h6>
                    <p class="text-sm text-gray">Ces chantiers ont une création incomplète. Veuillez terminer le processus.</p>
                  </div>
                  <div class="right">
                    <a href="{{ route('chantier.show') }}" class="main-btn primary-btn btn-hover btn-sm">Voir tous</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table top-selling-table">
                    <thead>
                      <tr>
                        <th><h6 class="text-sm text-medium">Client</h6></th>
                        <th><h6 class="text-sm text-medium">Type Mission</h6></th>
                        <th><h6 class="text-sm text-medium">Étape actuelle</h6></th>
                        <th><h6 class="text-sm text-medium">Dernière mise à jour</h6></th>
                        <th><h6 class="text-sm text-medium">Action</h6></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($chantiersIncomplets as $chantier)
                      <tr>
                        <td><p class="text-sm">{{ $chantier->client->nom_client ?? '-' }}</p></td>
                        <td><p class="text-sm">{{ $chantier->typeMission->types ?? '-' }}</p></td>
                        <td><span class="status-btn warning-btn">{{ ucfirst($chantier->etape_actuelle) }}</span></td>
                        <td><p class="text-sm text-gray">{{ $chantier->updated_at->diffForHumans() }}</p></td>
                        <td>
                          <a href="{{ route('chantier.modifier', ['id_chantier' => $chantier->id_chantier]) }}" class="main-btn primary-btn btn-hover btn-sm">Continuer</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          @endif
          <!-- End Section Chantiers Incomplets -->




          <form action="{{ route('dashboard') }}" method="GET">
          <div class="row">
            <div class="col-lg-7">
              <div class="card-style mb-30">
                <div class="title d-flex flex-wrap justify-content-between">
                  <div class="left">
                    <h6 class="text-medium mb-10">Statut chantier par ans</h6>
                    <h3 class="text-bold"></h3>
                  </div>
                  <div class="right">
                    <div class="select-style-1">
                      <div class="select-position select-sm">
  
                      <select class="light-bg" name="annee_chantier" id="annee_chantier" onchange="this.form.submit()">
                  @foreach($annees as $annee)
                    <option value="{{ $annee }}" {{ $selectedYear == $annee ? 'selected' : '' }}>
                      {{ $annee }}
                    </option>
                  @endforeach
                </select>
                  


                      
                      
                      </div>
                    </div>
                    <!-- end select -->
                  </div>
                </div>
                <!-- End Title -->
         
                <div style="width: 80%; margin: 0 auto;">
        <canvas id="myChart"></canvas>
    </div>
    <script src="{{ asset('assets/js/Chart.min.js')}}"></script>
   
  
  
<script>
    const labels = {!! json_encode($chantiersParMois->pluck('mois')) !!};
    const data = {!! json_encode($chantiersParMois->pluck('nombre_chantiers')) !!};

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Nombre de chantiers',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
                <!-- End Chart -->
              </div>
            </div>
            <!-- End Col -->
            <div class="col-lg-5">
              <div class="card-style mb-30">
                <div class="title d-flex flex-wrap align-items-center justify-content-between">
                  <div class="left">
                    <h6 class="text-medium mb-30">Statut facture par ans</h6>
                  </div>
                  <div class="right">
                    <div class="select-style-1">
                    <div class="select-position select-sm">

                    <select name="annee_facture" id="annee_facture" onchange="this.form.submit()">
                        @foreach($anneesfacture as $annee)
                            <option value="{{ $annee }}" {{ $annee == $selectedYearFacture ? 'selected' : '' }}>{{ $annee }}</option>
                        @endforeach
                    </select>
                        </div>
                     
                    </div>
                    <!-- end select -->
                  </div>
                </div>
                <!-- End Title -->
                <div style="width: 117%; margin: 0 auto;">


    <!-- Chart des factures -->
    <canvas id="factureChart"></canvas>
    <script>
        const factureData = {
            labels: ['Payées', 'Non Payées', 'Partiellement Payées'],
            datasets: [{
                label: 'Factures par État',
                data: [
                    {{ $factures->payees }},
                    {{ $factures->non_payees }},
                    {{ $factures->partiellement_payees }},
                 
                ],
                backgroundColor: [
                'rgba(54, 162, 0, 0.2)',    // Payées
                'rgba(255, 99, 132, 0.2)',  // Non Payées
                'rgba(255, 206, 86, 0.2)' // Partiellement Payées
                 // Total
            ],
            borderColor: [
                'rgba(54, 162, 0, 0.3)',      // Payées
                'rgba(255, 99, 132, 0.3)',    // Non Payées
                'rgba(255, 206, 86, 0.3)'    // Partiellement Payées
               
            ],
            borderWidth: [1, 1, 1, 1]
            }]
        };

        const factureChart = new Chart(document.getElementById('factureChart'), {
            type: 'pie', // ou autre type de graphique
            data: factureData,
            options: {}
        });
    </script>
</div>

                <!-- End Chart -->
              </div>
            </div>
            <!-- End Col -->
          </div>


          <div class="col-lg-12">
              <div class="card-style mb-30">
                <div class="title d-flex flex-wrap justify-content-between">
                  <div class="left">
                    <h6 class="text-medium mb-10">Statut budget par ans</h6>
                    <h3 class="text-bold"></h3>
                  </div>
                  <div class="right">
                    <div class="select-style-1">
                      <div class="select-position select-sm">
                    
                      <select name="annee_budget" id="annee_budget" onchange="this.form.submit()">
                          @foreach($anneesBudget as $annee)
                              <option value="{{ $annee }}" {{ $annee == $selectedYearBudget ? 'selected' : '' }}>{{ $annee }}</option>
                          @endforeach
                      </select>
                       
                      </div>
                    </div>
                    <!-- end select -->
                  </div>
                </div>


                <!-- Chart pour le budget -->


<canvas id="budgetChart"></canvas>
<script>
    const budgetData = {
        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
        datasets: [{
            label: 'Total Global pour {{ $selectedYearBudget }}', // Série 1 : Total Global
            data: {!! json_encode($montantsGlobal) !!}, // Montants des budgets mensuels pour total_global
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            fill: true,
            tension: 0.6,
            yAxisID: 'y1'  // Premier axe Y
        },
        {
            label: 'Total Jour Homme pour {{ $selectedYearBudget }}', // Série 2 : Total Jour Homme
            data: {!! json_encode($montantsJourHomme) !!}, // Montants des jours-homme mensuels
            
            backgroundColor: 'transparent', // Fond léger pour le line
            borderColor: 'rgba(255, 159, 64, 1)', // Couleur de la courbe
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            yAxisID: 'y2'  // Deuxième axe Y
        }]
    };

    new Chart(document.getElementById('budgetChart'), {
        type: 'line',
        data: budgetData,
        options: {
            scales: {
                yAxes: [{
                    id: 'y1',
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {
                            // Diviser par 1000 pour afficher en milliers et formater avec un séparateur de milliers
                            return Intl.NumberFormat().format(value) + ' ar'; // Formattage pour total_global
                        }
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Total Global (Ar)',
                    }
                },
                {
                    id: 'y2',
                    type: 'linear',
                    position: 'right',
                    ticks: {
                    beginAtZero: true,
                    callback: function(value) {
                        return value + ' JH'; // Ajouter le suffixe 'JH' pour les jours-homme
                    }
                  },
                    scaleLabel: {
                        display: true,
                        labelString: 'Total Jour Homme',
                    }
                }],
                xAxes: [{
                    ticks: {
                        autoSkip: false  // Afficher tous les mois
                    }
                }]
            }
        }
    });
</script>


                <!-- End Title -->
       

              </div>
            </div>
            <!-- End Col -->


          <!-- End Row -->
          </form>
        </div>
        <!-- end container -->
      </section>
      <!-- ========== section end ========== -->




@endsection





