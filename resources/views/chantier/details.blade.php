<!-- resources/views/client/listClients.blade.php -->

@extends('layouts.app') <!-- Assurez-vous d'avoir un layout de base défini -->

@section('content')
  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title d-flex align-items-center flex-wrap">
                  <h2 class="mr-40">Details {{ $clients->nom_client}} </h2>
               
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                  <button class="main-btn primary-btn btn-hover btn-sm" onClick="addPdf()" id="export">
                  <i class="lni lni-download mr-5"></i> PDF</>
                  </nav>
                </div>
              </div>
              <!-- end col -->
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
                    <h2 class="mb-10" style="text-align:center;">{{ $clients->nom_client}}</h2>
                    <h5 style="text-align:center;">{{ $chantier->objet}}</h5>
                    <p style="text-align:center;">{{ $clients->email_societe}}</p>
                 
                    </div>
                    <div class="invoice-date">
                    <p><span>Sigle:</span> {{ $clients->sigle_client}}</p>
                     <p><span>Date initialisation :</span> {{ $getDate->date_initialisation ?? '-'}}</p>
     
                    </div>
                  </div>
                 
   <!-- |   |  |   -->
                 
                  <div class="table-responsive">
                  <table class="invoice-table table">
  <thead>
    <tr>
      <td><p><span style="font-size:14px;color: black;">Reference chantier : </span> {{ $chantier->id_chantier ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Client : </span> {{ $chantier->client->nom_client ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Type de Mission : </span> {{ $chantier->typeMission->types ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Sous-type de Mission : </span> {{ $chantier->sousTypeMission->types ?? ' ' }}</p></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><p><span style="font-size:14px;color: black;">Début Exercice : </span> {{ $chantier->debut_exercice ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Fin Exercice : </span> {{ $chantier->fin_exercice ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Est Récurrent : </span> {{ $chantier->est_recurrent ? 'Oui' : 'Non' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Est Référé : </span> {{ $chantier->est_refere ? 'Oui' : 'Non' }}</p></td>
    </tr>
    <tr>
      <td><p><span style="font-size:14px;color: black;">Numéro LP Contrat : </span> {{ $chantier->numero_lp_contrat ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Date LP Contrat : </span> {{ $chantier->date_lp_contrat ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Bailleur : </span> {{ $chantier->bailleur ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">LP Contrat : </span> {{ $chantier->lp_contrat ?? ' ' }}</p></td>
    </tr>
    <tr>
      <td><p><span style="font-size:14px;color: black;">Monnaie : </span> {{ $chantier->monnaie->nom_monnaie ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Référant : </span> {{ $chantier->referant ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Origine Contrat : </span> {{ $chantier->origine_contrat ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Engagement Individuel : </span> {{ $chantier->engagement_with_individuel ?? ' ' }}</p></td>
    </tr>
    <tr>
      <td><p><span style="font-size:14px;color: black;">Détails Engagement Individuel : </span> {{ $chantier->details_engagement_with_individuel ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Engagement Autre Entité Mazars : </span> {{ $chantier->engagement_with_other_mazars_entity ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Détails Engagement Autre Entité Mazars : </span> {{ $chantier->details_engagement_with_other_mazars_entity ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Accord Cadre : </span> {{ $chantier->framework_agreement ?? ' ' }}</p></td>
    </tr>
    <tr>
      <td><p><span style="font-size:14px;color: black;">Détails Accord Cadre : </span> {{ $chantier->details_framework_agreement ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Date Clôture : </span> {{ $chantier->date_cloture ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Ancienne Mission : </span> {{ $chantier->ancien_mission ?? ' ' }}</p></td>
      <td><p><span style="font-size:14px;color: black;">Exercice Clos : </span> {{ $chantier->exercice_clos ?? ' ' }}</p></td>
    </tr>

    <tr>
   
            <td><p><span style="font-size:14px;color: black;">Date début intervention : </span> {{ $getDate->date_debut_intervention ?? ' ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Date fin intervention : </span> {{ $getDate->date_fin_intervention ?? ' ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Référence date : </span> {{ $getDate->reference_date ?? ' ' }}</p></td>
            <td><p><span style="font-size:14px;color: black;">Référence chantier : </span> {{ $getDate->reference_chantier ?? ' ' }}</p></td>
        </tr>

      
  </tbody>
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

        






        
@endsection



<script src= "{{ url('assets/js/html2pdf.bundle.min.js')}}"></script>
    <script type="text/javascript">
function addPdf(){
  var element = document.getElementById('table');
  element.style.width = '100%';  
  element.style.padding = '20px';
  element.style.fontSize = 'x-small';

  var opt = {
    filename:     'detail.pdf',
    image:        { type: 'jpeg', quality: 0.98 },
    html2canvas:  { scale: 2 },
    jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
  };

  html2pdf().from(element).set(opt).save();
}

    </script>