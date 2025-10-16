<!-- resources/views/check_encaissement.blade.php -->
@extends('layouts.app')

@section('content')

<style>
 

.table-container {
    max-width: 12000px;
    margin: auto;
    overflow-x: auto; /* Pour permettre le défilement horizontal */
}

table {
    width: 150%;
    border-collapse: collapse;
    border: 0.1px solid #000;
}

th, td {
    border: 0.1px solid #000;
   font-size: small;
    text-align: center;
    padding: 5px;
}



tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

tbody tr:hover {
    background-color: #ddd;
}

</style>
<!-- ========== title-wrapper start ========== -->
<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2>Baromètre de facturation</h2>
            </div>
        </div>





        


     

    </div>
</div>
<!-- ========== title-wrapper end ========== -->





          <div class="row">
              <div class="col-lg-20">
                <div class="card-style mb-30">
                <!-- Formulaire de sélection d'année -->



                <div class="title d-flex flex-wrap justify-content-between">
                <div class="left">
                <div class="select-style-1">
                <div class="select-position select-sm">

                            <form id="filterForm" method="GET" action="{{ route('barometre.filtre') }}">
                  
                    <select class="light-bg" name="year" id="year" onchange="submitForm()">
                        <option value=""> Selectionner une année</option>
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}">
                                {{ $year }} <!-- Affiche l'année au format complet -->
                            </option>
                        @endforeach
                    </select>
                </form>

    </div>
    </div>
    </div>
    </div>

    <script>
        function submitForm() {
            // Soumettre le formulaire automatiquement
            document.getElementById('filterForm').submit();
        }
    </script>
                  <div class="table-wrapper table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            <h6>Initialisation</h6>
                          </th>
                          <th>
                            <h6>Code</h6>
                          </th>
                          <th>
                            <h6>Client</h6>
                          </th>
                          <th>
                            <h6>Mission <span style="color:transparent;">.............</span></h6>
                          </th>
                          <th>
                            <h6>Honoraire Total <span style="color:transparent;"> ...................................</span></h6>
                          </th>
                          <th>
                            <h6>J/H Total <span style="color:transparent;">.............</span></h6>
                          </th>


                          <th>
                            <h6>Taux moyen <span style="color:transparent;"> .......................</span> </h6>
                          </th>
                          @foreach($moisAnnees as $moisAnnee)
                    <th>{{ $moisAnnee }} <span style="color:transparent;"> .....................</span></th>
                @endforeach
                <th>Total <span style="color:transparent;"> .....................</span></th>

                        </tr>
                        <!-- end table row-->
                      </thead>
                      <tbody>


                      @foreach($chantiers as $barometre)
            <tr>
            <td>{{ $barometre['date_initialisation'] }}</td>

                <td>{{ $barometre['reference_chantier'] }}</td>
                <td>{{ $barometre['nom_client'] }}</td>
                <td>{{ $barometre['sous_type_mission'] }}</td>
                <td> {{ number_format($barometre['montant_honoraire_par_facture'], 2, ',', ' ') }} </td>
                <td> {{ number_format($barometre['total_jour_homme'], 2, ',', ' ') }} </td>
               
                <td>{{ number_format($barometre['taux_moyen'], 2, ',', ' ') }} </td>
                @php
                    // Initialiser le total annuel pour le chantier
                    $totalAnnuel = 0;
                @endphp
              

              @foreach($moisAnnees as $moisAnnee)
                <td>
                    @php
                        $montant = $barometre['factures_par_mois'][$moisAnnee] ?? 0; // Récupérer le montant ou 0 si absent
                        $totalAnnuel += $montant; // Ajouter au total annuel
                    @endphp

                    {{ $montant > 0 ? number_format($montant, 2, ',', ' ') : '-' }}
                </td>
            @endforeach

            <td>{{ number_format($totalAnnuel, 2, ',', ' ') }}</td> <!-- Afficher le total annuel du chantier -->
      
            </tr>
            @endforeach


                    

                  
                        <!-- end table row -->
                      </tbody>
           

                      <tfoot>
    <tr>
    <td colspan="4"><strong>Total</strong></td>
    <td> {{ number_format($sommeTotalGlobal, 2, ',', ' ') }}  </td>
            <td>{{ number_format($sommeTotalJourHomme, 2, ',', ' ') }}</td>
           


        <td><strong></strong></td>
        @foreach($moisAnnees as $moisAnnee)
            <td>
                @php
                    // Extraire l'année à partir du mois-année
                    $annee = substr($moisAnnee, -2); // Récupérer les deux derniers chiffres de l'année
                @endphp
                {{ number_format($totauxAnnuels[$annee][$moisAnnee] ?? 0, 2, ',', ' ') }}
            </td>
        @endforeach
        <td>
    @php
        $totalGeneral = 0;
        foreach ($totauxAnnuels as $annee) {
            $totalGeneral += array_sum($annee); // Additionner tous les montants des mois pour chaque année
        }
    @endphp
    {{ number_format($totalGeneral, 2, ',', ' ') }} <!-- Total général -->
</td>

    </tr>
</tfoot>


                    </table>
                    <!-- end table -->
                  </div>
                </div>
                <!-- end card -->
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
@endsection
