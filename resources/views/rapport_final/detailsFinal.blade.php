<!-- resources/views/client/listClients.blade.php -->

@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')

<script src="{{ asset('assetsfacture/js/jquery.min.js')}}"></script>
<script src="{{ asset('assetsfacture/js/jspdf.min.js')}}"></script>
<script src="{{ asset('assetsfacture/js/html2canvas.js')}}"></script>
<script src="{{ asset('assetsfacture/js/detail.js')}}"></script>


  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-8">
                <div class="title d-flex align-items-center flex-wrap">
                  <h2 class="mr-40">Rapport final de  {{ $factures ->chantier->client->nom_client}} </h2>
              
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-4">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                  <div class="invoice-btn-section clearfix d-print-none">
                    <a id="invoice_download_table" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-download mr-5"></i> PDF
                    </a>
                </div>
                  </nav>
                </div>
              </div>
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->



             <!-- Invoice Wrapper Start -->
             <div class="invoice-wrapper" id="table">
            <div class="row">
              <div class="col-12">
                <div class="invoice-card card-style mb-30">
                  <div class="invoice-header">
                    <div>
                      
                      <img src= "{{ url('assets/images/logo/mazars.png')}}" alt="" />
                    </div>
                    <div class="invoice-for">
                    <h2 class="mb-10">{{ $factures->chantier->client->nom_client}}</h2>
                    <h5 style="text-align:center;">{{ $factures->chantier->client->code_client}}</h5>
                    <p style="text-align:center;">{{ $factures->chantier->client->email_societe}}</p>
                 
                    </div>
                    <div class="invoice-date">
                    <p><span>Sigle:</span> {{ $factures->chantier->client->sigle_client}}</p>
                    @foreach($date as $d)  
                      <p><span>Date d'initialisation:</span> {{  $d->date_initialisation ?? '- '}}</p>
                      @endforeach
                     <p><span>Telephone société:</span> {{ $factures->chantier->client->telephone_societe ?? '- '}}</p>
     
                    </div>
                  </div>
                 
   <!-- |   |  |   -->
                 
                  <div class="table-responsive">
                    <table class="invoice-table table">
                      <thead>
                       
                          <td colspan="2">
                            <p><span style="font-size:14px;color: black;">N° RCS : </span> {{ $factures->chantier->client->n_rcs ?? ' - '}}</p>
                          </td>
                          <td class="desc">
                            <p><span style="font-size:14px;color: black;">N°STAT :</span> {{ $factures->chantier->client->n_stat ?? ' - '}}</p>
                          </td>
                          <td class="qty">
                          <p><span style="font-size:14px;color: black;">N°NIF :</span> {{ $factures->chantier->client->n_nif ?? ' - '}}</p>
                          </td>
                       
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                          <p><span style="font-size:14px;color: black;">Adresse client : </span> {{ $factures->chantier->client->adresse_client ?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Pays : </span> {{ $factures->chantier->client->pays->nom_pays ?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Ville siege : </span> {{ $factures->chantier->client->ville_siege ?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Zone geographique : </span> {{ $factures->chantier->client->zone_geographique ?? ' - '}}</p>
                          </td>

                        </tr>
                        <tr>
                        <td>
                          <p><span style="font-size:14px;color: black;">Contact auprès du client: </span> {{ $factures->chantier->client->contact_aupres_client ?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Fonction contact :</span>  {{ $factures->chantier->client->fonction_contact ?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Telephone contact : </span> {{ $factures->chantier->client->tel_contact ?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Email contact :</span>  {{ $factures->chantier->client->mail_contact ?? ' - '}}</p>
                          </td>
                        </tr>

                        <tr>
                        <td>
                          <p><span style="font-size:14px;color: black;">Nom groupe: </span> {{ $factures->chantier->client->nom_groupe ?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Pays groupe : </span> {{ $factures->chantier->client->pays_groupe->nom_pays ?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Secteur d'activité : </span> {{ $clients->secteurActivite->nom_secteur_activite ?? ' - '}}</p>
                     
                           </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">BVDID : </span> {{ $factures->chantier->client->bvdid ?? ' - '}}</p>
                          </td>
                        </tr>

                        <tr>
                        <td>
                          <p><span style="font-size:14px;color: black;">Restrictions:</span>  {{ $factures->chantier->client->restrictions ?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Forme juridique : </span> {{ $factures->chantier->client->formeJuridique->types ?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">DG : </span> {{ $factures->chantier->client->dg?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">DAF : </span> {{ $factures->chantier->client->daf ?? ' - '}}</p>
                          </td>
                        </tr>


                        <tr>
                        <td>
                          <p><span style="font-size:14px;color: black;">Directeur juridique: </span> {{ $factures->chantier->client->directeur_juridique ?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Controle interne : </span> {{ $factures->chantier->client->formeJuridique->controle_interne ?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">DSI : </span> {{ $factures->chantier->client->dsi?? ' - '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">CA : </span> {{ $factures->chantier->client->ca ?? ' - '}}</p>
                          </td>
                        </tr>
                     


                        <tr>   
            <td><p><span style="font-size:14px;color: black;">Type mission : </span> {{ $factures->chantier->typeMission->types ?? ' - ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Sous type mission : </span> {{ $factures->chantier->sousTypeMission->types ?? ' - ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Debut mandat : </span> {{ $factures->chantier->debut_exercice ?? ' - ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Fin mandat : </span> {{ $factures->chantier->fin_exercice ?? ' - ' }}</p></td>
            </tr>

            <tr>
            <td><p><span style="font-size:14px;color: black;">Est recurent : </span> {{ $factures->chantier->est_recurrent ? 'Oui' : 'Non' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Est reféré: </span> {{ $factures->chantier->est_refere ? 'Oui' : 'Non' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Numero lp contrat : </span> {{ $factures->chantier->numero_lp_contrat ?? ' - ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Date lp contrat : </span> {{ $factures->chantier->date_lp_contrat ?? ' - ' }}</p></td>
            </tr>

            <tr>
            <td><p><span style="font-size:14px;color: black;">Bailleur : </span> {{ $factures->chantier->bailleur ?? ' -' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">LP contrat : </span> {{ $factures->chantier->lp_contrat ?? ' - ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Monnaie : </span> {{ $factures->chantier->monnaie->nom_monnaie ?? ' - ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Referant : </span> {{ $factures->chantier->referant ?? ' - ' }}</p></td>
            </tr>


            <tr>
            <td><p><span style="font-size:14px;color: black;">Origine contrat : </span> {{ $factures->chantier->origine_contrat ?? ' - ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Engagement with individuel : </span> {{ $factures->chantier->engagement_with_individuel ? 'Oui' : 'Non'  }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Details EWI : </span> {{ $factures->chantier->details_engagement_with_individuel ?? ' - ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Engagement with another mazars entity : </span> {{ $factures->chantier->engagement_with_other_mazars_entity ? 'Oui' : 'Non' }}</p></td>
            </tr>

            <tr>
            <td><p><span style="font-size:14px;color: black;">Details EWAME : </span> {{ $factures->chantier->details_engagement_with_other_mazars_entity ?? ' - ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Framework agreement : </span> {{ $factures->chantier->framework_agreement ? 'Oui' : 'Non' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Details framework agreement : </span> {{ $factures->chantier->details_framework_agreement ?? ' - ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Domestique/ export : </span> {{ $factures->chantier->dom_export ? 'domestique' : 'export' }}</p></td>
            </tr>

            <tr>
           
          
            <td><p><span style="font-size:14px;color: black;">Pays intervention : </span> {{ $factures->chantier->pays_intervention->nom_pays ?? ' - ' }}</p></td>
            @foreach($date as $d)  
                     
                      <td><p><span style="font-size:14px;color: black;">Debut intervention : </span>  {{  $d->date_debut_intervention ?? '- '}}</p></td>
                      <td><p><span style="font-size:14px;color: black;">Fin intervention : </span>  {{  $d->date_fin_intervention ?? '- '}}</p></td>
                      <td><p><span style="font-size:14px;color: black;">Reference chantier : </span>  {{  $d->reference_chantier ?? '- '}}</p></td>
            @endforeach
             
           
         
            </tr>



                          </th>


  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
   
                    
                      </tbody>
                    </table>
                  </div>
               




                  <div class="table-responsive">
            <table class="invoice-table table ">
                    <thead>
                        <tr>
                          <th></th>
                          @foreach($tranches as $row)
                           
                           <th>{{ $row->nom_tranche}}</th>
                 
                           @endforeach
                           <th style="text-align:end;">Total 100%</th>
                        <td></td>
                        </tr>
                    </thead>
                    <tbody>

                    <tr>
                          <th>Honoraire</th>
                          @foreach($tranches as $row)
                           
                            <td> {{ number_format($row->montant_honoraire, 0, ',', ' ') }}</td>
                  
                            @endforeach

                            <td> <h4 style="text-align:end;">{{ number_format($totalsHonoraire, 0, ',', ' ') }} </h4> </td>
                            <td></td>
                        </tr>
                     
                        <tr>
                          <th>DEBOURS</th>
                          @foreach($tranches as $row)
                           
                            <td>{{ number_format($row->montant_debours, 0, ',', ' ') }} </td>
                  
                            @endforeach
                            <td> <h4 style="text-align:end;"> {{ number_format($totalsDebours, 0, ',', ' ') }} </h4>  </td>
                            <td></td>
                          
                        </tr>
   
    
   
        <tr>
     
        @foreach($tranches as $index => $row)
     
        @if ($row->taux !== null && $row->taux->types !== null && $row->taux->types != 0 && $row->taux->pourcentage !== null && $row->taux->pourcentage != 0)
            @if($loop->first)
                <th>{{ $row->taux->types }} ({{ $row->taux->pourcentage }}%)</th>
            @endif
        @endif
        
        @endforeach
 
        @if (!empty($total_tva_honoraire) && $total_tva_honoraire[0]['tva_honoraire'] != 0)
            @foreach($total_tva_honoraire as $row)
                <td>{{ number_format($row['tva_honoraire'], 0, ',', ' ') }}</td>
            @endforeach
        @endif

            @if ($total_pourcentage_taux != null)
            <td> <h4 style="text-align:end;">{{ number_format($total_pourcentage_taux, 0, ',', ' ') }} </h4> </td>
            <td></td>
            <td></td>
            <td></td>
         
       

            @endif
            
         
        </tr>

     
        <tr>
                          <th>TOTAL</th>
                          @foreach($tranches as $row)
                           
                           <th style="color:transparent;">{{ $row->nom_tranche}}</th>
                 
                           @endforeach
                           <td> <h3 style="text-align:end;">{{ number_format($AllMontant, 0, ',', ' ') }}</h3> </td>
                           <td></td>
        </tr>    
        
    
                     
                       
                    </tbody>
                </table>
<table class="invoice-table table ">
 
<tr>
   
                           
   <td>Debours décaissable : {{ number_format($factures->debours_decaissable, 0, ',', ' ') }}</td>
   <td>Debours non décaissable : {{ number_format($factures->debours_non_decaissable, 0, ',', ' ') }}</td>
       <td>Total : <span style="font-family:bold; font-size:22px;">{{ number_format($totalsDebours, 0, ',', ' ') }}</span> </td>
        
         
   </tr> 
</table>



            </div>



<br>


               
            <div class="table-responsive">
            <table class="invoice-table table ">
                    <thead>
                        <tr>
                            <th>  Responsable</th>
                            @foreach($factures->budgets as $budget)
                            <th>{{ $budget->equipe->grade->types }}</th>
                           
                            
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>

                    <tr>
                          <td>Equipe</td>
                          @foreach($factures->budgets as $budget)
                           
                            <td>{{ $budget->equipe->listePersonnel->prenom }}</td>
                  
                            @endforeach
                        </tr>
                     
                        <tr>
                          <td>Jour/homme</td>
                          @foreach($factures->budgets as $budget)
                           
                            <td> {{ number_format($budget->nb_jour_homme, 0, ',', ' ') }}</td>
                          @endforeach
                        </tr>
                     
                        <tr>
                          <td>Taux</td>
                      
                         
                          @foreach($factures->budgets as $budget)
                           
                          <td>{{ number_format($budget->taux, 0, ',', ' ') }}</td>
                        
                          
                           @endforeach
                        </tr>
                    </tbody>
                </table>

               <table class="invoice-table table ">
 
      <tr>
     
                           
      
                         
                           
    
      @foreach($totalBudgets as $budget)        
        <td>TOTAL JOUR/ HOMME : {{ number_format($budget->total_jour_homme, 0, ',', ' ') }}</td>
        <td>TAUX MOYEN : {{ number_format($budget->taux_moyen, 0, ',', ' ') }}</td>
        @endforeach

            <td>TOTAL : <span style="font-family:bold; font-size:22px;">{{ number_format($totalsHonoraire, 0, ',', ' ') }}</span> </td>
              
              
        </tr> 
      </table>

            </div>
         


               
                </div>
                <!-- End Card -->
              </div>
              <!-- ENd Col -->
            </div>
            <!-- End Row -->
          </div>

          <!-- Invoice Wrapper End -->
    
     



          <script>
    // Passer les variables Laravel à JavaScript
    window.nomClient = "{{ $factures ->chantier->client->nom_client}}";
    window.mission = "{{ $factures->chantier->typeMission->types}}";
</script>




        
@endsection

