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


          <div class="form-elements-wrapper">
            <div class="row">
              <div class="col-lg-6">
                <!-- input style start -->
                <div class="card-style mb-30">
                  <h6 class="mb-25">Input Fields</h6>
                  <div class="input-style-1">
                  <label for="nom_banque">Nom de la Banque</label>
                  <input type="text" name="nom_banque" id="nom_banque" class="form-control">
                  </div>
                  <!-- end input -->
                  <div class="input-style-2">
                  <label for="compte">Compte</label>
                  <input type="text" name="compte" id="compte" class="form-control">
                  </div>
                  <!-- end input -->
                  <div class="input-style-3">
                  <label for="type">Type</label>
                  <input type="text" name="type" id="type" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-success">Créer</button>
                  <!-- end input -->
                </div>
                <!-- end card -->
         
        
            
              </div>
    
            </div>
            <!-- end row -->
          </div>

     <div class="row">
          <div class="col-lg-12">
             
        <!-- ======= checkbox style start ======= -->
        <div class="row">
  <div class="col-lg-12">
    <div class="card-style mb-30">
   


    <form action="{{ route('banques.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom_banque">Nom de la Banque</label>
            <input type="text" name="nom_banque" id="nom_banque" class="form-control">
        </div>

        <div class="form-group">
            <label for="compte">Compte</label>
            <input type="text" name="compte" id="compte" class="form-control">
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" id="type" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
    </form>

 
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



