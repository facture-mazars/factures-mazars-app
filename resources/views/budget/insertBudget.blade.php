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
                  <h2>Budget de {{$chantiers->client->nom_client }} : {{ $chantiers->client->code_client }} - {{ $chantiers->sousTypeMission->types ?? '-' }}</h2>
                </div>
              </div>
              <!-- end col -->
              
             
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->

          @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


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
                            <h4>Nom</h4>
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
                        <!-- end table row-->
                      </thead>
                      <tbody>

                <form action="{{ route('budget.store' )}}" method="POST">
                @csrf
                <input type="hidden" name="id_chantier" value="{{ $chantiers->id_chantier }}">

              @foreach($equipes as $equipe)
              
                        <tr>
                          <td class="min-width">
                            {{ $equipe->grade->types}}
                          </td>
                          <td class="min-width">
                            <h6>{{ $equipe->listePersonnel->prenom}}</pH>
                          </td>

                          <td class="min-width">
                          <div class="col-xxl-4">
                               <div class="input-style-1">

                            
                                <input type="number" id="nb_jour_homme_{{ $equipe->id_equipe }}" name="budget[{{ $equipe->id_equipe }}][nb_jour_homme]" step="0.01" required oninput="calculateTotal( {{ $equipe->id_equipe }} )" >
                                
                              </div>
                          </div>
                          </td>

                          <td>
                              <div class="col-xxl-7">
                                <div class="input-style-1" style="display: inline-flex; align-items: center;">
                                
                                        <input type="number" id="taux_{{ $equipe->id_equipe }}" name="budget[{{ $equipe->id_equipe }}][taux]" step="0.01" required oninput="calculateTotal({{ $equipe->id_equipe }})"> 
       
                                        <span>&nbsp;&nbsp;{{ $chantiers->monnaie->nom_monnaie }}</span>
                              </div>
                              </div>   
                          </td>
                       

                          <td>
                            <div class="action">
                              <h6 class="text-danger" id="total_{{ $equipe->id_equipe }}">0</h6> <span>&nbsp;{{ $chantiers->monnaie->nom_monnaie }}</span>
                            </div>
                          </td>
                           
                        </tr>
                        <!-- end table row -->
                @endforeach

<tr>
  <td></td>

  <td><span>&nbsp;&nbsp; Total jour homme :</span></td>
<td>
    <div class="action">
       <h6 class="text-success"  id="total_jour_homme"">0</h6> <span>&nbsp;J/h</span>
    </div>
 </td>

  <td>
  <div class="action">

    <span>Taux moyen:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <h4 class="text-success" id="taux_moyen">0</h4> 
    </div>
</td>

  <td>
  <div class="action">
 <h4 class="text-success"  id="total_global"">0</h4> <span>&nbsp;{{ $chantiers->monnaie->nom_monnaie }}</span>
    </div>
  
  </td>
</tr>


<td>  
  <a href="{{ route('equipe.modifier', ['id_chantier' => $chantiers->id_chantier]) }}" class="main-btn primary-btn btn-hover" >Précédent</a>
</td>
<td></td>
<td></td>
<td></td>
                  <td>
                
                  <div class="col-12">
                 

                      <button class="main-btn primary-btn btn-hover" type="submit">
                        Suivant
                      </button>
                    </div>
                  </td>
            
                </form>
                        </tbody>
                    </table>
                
                    <!-- end table -->
                  </div>
                </div>
                <!-- end card -->
              </div>
              <!-- end col -->

         
              </div>
                <!-- end row -->
            </div>
              <!-- end card -->
                  


@endsection

<script>
    function calculateTotal(id_equipe) {
        var nbJourHomme = parseFloat(document.getElementById('nb_jour_homme_' + id_equipe).value) || 0;
        var taux = parseFloat(document.getElementById('taux_' + id_equipe).value) || 0;
        var total = nbJourHomme * taux;

        document.getElementById('total_' + id_equipe).textContent = total.toLocaleString('fr-FR', { minimumFractionDigits: 0, maximumFractionDigits: 2 });

        

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
        // Récupérer le contenu du total et le formater pour parseFloat
        var totalText = document.getElementById('total_{{ $equipe->id_equipe }}').textContent;
        
        // Remplacer les espaces et virgules pour permettre à parseFloat de fonctionner
        var totalValue = parseFloat(totalText.replace(/\s/g, '').replace(',', '.')) || 0;

        globalTotal += totalValue;
    @endforeach

    // Afficher le total global avec le format français
    document.getElementById('total_global').textContent = globalTotal.toLocaleString('fr-FR', { minimumFractionDigits: 0, maximumFractionDigits: 0 });

    return globalTotal;
}

function calculateTauxMoyen() {
        var totalJourHomme = calculateSumJourHomme(); // Obtenir la somme des jours/homme
        var globalTotal = calculateGlobalTotal(); // Obtenir le total global

        // Calculer le taux moyen si totalJourHomme n'est pas zéro
        var tauxMoyen = totalJourHomme > 0 ? globalTotal / totalJourHomme : 0;

        // Afficher le taux moyen avec 2 décimales
        document.getElementById('taux_moyen').textContent = tauxMoyen.toLocaleString('fr-FR', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
    }
  
</script>
