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


        </div>
        <!-- end container -->
      </section>
      <!-- ========== section end ========== -->




@endsection





