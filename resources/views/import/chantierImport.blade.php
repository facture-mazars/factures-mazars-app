<!-- resources/views/mission/insertMission.blade.php -->

@extends('layouts.app')

@section('content')


      <!-- Afficher le message de succès -->
      @if(session('success'))
          
         <div id="success-message" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h3>Import chantier </h3>
                </div>
              </div>
            
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->



          <div class="row">
          <div class="col-lg-6">
              <div class="card-style settings-card-2 mb-30">


              <form action="{{ route('importChantiers') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Choisir un fichier Excel</label>
            <input type="file" name="file" class="form-control" accept=".xlsx, .xls, .csv" required>
        </div>

        <button type="submit" class="btn btn-primary">Importer</button>
    </form>

 


   

    </div>
              <!-- end card -->
            </div>
            <!-- end col -->
        </div>
         <!-- end row -->




@endsection
