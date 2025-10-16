@extends('layouts.app')

@section('content')

<!-- ========== title-wrapper start ========== -->
<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="title">
                <h2>Modifier les tranches facture de : {{$facture->chantier->client->nom_client }} : {{ $facture->chantier->client->code_client }} - {{ $facture->chantier->sousTypeMission->types ?? '-' }}</h2>
            </div>
        </div>
    </div>
</div>
<!-- ========== title-wrapper end ========== -->

<form action="{{ route('tranche.update') }}" method="POST">
    @csrf
    @method('PUT')



    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  
    <input type="hidden" name="id_facture" value="{{ $facture->id_facture }}">
  
    @foreach($tranches as $i => $tranche)
  

    @if ($i === 0)
    <div class="row">
                        <div class="col-xxl-2">
                            <div class="select-style-1">
                                <label for="id_taux_{{ $i }}"> Taux Honoraire:</label>
                                <div class="select-position">
                                    <select style="background-color: white;" class="light-bg" id="id_taux_{{ $i }}" name="tranches[{{ $i }}][id_taux]"  >
                                        <option value="">Selectionner</option>
                                        @foreach ($tauxOptions as $taux)
                                            <option value="{{ $taux->id_taux }}" {{ old('tranches.'.$i.'.id_taux', $tranche->id_taux ?? '') == $taux->id_taux ? 'selected' : '' }}>
                                                {{ $taux->types }} ({{ $taux->pourcentage }}%)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-2">
                            <div class="select-style-1">
                                <label for="id_pourcentage_debours_{{ $i }}"> Taux Debours:</label>
                                <div class="select-position">
                                    <select style="background-color: white;" class="light-bg" id="id_pourcentage_debours_{{ $i }}" name="tranches[{{ $i }}][id_pourcentage_debours]"  >
                                        <option value="">Selectionner</option>
                                        @foreach ($tauxOptions as $taux)
                                            <option value="{{ $taux->id_taux }}" {{ old('tranches.'.$i.'.id_pourcentage_debours', $tranche->id_pourcentage_debours ?? '') == $taux->id_taux ? 'selected' : '' }}>
                                                {{ $taux->types }} ({{ $taux->pourcentage }}%)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
</div>
                    @endif


    <div class="row">
        <div class="col-lg-12">
            <div class="card-style settings-card-2 mb-30">
                <div class="row" id="tranches-container">
                    <h3>{{ $tranche->nom_tranche }}</h3>

                     <!-- Champ caché pour nom_tranche -->
            <input type="hidden" name="tranches[{{ $i }}][nom_tranche]" value="{{ $tranche->nom_tranche }}">






                    <div class="col-xxl-2">
                        <div class="input-style-1">
                            <label for="taux_honoraire_{{ $i }}">% Honoraire:</label>
                            <input type="number" id="taux_honoraire_{{ $i }}" name="tranches[{{ $i }}][taux_honoraire]" 
                            value="{{ old('tranches.'.$i.'.taux_honoraire', $tranche->taux_honoraire ?? '') }}" oninput="calculateTauxEtMontants()"
                            readonly>
                        </div>
                    </div>

                    <div class="col-xxl-2">
                        <div class="input-style-1">
                            <label for="montant_honoraire_{{ $i }}">Montant Honoraire (Ariary):</label>
                            <input type="number" id="montant_honoraire_{{ $i }}" name="tranches[{{ $i }}][montant_honoraire]" step="0.01" value="{{ old('tranches.'.$i.'.montant_honoraire', $tranche->montant_honoraire ?? '') }}"  readonly>
                        </div>
                    </div>

                    <div class="col-xxl-2">
                        <div class="input-style-1">
                            <label for="taux_debours_{{ $i }}">% Débours:</label>
                            <input type="number" id="taux_debours_{{ $i }}" name="tranches[{{ $i }}][taux_debours]" 
                            value="{{ old('tranches.'.$i.'.taux_debours', $tranche->taux_debours ?? '') }}" oninput="calculateTauxEtMontants()"
                            readonly>
                        </div>
                    </div>

                    <div class="col-xxl-2">
                        <div class="input-style-1">
                            <label for="montant_debours_{{ $i }}">Montant Débours (Ariary):</label>
                            <input type="number" id="montant_debours_{{ $i }}" name="tranches[{{ $i }}][montant_debours]" step="0.01" 
                            value="{{ old('tranches.'.$i.'.montant_debours', $tranche->montant_debours ?? '') }}"  readonly>
                        </div>
                    </div>


    

                    <div class="col-xxl-2">
                        <div class="input-style-1">
                            <label for="date_prevision_facture_{{ $i }}">Date Prévision Facture:</label>
                            <input type="date" id="date_prevision_facture_{{ $i }}" name="tranches[{{ $i }}][date_prevision_facture]" 
                            value="{{ old('tranches.'.$i.'.date_prevision_facture', $tranche->date_prevision_facture ?? '') }}"  required>
                        </div>
                    </div>

                    <div class="col-xxl-2">
                        <div class="input-style-1">
                            <label for="date_prevision_recouvrement_{{ $i }}"> Prévision Recouvrement:</label>
                            <input type="date" id="date_prevision_recouvrement_{{ $i }}" name="tranches[{{ $i }}][date_prevision_recouvrement]" 
                            value="{{ old('tranches.'.$i.'.date_prevision_recouvrement', $tranche->date_prevision_recouvrement ?? '') }}"  required>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
   
     @endforeach


    <div class="col-12">
        <button class="main-btn primary-btn btn-hover" type="submit">
            Valider
        </button>
    </div>
</form>

@endsection

<script>
function calculateTauxEtMontants() {
    const totalTranches = {{ $facture->nb_tranche_facture }};
    let totalTauxHonoraire = 0;
    let totalTauxDebours = 0;
    const totalHonoraire = @json($totalHonoraire);
    const totalDebours = @json($totalDebours);
    
    // Calcul des taux pour les tranches non finales
    for (let i = 0; i < totalTranches; i++) {
        if (i < totalTranches - 1) {
            const tauxHonoraire = parseFloat(document.getElementById(`taux_honoraire_${i}`).value) || 0;
            const tauxDebours = parseFloat(document.getElementById(`taux_debours_${i}`).value) || 0;
            totalTauxHonoraire += tauxHonoraire;
            totalTauxDebours += tauxDebours;

            // Calculer les montants pour les tranches non finales
            document.getElementById(`montant_honoraire_${i}`).value = ((totalHonoraire * tauxHonoraire) / 100).toFixed(2);
            document.getElementById(`montant_debours_${i}`).value = ((totalDebours * tauxDebours) / 100).toFixed(2);
        }
    }

    // Calcul automatique pour la dernière tranche
    const tauxHonoraireFinal = 100 - totalTauxHonoraire;
    const tauxDeboursFinal = 100 - totalTauxDebours;

    // Vérification et ajustement pour éviter les valeurs négatives
    const finalTauxHonoraire = (tauxHonoraireFinal < 0) ? 0 : tauxHonoraireFinal.toFixed(2);
    const finalTauxDebours = (tauxDeboursFinal < 0) ? 0 : tauxDeboursFinal.toFixed(2);

    document.getElementById(`taux_honoraire_${totalTranches - 1}`).value = finalTauxHonoraire;
    document.getElementById(`montant_honoraire_${totalTranches - 1}`).value = ((totalHonoraire * finalTauxHonoraire) / 100).toFixed(2);

    document.getElementById(`taux_debours_${totalTranches - 1}`).value = finalTauxDebours;
    document.getElementById(`montant_debours_${totalTranches - 1}`).value = ((totalDebours * finalTauxDebours) / 100).toFixed(2);
}

// Appel de la fonction lors du chargement de la page ou lors d'un événement spécifique
document.addEventListener('DOMContentLoaded', calculateTauxEtMontants);
</script>
