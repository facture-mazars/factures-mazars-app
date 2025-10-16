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
            <td> <button class="main-btn primary-btn btn-hover" type="submit">
                        Suivant
                      </button></td>
           </tr>
   
          </tbody>
        </table>
       

      <!-- Modal -->
<div id="editModal" style="display:none;">
    <div class="modal-content">
        <h5>Modifier la banque</h5>
        <form id="editForm" method="POST" action="" class="form">
            @csrf
            @method('PUT')
            <div>
                <label for="nom_banque">Nom Banque:</label>
                <input type="text" name="nom_banque" id="nom_banque">
            </div>
            <div>
                <label for="compte">Compte:</label>
                <input type="text" name="compte" id="compte">
            </div>
            <div>
                <label for="type">Type:</label>
                <input type="text" name="type" id="type">
            </div>
            <button type="submit">Enregistrer</button>
            <button type="button" onclick="closeEditModal()">Annuler</button>
        </form>
    </div>
</div>


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




   <script>
  // Fonction pour ouvrir la modal et remplir les champs du formulaire
function openEditModal(id) {
    // Effectuer une requête AJAX pour récupérer les données de la banque
    fetch(`/banques/edit/${id}`)
        .then(response => response.json())
        .then(data => {
            // Remplir le formulaire avec les données de la banque
            document.getElementById('nom_banque').value = data.nom_banque;
            document.getElementById('compte').value = data.compte;
            document.getElementById('type').value = data.type;

            // Modifier l'action du formulaire pour envoyer les données vers la bonne URL
            document.getElementById('editForm').action = `/banques/update/${id}`;

            // Afficher la modal
            document.getElementById('editModal').style.display = 'block';
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données de la banque:', error);
        });
}

// Fonction pour fermer la modal
function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

    </script>



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