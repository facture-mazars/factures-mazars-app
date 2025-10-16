<!-- resources/views/client/listClients.blade.php -->

@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')

      @if(session('success'))
      
            <div id="success-message" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <link type="text/css" rel="stylesheet" href="{{ asset('assetsfacture/css/style.css')}}">

        <script src="{{ asset('assetsfacture/js/jquery.min.js')}}"></script>
<script src="{{ asset('assetsfacture/js/jspdf.min.js')}}"></script>
<script src="{{ asset('assetsfacture/js/html2canvas.js')}}"></script>
<script src="{{ asset('assetsfacture/js/app.js')}}"></script>

  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

   

  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title d-flex align-items-center flex-wrap">
                  <h2 class="mr-40">Facture de {{ $trancheFacture -> facture ->chantier->client->nom_client}} </h2>
               
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                <nav aria-label="breadcrumb">
                
                <div class="notification-box">

                   @if (Auth::user()->role === 'Admin')
                <button class="dropdown-toggle main-btn primary-btn btn-hover btn-sm" type="button" id="notification" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                  
                   Facturer <i class="lni lni-checkmark mr-5"></i> 
                  </button>
                @endif
                  <ul style="width: 370px;" class="dropdown-menu dropdown-menu-end" aria-labelledby="notification">
               
              <div class="card-style settings-card-1 mb-30">
                
                <form action="{{ route('facturer.tranche', $trancheFacture->id_tranche_facture) }}" method="POST">
                @csrf
                  <div class="row">
                       <!-- Champ pour le numéro de facture -->
                       <div class="col-12">
                        <div class="input-style-1">
                            <label for="numero_facture">Numéro de facture</label>
                            <input type="text" id="numero_facture" name="numero_facture" value="{{ $newNumeroFacture }}" required />
                        </div>
                    </div>

                    <div class="col-12">
                      <div class="input-style-1">
                      <label for="date_reel_fac">Date réel facture</label>
                      <input type="date" name="date_reel_fac" value="{{ $trancheFacture ->date_prevision_facture }}" />
                      </div>
                    </div>
                  
                    <div class="col-6">
                      <button class="main-btn primary-btn btn-hover">
                       Valider
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- end card -->
           
                 
                  </ul>
                  </div>
                  </nav>
                 
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->


<!-- Invoice 7 start -->
<div class="invoice-7 invoice-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-inner" id="invoice_wrapper">
                    <div class="invoice-top">
                        <div class="row">
                          
                            <div class="col-sm-6">
                                <div class="invoice">
                                  
                                    @foreach ($societes as $s )
               
                
                                    <p class="invo-addr-1">
                                    {{$s->rue}} <br/>
                                    {{$s->addresse}} <br/>
                                    Madagascar<br/>
                                    Tel {{$s->telephone}} <br/>
                                    forvismazars.com <br/>

                                    @endforeach
                                  
                                    </p>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="logo text-end">
                                <img style="width: 40%; height: 40%;" src= "{{ url('assets/images/logo/mazars.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-titre">
                        <div class="row">
                          <div class="col-sm-12">
                          <div class="invoice" style="text-align:center;">
                            <h2>FACTURE</h2>
                            </div>

                                </div>
                              </div>
                            </div>

                    <div class="invoice-info" style="margin-top: -30px;">
                        <div class="row">
                            <div class="col-sm-6 mb-30">
                                <div class="invoice-number" style="border: solid 1px #eaeaea; width:375px; padding: 5px; ">
                   @foreach ($societes as $s )
                                    <h6><span> Raison sociale  &nbsp;&nbsp; : &nbsp;&nbsp; </span>{{$s->raison_sociale}}</h6>
                                    <h6><span> N° IS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp;  </span>{{$s->n_is}}</h6>
                                    <h6><span>  N° IF &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;  </span>{{$s->n_if}}</h6>
                                    <h6><span> N° CIF &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp; </span>{{$s->n_cif}}</h6>
                    @endforeach
                                  
                                </div>
                            </div>
                            <div class="col-sm-4 mb-30" style=" margin-top: 45px;">
                            <h5 class="text-bold">DOIT :</h5>
                                <div class="invoice-number" style="border: solid 1px #eaeaea; width:375px; padding: 5px; margin-top: 5px;">
                             
                         
                    
                      <h6> <span> Raison social &nbsp;:&nbsp;&nbsp; </span>{{ $trancheFacture -> facture ->chantier->client->nom_client}}</h>
                      <h6><span> N° IS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; </span>{{ $trancheFacture -> facture ->chantier->client->n_stat }}</h6>
                      <h6><span> N° IF &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; </span>{{ $trancheFacture -> facture ->chantier->client->n_nif}}</h6>
                      <h6><span> N° CIF  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp; </span>{{ $trancheFacture -> facture ->chantier->client->n_cif}}</h6>
                      <h6 class="text-bold">{{ $trancheFacture -> facture ->chantier->client->adresse_client}}</h6>
                    
                                  
                                </div>
                            </div>
                        </div>
                       
                    </div>



                    <div class="invoice-titre2">
                        <div class="row">
                          <div class="col-sm-12">
                          <div class="invoice">
                            <h4 class="text-bold">OBJET : {{ $trancheFacture -> facture ->chantier->objet ?? ''}}</h4>
                            <br>
                            </div>

                                </div>
                              </div>
                            </div>


                            <div class="invoice-datees">
                        <div class="row">
                          <div class="col-sm-12">
                          <div class="invoice">
                            <table class="table invoice-table">
                            <thead class="bg-active">
                              <tr>
                            <th class="text-center"> <h5>Date</h5></th>
                            <th class="text-right"> <h5>N° Facture</h5></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                              
                                    <td class="text-center">  {{  $trancheFacture ->date_prevision_facture}}</td>
                                    <td class="text-right">  {{ $newNumeroFacture }}</td>
                                </tr>
                          
                              
                                </tbody>
                          </table>
                          <hr>
                            </div>

                                </div>
                              </div>
                            </div>

                         



                    <div class="order-summary">
                        <div class="table-responsive">
                            <table class="table invoice-table">
                                <thead class="bg-active">
                                <tr>
                                    <th><h5>Désignation</h5></th>
                                    <th class="text-center"><h5>Totalité honoraires</h5></th>
                                    <th class="text-center"><h5>Tranche</h5></th>
                                    <th class="text-center"><h5>Montant <span style="color:transparent;">........................................</span> </h5></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                @if ($trancheFacture->montant_debours == 0)

                                    <td> 
                                          <div class="text-center">
                                          Facturation du  {{ $trancheFacture->nom_genere }} acompte {{$trancheFacture -> taux_honoraire}} % des honoraires
                                            </div>
                                      </td>
                                 @else
                                    <td> 
                                          <div class="text-center">
                                          Facturation du  {{ $trancheFacture->nom_genere }} acompte {{$trancheFacture -> taux_honoraire}} % des honoraires et {{$trancheFacture -> taux_debours}}% de debours
                                            </div>
                                      </td>
                                 @endif
                                   

                                   
                                    <td class="text-center">{{ number_format($totalsHonoraire, 0, ',', ' ') }}  </td>
                             
                                    <td class="text-center"> {{$trancheFacture -> taux_honoraire}} %</td>


                                    @if ($trancheFacture->taux && $trancheFacture->taux->types === 'IMP')
                          <td class="text-center">
                            {{ number_format($totahHonoraireAvecIMP, 2, ',', ' ') }}
                          </td>
                          @else
                          <td class="text-center">
                            {{ number_format($trancheFacture -> montant_honoraire, 2, ',', ' ') }}
                          </td>
                          
                          @endif
                                   
                                </tr>

                                <tr>
                                    @if ($trancheFacture->taux && $trancheFacture->taux->types === 'IMP')
                                    <td colspan="3" class="text-end"><h5>Total </h5></td>
                                    @else
                                    <td colspan="3" class="text-end"><h5>Total HT</h5></td>
                                    @endif

                                    <td class="text-right"><h5>{{ number_format($trancheFacture -> montant_honoraire, 2, ',', ' ') }}</h5></td>
                                </tr>

                               


                                @if ($trancheFacture->taux)   
                                  <tr>
                                 
   
                                      @if ($trancheFacture->taux->types != 'IMP')
                                  
  

                                          <td colspan="3" class="text-end"><h5>{{$trancheFacture->taux->types }} sur honoraires à {{$trancheFacture->taux->pourcentage }}%</h5></td>
                                          <td class="text-right"><h5>{{ number_format($tva, 2, ',', ' ') }}</h5></td>

                                    
                                      @endif 
                                  
                                  </tr>
                                  @endif


                           



                              

                                  @if ($trancheFacture->montant_debours != 0)
                        <tr>
                        
                          <td colspan="3" class="text-end"><h5>Total debours de {{ $trancheFacture->taux_debours}} %</h5></td>
                          <td class="text-right"><h5>{{ number_format($trancheFacture->montant_debours, 2, ',', ' ') }}</h5></td>
                        </tr>

                        @endif

                        @if ($trancheFacture->pourcentageDebours)   
                                  <tr>
                                 
   
                                      @if ($trancheFacture->pourcentageDebours->types != 'IMP')
                                                             
                                          <td colspan="3" class="text-end"><h5>{{$trancheFacture->pourcentageDebours->types }} sur debours à {{$trancheFacture->pourcentageDebours->pourcentage }}%</h5></td>
                                          <td class="text-right"><h5>{{ number_format($tva_debours, 2, ',', ' ') }}</h5></td>
                                     

                                    
                                      @endif 
                                  
                                  </tr>
                          @endif

                                  

                          @if ($trancheFacture->taux)   
<tr>
    @if ($trancheFacture->taux->types != 'IMP')
    <td colspan="3" class="text-end">
        <h5>TOTAL à payer</h5>
        <p style="color: transparent;">Total ttc</p>
    </td>
    <td class="text-right">
        <h5>{{ number_format($totalAvecTaxeDebours, 2, ',', ' ') }}</h5>
    </td>
    @else
    <td colspan="3" class="text-end">
        <h5>TOTAL à payer</h5>
        <p style="color: transparent;">Total tsotra</p>
    </td>
    <td class="text-right">
        <h5>{{ number_format($totalGlobalAvecImp, 2, ',', ' ') }}</h5>
    </td>
    @endif
</tr>
@elseif ($trancheFacture->pourcentageDebours)   
<tr>
    @if ($trancheFacture->pourcentageDebours->types != 'IMP')
    <td colspan="3" class="text-end">
        <h5>TOTAL à payer</h5>
        <p style="color: transparent;">Total ttc</p>
    </td>
    <td class="text-right">
        <h5>{{ number_format($totalAvecPourcentageTaxeDebours, 2, ',', ' ') }}</h5>
    </td>
    @else
    <td colspan="3" class="text-end">
        <h5>TOTAL à payer</h5>
        <p style="color: transparent;">Total tsotra</p>
    </td>
    <td class="text-right">
        <h5>{{ number_format($totalGlobalDeboursAvecImp, 2, ',', ' ') }}</h5>
    </td>
    @endif
</tr>
@else
<tr>
    <td colspan="3" class="text-end">
        <h5>TOTAL à payer</h5>
        <p style="color: transparent;">Total par défaut</p>
    </td>
    <td class="text-right">
        <h5>{{ number_format($totalAvecPourcentageTaxeDebours, 2, ',', ' ') }}</h5>
    </td>
</tr>
@endif


                                </tbody>
                            </table>
                            <hr>
                        </div>
                    </div>

                    
                    @if ($trancheFacture->taux)   
<div class="invoice-informeshon" style="margin-top: -80px;">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="nates mb-30">
                @if ($trancheFacture->taux->types != 'IMP')
                <p class="text-muted">
                    Arrêté la présente facture à la somme de : 
                    <span class="text-conv">
                        {{ strtoupper(app('App\Http\Controllers\ConversionController')->conversionNombreEnMots($totalAvecTaxeDebours)) }} 
                        {{ $trancheFacture->facture->chantier->monnaie->nom_monnaie }}
                    </span>
                </p>
                @else
                <p class="text-muted">
                    Arrêté la présente facture à la somme de : 
                    <span class="text-conv">
                        {{ strtoupper(app('App\Http\Controllers\ConversionController')->conversionNombreEnMots($totalGlobalAvecImp)) }} 
                        {{ $trancheFacture->facture->chantier->monnaie->nom_monnaie }}
                    </span>
                </p>
                @endif
            </div>
        </div>
    </div>
</div>
@elseif ($trancheFacture->pourcentageDebours)   
<div class="invoice-informeshon" style="margin-top: -80px;">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="nates mb-30">
                @if ($trancheFacture->pourcentageDebours->types != 'IMP')
                <div class="text-container">
                    <p class="text-muted text-wrap">
                        Arrêté la présente facture à la somme de : 
                        <span class="text-conv">
                            {{ strtoupper(app('App\Http\Controllers\ConversionController')->conversionNombreEnMots($totalAvecPourcentageTaxeDebours)) }} 
                            {{ $trancheFacture->facture->chantier->monnaie->nom_monnaie }}
                        </span>
                    </p>
                </div>
                @else
                <div class="text-container">
                    <p class="text-muted text-wrap">
                        Arrêté la présente facture à la somme de : 
                        <span class="text-conv">
                            {{ strtoupper(app('App\Http\Controllers\ConversionController')->conversionNombreEnMots($totalGlobalDeboursAvecImp)) }} 
                            {{ $trancheFacture->facture->chantier->monnaie->nom_monnaie }}
                        </span>
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@else
<div class="invoice-informeshon" style="margin-top: -80px;">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="nates mb-30">
                <div class="text-container">
                    <p class="text-muted text-wrap">
                        Arrêté la présente facture à la somme de : 
                        <span class="text-conv">
                            {{ strtoupper(app('App\Http\Controllers\ConversionController')->conversionNombreEnMots($totalAvecPourcentageTaxeDebours)) }} 
                            {{ $trancheFacture->facture->chantier->monnaie->nom_monnaie }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif



                    <div class="containerparty {{ count($equipeGrade1) === 1 ? 'single-item' : '' }}">
                    @foreach($equipeGrade1 as $equipe)

                    <div class="signature">
          <h6>Pour la société</h6>
          <p style="color:black;">{{$equipe->listePersonnel->prenom ?? 'David' }} {{$equipe->listePersonnel->nom ?? 'Rabenoro' }}</p>
          </div>
      

          @endforeach
          </div>
        

          <div style="margin-top: -40px;"  class="order-summary">
                        <div class="table-responsive">
                            <table class="table invoice-table">
                              <thead>
                                  <tr>
                                      <th style="text-align:center;">
                                          <h6>Payable par :</h6>
                                      </th>
                                      <th style="text-align:center;">
                                          <h6>Banque, ANTANANARIVO</h6>
                                      </th>
                                      <th style="text-align:center;">
                                          <h6>Compte bancaire</h6>
                                      </th>
                                      <th style="text-align:center;">
                                          <h6>Modalité de paiement</h6>
                                      </th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <!-- Pour chaque type avec compte -->
                              @if($chequesAvecCompte->isNotEmpty())
                                  <tr>
                                      <th class="text-center">
                                          Virement
                                      </th>
                                      <th class="text-center">
                                          @foreach($chequesAvecCompte as $cheque)
                                              <p>{{ $cheque->types }}</p>
                                          @endforeach
                                      </th>
                                      <th class="text-center">
                                          @foreach($chequesAvecCompte as $cheque)
                                              <p>{{ $cheque->compte }}</p>
                                          @endforeach
                                      </th>
                                      <th class="text-center">
                                          A la réception
                                      </th>
                                  </tr>

                                  <tr style="margin-top:8px;">
                                  <th class="text-center">
                                          Chèque
                                      </th>
                                      <th colspan="2" class="text-right">
                                        
                                              <p>Au nom du Cabinet Mazars Fivoarana </p>
                                              <p style="color: transparent;">Mazars</p>
                                      </th>
                                    
                                      <th>
                                        
                                      </th>
                                  </tr>
                              @else
                                  <tr>
                                      <th colspan="4" class="text-center">
                                          <h6>Aucun chèque trouvé</h6>
                                      </th>
                                  </tr>
                              @endif
                              </tbody>
                              
                          </table>
                          <hr>
                    </div>
                  </div>
                

                </div>
               
            </div>
        </div>
    </div>
</div>
<!-- Invoice 7 end -->
        





    







        
@endsection



