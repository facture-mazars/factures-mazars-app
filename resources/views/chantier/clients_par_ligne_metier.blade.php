@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')
  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title d-flex align-items-center flex-wrap">
                  <h2 class="mr-40">Decomposition par ligne metier</h2>
               
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
    <div class="col-lg-12">
              <div class="card-style mb-30">
                <div class="title d-flex flex-wrap align-items-center justify-content-between">
                  <div class="left">
                   
                  </div>
              
                </div>
                <!-- End Title -->
                <div class="table-responsive">

          <table class="table top-selling-table">
    <thead>
        <tr>
            <th>Code mission</th>
            <th style="text-align:center;">Type mission</th>
            <th>Clients</th>
        </tr>
    </thead>
    <tbody>
    @foreach($clientsParLigneMetier as $group => $chantierGroup)
            @php
                $firstChantier = $chantierGroup->first();
            @endphp

            
            <tr>
                <td>{{ $firstChantier->typeMission->code_mission ?? 'Non défini' }}</td>
                
                <td style="text-align:center;">{{ $firstChantier->typeMission->types ?? 'Non défini' }}   </td>
                <td>
                    <ul>
                        @foreach($chantierGroup as $chantier)
                            @foreach($chantier->clients as $client)
                                <li> {{ $client->nom_client }}</li>
                            @endforeach
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
              </div>
            </div>
            <!-- End Col -->
            </div>
          <!-- End Row -->
        </div>
        <!-- end container -->

@endsection