@extends('layouts.app')
       
@section('content')



          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-12">
                <div class="title">
                  <h2>Créer la facture à encaisser de {{ $tranche_facture->facture->chantier->client->nom_client }} : 
                  
                  @if($tranche_facture->date_facture_annule)
                  {{ $tranche_facture->numero_facture_annule }}</h2>
                  @else
                  {{ $tranche_facture->numero_facture }}</h2>
                  @endif
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
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <form action="{{ route('encaissement.store', $tranche_facture->id_tranche_facture) }}" method="POST">
                @csrf
                  <div class="row">
                    
          
                        <input type="hidden" name="id_tranche_facture" value="{{ $tranche_facture->id_tranche_facture }}">
                    

              

            <!-- datereel_encaissement -->
                    <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="datereel_encaissement">Date reel encaissement:</label>
                      <input type="date" id="datereel_encaissement" name="datereel_encaissement" value="{{ old('datereel_encaissement') }}">
                      </div>
                    </div>


                  
                    
                <!-- Sélecteur id_banque -->
<div class="col-xxl-4">
    <div class="select-style-1">
        <label for="id_banque">Virement :</label>
        <div class="select-position">
            <select class="light-bg" id="id_banque" name="id_banque">
                <option value="">Selectionner</option>
                @foreach($banques as $c)
                    <option value="{{ $c->id_banque }}">{{ $c->nom_banque }}-{{ $c->monnaie }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<!-- Sélecteur id_cheque -->
<div class="col-xxl-4">
    <div class="select-style-1">
        <label for="id_cheque"> Cheque :</label>
        <div class="select-position">
        <select class="light-bg" id="id_cheque" name="id_cheque">
                <option value="">Selectionner</option>
                @foreach($cheques as $c)
                    <option value="{{ $c->id_cheque }}">{{ $c->nom }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<hr>


<!-- Montant total à payer -->
<div class="col-xxl-4">
    <div class="input-style-1">
        <label for="total_a_payer">Total à payer:</label>
        <input id="montant_a_encaisse" name="montant_a_encaisse" style="color: green; font-family : bold; font-size : 30px;" 
               type="text" id="total_a_payer" 
               value="{{ number_format($total_a_payer, 0, ',', ' ') }}
" 
               readonly>
    </div>
</div>




      





                                       
                  <div class="col-12">
                      <button class="main-btn primary-btn btn-hover" type="submit">
                        Valider
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- end card -->
            </div>
            <!-- end col -->
        </div>
         <!-- end row -->




     



@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('#id_mode_encaissement').on('change', function () {
        var typeId = $(this).val(); // Récupère la valeur sélectionnée du mode d'encaissement
        if (typeId) {
            $.ajax({
                url: '/get-cheque-banque/' + typeId, // URL vers ton contrôleur
                type: "GET",
                dataType: "json",
                success: function (data) {
                    // Réinitialiser les options du select cheque_banque
                    $('#id_cheque_banque').empty();
                    
                    // Si des données sont reçues, les ajouter au select
                    $.each(data, function (key, value) {
                        $('#id_cheque_banque').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                error: function () {
                    alert('Erreur lors du chargement des types de chèques.');
                }
            });
        } else {
            // Si aucun mode d'encaissement n'est sélectionné, réinitialiser cheque_banque
            $('#id_cheque_banque').empty();
        }
    });
});

</script>
