@extends('layouts.app')
       
@section('content')



          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-12">
                <div class="title">
                  <h2>Choisir les banques pour votre facture
                    </h2>   
                </div>
              </div>
            
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->

     <div class="row">
          <div class="col-lg-12">
             
        <!-- ======= checkbox style start ======= -->
        <div class="row">
  <div class="col-lg-12">
    <div class="card-style mb-30">
   

      <div class="table-wrapper table-responsive">
      <a href=" route()" class="main-btn primary-btn btn-hover" >Nouveau banque</a>
        <table class="table striped-table">
          <thead>
            <tr>
              <th>Nom banque</th>
              <th>
                <h6>Compte</h6>
              </th>
              <th>
                <h6>Type</h6>
              </th>
              <th>
                <h6></h6>
              </th>
       
            </tr>
            <!-- end table row-->
          </thead>
          <tbody>
          @foreach ($banques as $banque)
            <tr>
            <td>{{ $banque->nom_banque }}</td>
                    <td>{{ $banque->compte }}</td>
                    <td>{{ $banque->type }}</td>
                    <td>
                        <a href="{{ route('banques.edit', $banque->id_banque) }}" class="btn btn-primary">Modifier</a>
                        <!-- Vous pouvez ajouter d'autres actions ici, comme supprimer -->
                    </td>
            </tr>
        @endforeach
          
   
          </tbody>
        </table>
       
        <!-- end table -->
      </div>
    </div>
    <!-- end card -->
  </div>

</div>
                <!-- ======= checkbox style end ======= -->

              <!-- end card -->
            </div>
            <!-- end col -->
        </div>
         <!-- end row -->





@endsection



