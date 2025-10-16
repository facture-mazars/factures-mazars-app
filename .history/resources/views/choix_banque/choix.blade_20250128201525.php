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
              <th>
                <h6>Modifier</h6>
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
                <td>    <button type="button" class="btn btn-primary" onclick="openEditModal({{ $banque->id_banque }})">Modifier</button></td>
            </tr>
        @endforeach
           <tr>
            <td>
           
            </td>
            <td> <a href="{{ route('tranche.modifier', ['id_facture' => $id_facture]) }}" class="main-btn primary-btn btn-hover" >Précédent</a></td>
            <td></td>
            <td>
            <!-- Bouton pour ouvrir la modal -->
            <button type="button" onclick="openEditModal({{ $banque->id_banque }})">Modifier</button>
        </td>
           </tr>
   
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




<style>
  #editModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
}

.modal-content {
    background-color: white;
    padding: 20px;
    margin: 100px auto;
    width: 50%;
    border-radius: 5px;
}

form div {
    margin-bottom: 10px;
}

</style>