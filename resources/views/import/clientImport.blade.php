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
              <div class="col-md-12">
                <div class="title">
                  <h2>Importation des clients</h2>
                </div>
              </div>

            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->



          <div class="row">
          <div class="col-lg-8">
              <div class="card-style settings-card-2 mb-30">
                <h6 class="mb-25">Télécharger le fichier Excel</h6>
                <p class="text-sm mb-20">Sélectionnez un fichier Excel contenant les données des clients à importer.</p>

                <!-- Bouton de téléchargement du modèle -->
                <div class="alert alert-info mb-25" style="background-color: #e7f3ff; border-left: 4px solid #0066cc; padding: 15px;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <strong>Besoin d'un modèle ?</strong>
                            <p class="mb-0 mt-1" style="font-size: 14px;">Téléchargez le modèle Excel pour importer vos clients.</p>
                        </div>
                        <a href="{{ asset('Import_client_model.xlsx') }}" download class="main-btn primary-btn btn-hover" style="white-space: nowrap; color: white !important;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 5px; vertical-align: middle;">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                            Télécharger le modèle
                        </a>
                    </div>
                </div>

              <form action="{{ route('importClients') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="input-style-1 mb-25">
                        <label for="file">Fichier Excel</label>
                        <input type="file" id="file" name="file" accept=".xlsx,.xls" required
                               style="padding: 12px; border: 2px dashed #ddd; border-radius: 5px; width: 100%; cursor: pointer;"
                               onchange="updateFileName(this)">
                        <small class="text-muted" id="file-name">Formats acceptés: .xlsx, .xls</small>
                    </div>

                    <div class="col-12">
                        <button class="main-btn primary-btn btn-hover" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 5px; vertical-align: middle;">
                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                            </svg>
                            Importer le fichier
                        </button>
                    </div>
                </form>




    </div>
              <!-- end card -->
            </div>
            <!-- end col -->
        </div>
         <!-- end row -->


<script>
function updateFileName(input) {
    const fileName = input.files[0]?.name;
    const fileNameDisplay = document.getElementById('file-name');
    if (fileName) {
        fileNameDisplay.textContent = 'Fichier sélectionné: ' + fileName;
        fileNameDisplay.style.color = '#28a745';
    } else {
        fileNameDisplay.textContent = 'Formats acceptés: .xlsx, .xls';
        fileNameDisplay.style.color = '#6c757d';
    }
}
</script>


@endsection
