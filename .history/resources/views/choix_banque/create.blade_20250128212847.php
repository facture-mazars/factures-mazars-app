@extends('layouts.app')
       
@section('content')



          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-12">
                <div class="title">
                  <h2>Nouvelle banque
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
              <form action="{{ route('banques.store') }}" method="POST">
              @csrf
                <!-- input style start -->
                <div class="card-style mb-30">
            
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
         
                </form>
            
              </div>
    
            </div>
            <!-- end row -->
          </div>






@endsection



