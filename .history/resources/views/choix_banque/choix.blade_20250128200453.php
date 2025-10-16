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
            <button 
    type="button" 
    class="btn btn-primary" 
    onclick="openEditModal({{ $banque->id }}, '{{ $banque->nom_banque }}', '{{ $banque->compte }}', '{{ $banque->type }}')">
    Modifier
</button>

        </td>
           </tr>
   
          </tbody>
        </table>
       

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier une banque</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="editNomBanque" class="form-label">Nom Banque</label>
                        <input type="text" class="form-control" id="editNomBanque" name="nom_banque" required>
                    </div>

                    <div class="mb-3">
                        <label for="editCompte" class="form-label">Compte</label>
                        <input type="text" class="form-control" id="editCompte" name="compte" required>
                    </div>

                    <div class="mb-3">
                        <label for="editType" class="form-label">Type</label>
                        <input type="text" class="form-control" id="editType" name="type">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
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

document.addEventListener("DOMContentLoaded", () => {
  function openEditModal(id, nomBanque, compte, type) {
    console.log("ID de la banque :", id);
    console.log("Nom de la banque :", nom_banque);
    console.log("Compte :", compte);
    console.log("Type :", type);

    const editForm = document.getElementById('editForm');
    if (!editForm) {
        console.error("Le formulaire d'édition n'a pas été trouvé !");
        return;
    }

    editForm.action = `/choix-banque/${id}`;
    document.getElementById('editNomBanque').value = nomBanque;
    document.getElementById('editCompte').value = compte;
    document.getElementById('editType').value = type;

    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    modal.show();
}


    // Rendre accessible globalement si nécessaire
    window.openEditModal = openEditModal;
});


// Ouvre la modal et remplit les champs avec les données de la banque
// function openEditModal(id) {
//     // Requête AJAX pour récupérer les données de la banque via l'ID
//     fetch(`/banques/edit/${id}`)
//         .then(response => response.json())
//         .then(data => {
//             // Remplir les champs du formulaire avec les données de la banque
//             document.getElementById('nom_banque').value = data.nom_banque;
//             document.getElementById('compte').value = data.compte;
//             document.getElementById('type').value = data.type;

//             // Modifier l'action du formulaire pour que la soumission pointe vers la bonne URL
//             const form = document.getElementById('editForm');
//             if (form) {
//                 form.action = `/banques/update/${id}`;
//             }

//             // Afficher la modal
//             document.getElementById('editModal').style.display = 'block';
//         })
//         .catch(error => {
//             console.error('Erreur lors de la récupération des données de la banque:', error);
//         });
// }

// // Fermer la modal sans enregistrer
// function closeEditModal() {
//     document.getElementById('editModal').style.display = 'none';
// }

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