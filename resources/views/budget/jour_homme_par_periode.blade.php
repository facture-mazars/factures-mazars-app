@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')
  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title d-flex align-items-center flex-wrap">
                  <h2 class="mr-40">Rapport des Jours-Homme</h2>
               
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->

          <div class="container-fluid">
    <div class="row">
    <div class="col-xl-3 col-lg-4 col-sm-6">
              <div class="icon-card mb-30">
                <div class="icon purple">
                  <i class="lni lni-cart-full"></i>
                </div>
                <div class="content">
                <form action="{{ route('budget.jourHommeParPeriode') }}" method="GET">
                  <h6 class="mb-10">Choisissez la période :</h6>
                  <div class="select-style-1">
                      <div class="select-position select-sm">
                        <select name="periode" id="periode" class="light-bg" required>
                        <option value="">Selectionner</option>
                        <option value="semaine" {{ request('periode') == 'semaine' ? 'selected' : '' }}>Par semaine</option>
                        <option value="mois" {{ request('periode') == 'mois' ? 'selected' : '' }}>Par mois</option>
                        <option value="annee" {{ request('periode') == 'annee' ? 'selected' : '' }}>Par année</option>

                        </select>
                      </div>
                      <br>
                      <button type="submit" class="main-btn primary-btn btn-hover">Calculer</button>
                    </div>
                    </form>
                </div>
              </div>
              <!-- End Icon Cart -->
               </div>
           <!-- End Col -->
           <div class="col-xl-5 col-lg-8 col-sm-6">
              <div class="icon-card mb-30">
              <div class="icon success">
                  <i class="lni lni-dollar"></i>
                </div>
                <div class="content">
                                
    @if(isset($jours_homme_par_periode))
               
                  <h3 class="text-bold mb-10">Jours-Homme par {{ request('periode') }}</h3>
                  
                  <table class="table top-selling-table">
            <thead>
                <tr>
                    <th></th>
                    <th>Période</th>
                    <th style="text-align:center;">Total Jours-Homme</th>
                    <th style="text-align:end;">Taux Moyen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jours_homme_par_periode as $jour)
                    <tr>
                        <td></td>
                        <td>{{ $jour->periode }}</td>
                        <td style="text-align:center;">{{ $jour->total_jour_homme }}</td>
                        <td>{{ number_format($jour->taux_moyen, 2, ',', ' ') }}</td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
                </div>
              </div>
              </div>
              <!-- End Icon Cart -->


              <div class="row">
            <div class="col-lg-8">
              <div class="card-style mb-30">
             <h4>Tableau de bord</h4>
                <!-- End Title -->
                <div class="chart">
                <canvas id="chartJourHomme" style="width: 80%; margin: 0 auto;"></canvas>
                </div>
                <!-- End Chart -->

<script src="{{ asset('assets/js/Chart.min.js')}}"></script>
<script src="{{ asset('assets/js/chart.js')}}"></script>

<script>
    // Préparer les données pour le graphique
    var labels = [];
    var dataJoursHomme = [];
    var dataTauxMoyen = [];

    @foreach($jours_homme_par_periode as $row)
    labels.push("{{ $row->periode }}");
    dataJoursHomme.push("{{ $row->total_jour_homme }}");
    dataTauxMoyen.push("{{ $row->taux_moyen }}");
    @endforeach

    var ctx = document.getElementById('chartJourHomme').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar', // Type de graphique (bar, line, etc.)
        data: {
            labels: labels, // Périodes
            datasets: [
                {
                    label: 'Total jours-homme',
                    data: dataJoursHomme, // Données des jours-homme
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    tension: 0.4,
                    yAxisID: 'y' // Lier au premier axe Y
                },
                {
                  label: 'Taux moyen',
                    data: dataTauxMoyen, // Données du taux moyen
                    backgroundColor: 'rgba(255, 159, 64, 0.2)', // Fond léger pour le line
                    borderColor: 'rgba(255, 159, 64, 1)', // Couleur de la courbe
                    borderWidth: 2,
                    fill: false, // Pas de remplissage sous la ligne
                    tension: 0.4, // Courbe lisse
                    yAxisID: 'y1', // Axe Y pour le taux moyen
                    type: 'line' // Type de graphique pour ce dataset (ligne)
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    type: 'linear',
                    position: 'left', // Premier axe Y
                    title: {
                        display: true,
                        text: 'Total jours-homme'
                    }
                },
                y1: {
                    beginAtZero: true,
                    type: 'linear',
                    position: 'right', // Deuxième axe Y
                    title: {
                        display: true,
                        text: 'Taux moyen '
                    },
                    grid: {
                        drawOnChartArea: false // Empêche l'affichage de la grille sur ce côté
                    }
                }
            }
        }
    });
</script>

             
              </div>
            </div>
            <!-- End Col -->

            
           


          
            </div>
          <!-- End Row -->
        </div>
        <!-- end container -->

@endsection