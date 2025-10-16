@extends('layouts.app')

@section('content')

    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="title">
                    <h2>Modifier {{ $client->nom_client }} : {{ $client->code_client }} - {{ $chantier->sousTypeMission->types ?? '-' }}</h2>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="row">
        <div class="col-lg-6">
            <div class="card-style settings-card-2 mb-30">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('getdate.update', $chantier->id_chantier) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- méthode PUT pour mettre à jour -->
                    <div class="row">

                    <input type="hidden" name="id_chantier" value="{{ $chantier->id_chantier }}">


                     <!--  -->
                     <div class="col-xxl-6">
                            <div class="input-style-1">
                                <label for="reference_date">Référence date</label>
                                <input type="text" name="reference_date" id="reference_date" class="form-control" value="{{ $getdates->first()->reference_date }}" oninput="updateReferenceChantier()">
                            </div>
                        </div>

                       
                     
             <!-- Référence Chantier pré-remplie -->
             <div class="col-xxl-6">
            <div class="input-style-1">
                <label for="reference_chantier">Référence Chantier</label>
                <input type="text" id="reference_chantier" name="reference_chantier" value="{{ $getdates->first()->reference_chantier ?? '' }}">
            </div>
        </div>
                  
                      
                          
                    <div class="col-xxl-6">
    <div class="input-style-1">
        <label for="date_initialisation">Date d'initialisation</label>
        <input type="date" name="date_initialisation" id="date_initialisation" class="form-control" value="{{ $getdates->first()->date_initialisation ?? '' }}">
    </div>
</div>


                      
                           <!--  -->
                           <div class="col-xxl-6">
                            <div class="input-style-1">
                                <label for="date_debut_intervention">Debut intervention</label>
                                <input type="date" name="date_debut_intervention" id="date_debut_intervention" class="form-control" value="{{ $getdates->first()->date_debut_intervention }}">
                            </div>
                        </div>

                           <!--  -->
                           <div class="col-xxl-6">
                            <div class="input-style-1">
                                <label for="date_fin_intervention">Fin intervention</label>
                                <input type="date" name="date_fin_intervention" id="date_fin_intervention" class="form-control" value="{{ $getdates->first()->date_fin_intervention }}">
                            </div>
                        </div>

                     




                        <!-- autres champs ici, similaires aux champs de l'insertion -->
                        
                        <div class="col-12">
                      <button class="main-btn primary-btn btn-hover" type="submit">
                        Valider
                      </button>
                    </div>

                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

<script>
    function updateReferenceChantier() {
        // Récupère la valeur actuelle de reference_date
        const referenceDateValue = document.getElementById('reference_date').value;

        // Récupère le champ reference_chantier
        const referenceChantierInput = document.getElementById('reference_chantier');
        let originalChantierValue = "{{ $getdates->first()->reference_chantier ?? '' }}";

        // Si reference_date existe déjà dans reference_chantier, on la remplace
        if (originalChantierValue.includes("{{ $getdates->first()->reference_date }}")) {
            originalChantierValue = originalChantierValue.replace("{{ $getdates->first()->reference_date }}", referenceDateValue);
        } else {
            // Sinon, on ajoute simplement la nouvelle valeur
            originalChantierValue += referenceDateValue;
        }

        // Mise à jour du champ reference_chantier avec la nouvelle valeur
        referenceChantierInput.value = originalChantierValue;
    }
</script>