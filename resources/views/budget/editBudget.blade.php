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
                    <h2>Modifier le budget de {{ $chantier->client->nom_client }} : {{ $chantier->client->code_client }} - {{ $chantier->sousTypeMission->types ?? '-' }}</h2>
                
                  
                </div>
            </div>
        </div>
    </div>
    <!-- ========== title-wrapper end ========== -->
    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
    <!-- ========== tables-wrapper start ========== -->
    <div class="tables-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="table-wrapper table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="lead-email">
                                        <h4>Grade</h4>
                                    </th>
                                    <th class="lead-phone">
                                        <h4>Nom et prénom</h4>
                                    </th>
                                    <th class="lead-company">
                                        <h4>Nombre J/H</h4>
                                    </th>
                                    <th>
                                        <h4>Taux en Ariary</h4>
                                    </th>
                                    <th>
                                        <h4>TOTAL</h4>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                          

                                <form action="{{ route('budget.update', $chantier->id_chantier) }}" method="POST">
                                    @csrf
                                    @method('PUT') 

                                    <input type="hidden" name="id_chantier" value="{{ $chantier->id_chantier }}">

                                    @foreach($equipes as $equipe)
                                        <tr>
                                            <td class="min-width">
                                                {{ $equipe->grade->types }}
                                            </td>

                                            <td class="min-width">
                                                <h6> {{ $equipe->listePersonnel->prenom }}</h6>
                                            </td>

                                            <td class="min-width">
                                                <div class="col-xxl-4">
                                                    <div class="input-style-1">
                                                        <input type="number" id="nb_jour_homme_{{ $equipe->id_equipe }}" 
                                                               name="budget[{{ $equipe->id_equipe }}][nb_jour_homme]" 
                                                               step="0.01" required 
                                                               value="{{ $equipe->budget->firstWhere('id_equipe', $equipe->id_equipe)->nb_jour_homme ?? 0  }}" 
                                                               oninput="calculateTotal({{ $equipe->id_equipe }})">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="col-xxl-7">
                                                    <div class="input-style-1" style="display: inline-flex; align-items: center;">
                                                        <input type="number" id="taux_{{ $equipe->id_equipe }}" 
                                                               name="budget[{{ $equipe->id_equipe }}][taux]" 
                                                               step="0.01" required 
                                                               value="{{ $equipe->budget->firstWhere('id_equipe', $equipe->id_equipe)->taux ?? 0 }}" 
                                                               oninput="calculateTotal({{ $equipe->id_equipe }})">
                                                        <span>&nbsp;&nbsp;{{ $chantier->monnaie->nom_monnaie }}</span>
                                                    </div>
                                                </div>
                                            </td>


                                            <td>

                                     
                                                <div class="action">
                                                <h6 class="text-danger" id="total_{{ $equipe->id_equipe }}">
                                                {{ number_format($equipe->total, 0, ',', ' ') }}
                                                </h6>
                                                    <span>&nbsp;{{ $chantier->monnaie->nom_monnaie }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td></td>
                                        <td><span>&nbsp;&nbsp;Total jour homme :</span></td>
                                        <td>
                                            <div class="action">
                                                <h6 class="text-success" id="total_jour_homme"> {{ number_format($totalJourHomme, 2, ',', ' ') }}</h6>
                                                <span>&nbsp;J/h</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action">
                                                <span>Taux moyen:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                <h4 class="text-success" id="taux_moyen">{{ number_format($tauxMoyen, 0, ',', ' ') }}</h4>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action">
                                                <h4 class="text-success" id="total_global">{{number_format($totalHonoraire, 0, ',', ' ')}}</h4>
                                                <span>&nbsp;{{ $chantier->monnaie->nom_monnaie }}</span>
                                            </div>
                                        </td>
                                    </tr>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="col-12">
                                            <button class="main-btn primary-btn btn-hover" type="submit">Valider</button>
                                        </div>
                                    </td>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    // Fonctions de calcul similaires à l'insertion, avec des ajustements pour la modification
    function calculateTotal(id_equipe) {
        var nbJourHomme = parseFloat(document.getElementById('nb_jour_homme_' + id_equipe).value) || 0;
        var taux = parseFloat(document.getElementById('taux_' + id_equipe).value) || 0;
        var total = nbJourHomme * taux;

        document.getElementById('total_' + id_equipe).textContent = total.toLocaleString('fr-FR', { minimumFractionDigits: 0, maximumFractionDigits: 0 });

        calculateSumJourHomme();
        calculateGlobalTotal();
        calculateTauxMoyen();
    }

    function calculateSumJourHomme() {
        var totalJourHomme = 0;

        @foreach($equipes as $equipe)
            totalJourHomme += parseFloat(document.getElementById('nb_jour_homme_{{ $equipe->id_equipe }}').value) || 0;
        @endforeach

        document.getElementById('total_jour_homme').textContent = totalJourHomme.toFixed(2);

        return totalJourHomme;
    }

    function calculateGlobalTotal() {
        var globalTotal = 0;

        @foreach($equipes as $equipe)
            var totalText = document.getElementById('total_{{ $equipe->id_equipe }}').textContent;
            var totalValue = parseFloat(totalText.replace(/\s/g, '').replace(',', '.')) || 0;
            globalTotal += totalValue;
        @endforeach

        document.getElementById('total_global').textContent = globalTotal.toLocaleString('fr-FR', { minimumFractionDigits: 0, maximumFractionDigits: 2 });

        return globalTotal;
    }

    function calculateTauxMoyen() {
        var totalJourHomme = calculateSumJourHomme();
        var globalTotal = calculateGlobalTotal();
        var tauxMoyen = totalJourHomme > 0 ? globalTotal / totalJourHomme : 0;

        document.getElementById('taux_moyen').textContent = tauxMoyen.toLocaleString('fr-FR', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
    }
</script>
