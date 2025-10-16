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
      <form action="{{ route('choix.store', ['id_facture' => $id_facture]) }}" method="POST">
      @csrf
        <table class="table striped-table">
          <thead>
            <tr>
              <th></th>
              <th>
                <h6>Nom de la Banque</h6>
              </th>
              <th>
                <h6>Compte</h6>
              </th>
              <th>
                <h6>Type</h6>
              </th>
       
            </tr>
            <!-- end table row-->
          </thead>
          <tbody>
          @foreach ($banques as $banque)
            <tr>
                <td>
                <div class="check-input-primary">
                    <input type="checkbox" name="banques[]" value="{{ $banque->id_banque }}">
                </div>
                </td>
                <td><p>{{ $banque->nom_banque }}</p></td>
                <td><p>{{ $banque->compte }}</p></td>
                <td><p>{{ $banque->type }}</p></td>
            </tr>
        @endforeach
          
   
          </tbody>
        </table>
       






        </form>
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



