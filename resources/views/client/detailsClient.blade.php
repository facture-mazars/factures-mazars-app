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
                    <h5 style="text-align:center;">{{ $clients->code_client}}</h5>
                    <p style="text-align:center;">{{ $clients->email_societe}}</p>
                 
                    </div>
                    <div class="invoice-date">
                    <p><span>Sigle:</span> {{ $clients->sigle_client}}</p>
                     <p><span>Telephone société:</span> {{ $clients->telephone_societe ?? ''}}</p>
     
                    </div>
                  </div>
                 
   <!-- |   |  |   -->
                 
                  <div class="table-responsive">
                    <table class="invoice-table table">
                      <thead>
                      <td>
                            <p><span style="font-size:14px;color: black;">N° RCS : </span> {{ $clients->n_rcs ?? ' '}}</span></p>
                          </td>
                          <td class="desc">
                            <p><span style="font-size:14px;color: black;">N°STAT :</span> {{ $clients->n_stat ?? ' '}}</span></p>
                          </td>
                          <td class="qty">
                          <p><span style="font-size:14px;color: black;">N°NIF :</span> {{ $clients->n_nif ?? ' '}}</span></p>
                          </td>
                          <td class="qty">
                          <p><span style="font-size:14px;color: black;">N°CIF :</span> {{ $clients->n_cif ?? ' '}}</span></p>
                          </td>
                          <td class="amount">
                        </td>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                          <p><span style="font-size:14px;color: black;">Adresse client : </span> {{ $clients->adresse_client ?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Pays : </span> {{ $clients->pays->nom_pays ?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Ville siege : </span> {{ $clients->ville_siege ?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Zone geographique : </span> {{ $clients->zone_geographique ?? ' '}}</p>
                          </td>

                        </tr>
                        <tr>
                        <td>
                          <p><span style="font-size:14px;color: black;">Contact auprès du client: </span> {{ $clients->contact_aupres_client ?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Fonction contact :</span>  {{ $clients->fonction_contact ?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Telephone contact : </span> {{ $clients->tel_contact ?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Email contact :</span>  {{ $clients->mail_contact ?? ' '}}</p>
                          </td>
                        </tr>

                        <tr>
                        <td>
                          <p><span style="font-size:14px;color: black;">Nom groupe: </span> {{ $clients->nom_groupe ?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Pays groupe : </span> {{ $clients->pays_groupe->nom_pays ?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Secteur d'activité : </span> {{ $clients->secteurActivite->nom_secteur_activite ?? ' '}}</p>
                     
                           </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">BVDID : </span> {{ $clients->bvdid ?? ' '}}</p>
                          </td>
                        </tr>

                        <tr>
                        <td>
                          <p><span style="font-size:14px;color: black;">Restrictions:</span>  {{ $clients->restrictions ?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Forme juridique : </span> {{ $clients->formeJuridique->types ?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">DG : </span> {{ $clients->dg?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">DAF : </span> {{ $clients->daf ?? ' '}}</p>
                          </td>
                        </tr>


                        <tr>
                        <td>
                          <p><span style="font-size:14px;color: black;">Directeur juridique: </span> {{ $clients->directeur_juridique ?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">Controle interne : </span> {{ $clients->formeJuridique->controle_interne ?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">DSI : </span> {{ $clients->dsi?? ' '}}</p>
                          </td>
                          <td>
                          <p><span style="font-size:14px;color: black;">CA : </span> {{ $clients->ca ?? ' '}}</p>
                          </td>
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