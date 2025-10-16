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
                  <h2 class="mr-40">Facture de {{ $trancheFacture -> facture ->chantier->client->nom_client}} : ANNULER</h2>
               
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                  <div class="invoice-btn-section clearfix d-print-none">
                    <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme">
                    <i class="lni lni-download mr-5"></i> PDF
                    </a>
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

                    <div class="invoice-info">
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

                            <p class="text-right">Cette facture annule et remplace la facture N° {{ $trancheFacture ->numero_facture }}</p>
                          
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
                              
                                    <td class="text-center">   {{  $trancheFacture ->date_facture_annule }}</td>
                                    <td class="text-right">  {{ $trancheFacture->numero_facture_annule }}</td>
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
                                    <th class="text-center"><h5>Montant <span style="color:transparent;"> ........................................</span> </h5></th>
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
                                   

                                   
                                    <td class="text-center">{{ number_format($totalsHonoraire, 2, ',', ' ') }}  </td>
                             
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
        

          <div style="margin-top: -40px;" class="order-summary">
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
    @if($banquesEtTranches->isNotEmpty())
        @foreach($banquesEtTranches->groupBy('id_facture') as $id_facture => $details)
            <tr>
                <th colspan="5" class="text-center bg-light">
                    Facture #{{ $id_facture }}
                </th>
            </tr>
            @foreach($details as $detail)
                <tr>
                    <th class="text-center">Nom de la Banque</th>
                    <td>{{ $detail->nom_banque }}</td>
                    <th class="text-center">Type</th>
                    <td>{{ $detail->type }}</td>
                </tr>
                <tr>
                    <th class="text-center">Compte</th>
                    <td colspan="3">{{ $detail->compte }}</td>
                </tr>
              
            @endforeach
        @endforeach
    @else
        <tr>
            <th colspan="5" class="text-center">
                <h6>Aucune donnée trouvée</h6>
            </th>
        </tr>
    @endif
</tbody>

                              
                          </table>
                          <hr>
                    </div>
                  </div>
                

                </div>
               

      
          <div class="invoice-action">
                    <ul class="d-flex flex-wrap align-items-center justify-content-center">
                      <li class="m-2">
                           
                        <a href="{{ route('encaissement.create', ['id_tranche_facture' => $trancheFacture->id_tranche_facture]) }}" class="main-btn primary-btn-outline btn-hover">
                          Encaisser facture
                        </a>
                      </li>
                    
                    </ul>
                  </div>

            </div>
        </div>
    </div>
</div>
<!-- Invoice 7 end -->
        




<script>
    // Passer les variables Laravel à JavaScript
    window.nomClient = "{{ $trancheFacture->facture->chantier->client->nom_client }}";
    window.nomFacture = "{{ $trancheFacture->nom_tranche }}";
    window.mission = "{{ $trancheFacture -> facture ->chantier->objet}}";
</script>

    







        
@endsection




  
