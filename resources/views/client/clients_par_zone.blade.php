@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')


  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title d-flex align-items-center flex-wrap">
                  <h2 class="mr-40">Details</h2>
               
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
            <th></th>
            <th>Zone geographique</th>
        
            <th>Clients</th>
        </tr>
    </thead>
    <tbody>
    @foreach($clientsParZone as $zone => $clients)
            <tr>
               <td></td>
                <td>{{ $zone }}</td>
                <td>
                <ul>
        @foreach($clients as $client)
            <li>-{{ $client->nom_client }}</li>
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