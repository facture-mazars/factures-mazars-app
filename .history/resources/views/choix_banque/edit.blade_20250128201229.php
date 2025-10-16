@extends('layouts.app')

@section('content')

  
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title">
                    <h2>Modifier le contrat / chantier</h2>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="row">
        <div class="col-lg-12">
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

                <form action="{{ route('chantier.update2', $chantier->id_chantier) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- méthode PUT pour mettre à jour -->
                    <div class="row">

                        <!-- id_client -->
                        <div class="col-xxl-4">
                            <div class="select-style-1">
                                <label for="id_clients">CLIENT : <span class="text-danger">*</span> </label>
                                <div class="select-position">
                                    <select class="light-bg" id="id_client" name="id_client">
                                        @foreach($clients as $c)
                                            <option value="{{ $c->id_client }}" {{ $chantier->id_client == $c->id_client ? 'selected' : '' }}>{{ $c->nom_client }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                         <!-- type_mission -->
                    <div class="col-xxl-4">
                        <div class="select-style-1">
                            <label for="id_type_mission">Type de Mission : <span class="text-danger">*</span> </label>
                            <div class="select-position">
                                <select class="light-bg" id="id_type_mission" name="id_type_mission">
                                    <option value="">Sélectionnez un type mission</option>
                                    @foreach($type_missions as $type)
                                        <option value="{{ $type->id_type_mission }}" {{ $chantier->id_type_mission == $type->id_type_mission ? 'selected' : '' }}>
                                            {{ $type->types }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- sous_type_mission -->
                    <div class="col-xxl-4">
                        <div class="select-style-1">
                            <label for="id_sous_type_mission">Sous type de Mission : <span class="text-danger">*</span> </label>
                            <div class="select-position">
                                <select class="light-bg" id="id_sous_type_mission" name="id_sous_type_mission" disabled>
                                   
                                    @foreach($sous_type_missions as $sousType)
                                        <option value="{{ $sousType->id_sous_type_mission }}" {{ $chantier->id_sous_type_mission == $sousType->id_sous_type_mission ? 'selected' : '' }}>
                                            {{ $sousType->types }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                       

                    <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label for="objet">Objet : <span class="text-danger">*</span> </label>
                                <input type="text" name="objet" id="objet" class="form-control" value="{{ $chantier->objet }}">
                            </div>
                        </div>

                
                        <!-- est_recurrent -->
                        <div class="col-xxl-4">
                            <div class="select-style-1">
                                <label for="est_recurrent">Est récurrent</label>
                                <div class="select-position">
                                    <select name="est_recurrent" id="est_recurrent" class="form-control">
                                        <option value="1" {{ $chantier->est_recurrent == 1 ? 'selected' : '' }}>Oui</option>
                                        <option value="0" {{ $chantier->est_recurrent == 0 ? 'selected' : '' }}>Non</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- est_refere -->
                        <div class="col-xxl-4">
                            <div class="select-style-1">
                                <label for="est_refere">Est référé</label>
                                <div class="select-position">
                                    <select name="est_refere" id="est_refere" class="form-control">
                                        <option value="1" {{ $chantier->est_refere == 1 ? 'selected' : '' }}>Oui</option>
                                        <option value="0" {{ $chantier->est_refere == 0 ? 'selected' : '' }}>Non</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                              <!--  -->
                              <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label for="referant">Referant</label>
                                <input type="text" name="referant" id="referant" class="form-control" value="{{ $chantier->referant }}">
                            </div>
                        </div>


                        <!-- début exercice -->
                        <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label for="debut_exercice">Début Mandat</label>
                                <input type="date" name="debut_exercice" id="debut_exercice" class="form-control" value="{{ $chantier->debut_exercice }}">
                            </div>
                        </div>

                            <!-- début exercice -->
                            <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label for="fin_exercice">Fin Mandat</label>
                                <input type="date" name="fin_exercice" id="fin_exercice" class="form-control" value="{{ $chantier->fin_exercice }}">
                            </div>
                        </div>

                           <!-- début exercice -->
                           <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label for="exercice_clos">Exercice clos</label>
                                <input type="date" name="exercice_clos" id="exercice_clos" class="form-control" value="{{ $chantier->exercice_clos }}">
                            </div>
                        </div>

                            <!--  -->
                            <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label for="bailleur">Bailleur</label>
                                <input type="text" name="bailleur" id="bailleur" class="form-control" value="{{ $chantier->bailleur }}">
                            </div>
                        </div>

                        


                        <div class="col-xxl-4">
                        <div class="select-style-1">
                            <label for="lp_contrat">Lp contrat :</label>
                            <div class="select-position">
                                <select class="light-bg" id="lp_contrat" name="lp_contrat">
                                    <option value="LP" {{ $chantier->lp_contrat == 'LP' ? 'selected' : '' }}>LP</option>
                                    <option value="Contrat" {{ $chantier->lp_contrat == 'Contrat' ? 'selected' : '' }}>Contrat</option>
                                </select>
                            </div>
                        </div>
                    </div>


                        <!-- fin exercice -->
                        <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label for="numero_lp_contrat">Numero lp contrat</label>
                                <input type="text" name="numero_lp_contrat" id="numero_lp_contrat" class="form-control" value="{{ $chantier->numero_lp_contrat }}">
                            </div>
                        </div>

                          <!--  -->
                          <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label for="date_lp_contrat">Date lp contrat</label>
                                <input type="date" name="date_lp_contrat" id="date_lp_contrat" class="form-control" value="{{ $chantier->date_lp_contrat }}">
                            </div>
                        </div>


                         

                                <!-- id_pays_intervention -->
                     <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="id_pays_intervention">Pays intervention:</label>
                        <div class="select-position">
                          <select class="light-bg" id="id_pays_intervention" name="id_pays_intervention">
                       
                            @foreach($pays as $pay)
                        
                                <option value="{{ $pay->id_pays }}" {{ $chantier->id_pays_intervention == $pay->id_pays ? 'selected' : '' }}> {{ $pay->nom_pays }}</option>
                             
                                @endforeach
                        
                          </select>
                        </div>
                      </div>
                    </div>


                         

                           <!-- monnaie -->
                           <div class="col-xxl-4">
                            <div class="select-style-1">
                                <label for="monnaie">Type de monnaie :</label>
                                <div class="select-position">
                                    <select class="light-bg" id="" name="id_monnaie">
                                        @foreach($monnaies as $type)
                                            <option value="{{ $type->id_monnaie }}" {{ $chantier->id_monnaie == $type->id_monnaie ? 'selected' : '' }}>{{ $type->nom_monnaie }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                      


                        <div class="col-xxl-4">
                        <div class="select-style-1">
                            <label for="dom_export">Domestique / Export :</label>
                            <div class="select-position">
                                <select class="light-bg" id="dom_export" name="dom_export">
                                    <option value="Domestique" {{ $chantier->dom_export == 'Domestique' ? 'selected' : '' }}>Domestique</option>
                                    <option value="Export" {{ $chantier->dom_export == 'Export' ? 'selected' : '' }}>Export</option>
                                </select>
                            </div>
                        </div>
                    </div>
                           <!--  -->
                           <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label for="origine_contrat">Origine contrat</label>
                                <input type="text" name="origine_contrat" id="origine_contrat" class="form-control" value="{{ $chantier->origine_contrat }}">
                            </div>
                        </div>

                          <!-- engagement_with_individuel -->
                          <div class="col-xxl-4">
                            <div class="select-style-1">
                                <label for="engagement_with_individuel">Engagement with individuel</label>
                                <div class="select-position">
                                    <select name="engagement_with_individuel" id="engagement_with_individuel" class="form-control">
                                        <option value="1" {{ $chantier->engagement_with_individuel == 1 ? 'selected' : '' }}>Oui</option>
                                        <option value="0" {{ $chantier->engagement_with_individuel == 0 ? 'selected' : '' }}>Non</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                            <!--  -->
                            <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label for="details_engagement_with_individuel">Details engagement WI</label>
                                <input type="text" name="details_engagement_with_individuel" id="details_engagement_with_individuel" class="form-control" value="{{ $chantier->details_engagement_with_individuel }}">
                            </div>
                        </div>

                          <!-- engagement_with_individuel -->
                          <div class="col-xxl-4">
                            <div class="select-style-1">
                                <label for="engagement_with_other_mazars_entity">Engagement With Another Mazars Entity</label>
                                <div class="select-position">
                                    <select name="engagement_with_other_mazars_entity" id="engagement_with_other_mazars_entity" class="form-control">
                                        <option value="1" {{ $chantier->engagement_with_other_mazars_entity == 1 ? 'selected' : '' }}>Oui</option>
                                        <option value="0" {{ $chantier->engagement_with_other_mazars_entity == 0 ? 'selected' : '' }}>Non</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                            <!--  -->
                            <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label for="details_engagement_with_other_mazars_entity">Detailes engagement WAME</label>
                                <input type="text" name="details_engagement_with_other_mazars_entity" id="details_engagement_with_other_mazars_entity" class="form-control" value="{{ $chantier->details_engagement_with_other_mazars_entity }}">
                            </div>
                        </div>


                              <!-- engagement_with_individuel -->
                              <div class="col-xxl-4">
                            <div class="select-style-1">
                                <label for="framework_agreement">Franework Agreement</label>
                                <div class="select-position">
                                    <select name="framework_agreement" id="framework_agreement" class="form-control">
                                        <option value="1" {{ $chantier->framework_agreement == 1 ? 'selected' : '' }}>Oui</option>
                                        <option value="0" {{ $chantier->framework_agreement == 0 ? 'selected' : '' }}>Non</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                            <!--  -->
                            <div class="col-xxl-4">
                            <div class="input-style-1">
                                <label for="details_framework_agreement">Detailes Framework Agreement</label>
                                <input type="text" name="details_framework_agreement" id="details_framework_agreement" class="form-control" value="{{ $chantier->details_framework_agreement }}">
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Charger les sous-types de mission lorsque le type de mission est sélectionné
        $('#id_type_mission').on('change', function () {
            var typeId = $(this).val();
            if (typeId) {
                $.ajax({
                    url: '/get-sous-types/' + typeId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#id_sous_type_mission').empty().prop('disabled', false);
                        $.each(data, function (key, value) {
                            $('#id_sous_type_mission').append('<option value="' + key + '">' + value + '</option>');
                        });
                        // Sélectionner le sous-type préexistant
                        $('#id_sous_type_mission').val('{{ $chantier->id_sous_type_mission }}');
                    }
                });
            } else {
                $('#id_sous_type_mission').empty().prop('disabled', true);
            }
        });

        // Initialiser les sous-types de mission au chargement de la page
        $('#id_type_mission').trigger('change');
    });
</script>