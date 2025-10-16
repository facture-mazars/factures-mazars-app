@extends('layouts.app')
       
@section('content')

  <!-- ========== section start ========== -->
  <section class="section">
        <div class="container-fluid">

          <!-- Afficher le message de succès -->
          @if(session('success'))
          <br><br>
            <div id="success-message" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    
        
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-7">
                <div class="title">
                  <h3>Alerte sur les facture passées et les factures dans {{ $days }} jours</h3>
                </div>
              </div>

                <!-- end col -->
                <div class="col-md-5">
                <div class="breadcrumb-wrapper">
                  
                  <nav aria-label="breadcrumb">
                  <div class="searchname d-none d-md-flex">
             
                  <form method="GET" action="{{ route('notifications') }}">
                    <label for="days">Période de prévision (en jours) :</label>
                    <input style="background-color: white; " type="number" id="days" name="days" value="{{ $days }}" min="1">
                    <button type="submit"><i class="lni lni-search-alt" style="color:black; font-size: 1.4rem;"></i></button>
                </form>
                </div>

                
                  </nav>
                </div>
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->

          <div class="row">
      

          <div class="col-lg-6">
          <div class="card-style">
            <!-- notifications.blade.php -->
@if ($facturesEchues->isNotEmpty())
    @foreach ($facturesEchues as $facture)
        <div class="single-notification" style="background-color: #f0b3b3; padding: 10px; border-radius: 5px;">
            <div class="notification">
                <div class="image danger-bg">
                    <span>FE</span>
                </div>
                <a href="#0" class="content">
                    <h5>{{ $facture->facture->chantier->client->nom_client ?? '-' }} : <span class="text-medium">{{ $facture->facture->chantier->sousTypeMission->types ?? '-' }}</span></h5> <!-- Remplace par le nom du client -->
                    <br>
                    <h6>Factures à émettre : {{ $facture->nom_tranche ?? 'Tranche' }} </h6> <!-- Remplace par le nom de la tranche -->
                    <p class="text-sm text-gray">
                        Date prévision facture : {{ $facture->date_prevision_facture_formatted }}
                    </p>
                    <span class="text-sm text-medium text-danger">
                        {{ $facture->joursRestants }}
                    </span>
                </a>
            </div>

            @if (Auth::user()->role === 'Admin')
            <div class="action">
                <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="lni lni-more-alt"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                    <li class="dropdown-item">
                        <a href="{{ route('tranche.modifier', ['id_facture' => $facture->id_facture]) }}" class="text-gray">Modifier</a>
                    </li>
                </ul>
            </div>

            @endif

        </div>
    @endforeach
@endif


@foreach($facturesAEmettre as $facture)
        
            <div class="single-notification">
             
              <div class="notification">
                <div class="image warning-bg">
                  <span>FE</span>
                </div>
                <a href="#0" class="content">
                    <h5>{{ $facture->facture->chantier->client->nom_client ?? '-' }} : <span class="text-medium">{{ $facture->facture->chantier->sousTypeMission->types ?? '-' }}</span></h5>
                    <br>
                  <h6>Factures à émettre : {{ $facture->nom_tranche }} </h6>
                  <p class="text-sm text-gray">
                Date prevision facture :  {{ $facture->date_prevision_facture_formatted }}
                  </p>

                  @if ($facture->joursRestants == 0)
                  <span class="text-sm text-medium text-danger">Aujourd'hui</span>
                 @else
                  <span class="text-sm text-medium text-danger">{{ $facture->joursRestants }} jours restants</span>
                  @endif
                </a>
              </div>


              @if (Auth::user()->role === 'Admin')
              <div class="action">
             
                <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="lni lni-more-alt"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                  <li class="dropdown-item">
                    <a href="{{ route('tranche.details', ['id_tranche_facture' => $facture->id_tranche_facture]) }}" class="text-gray">Facturer</a>
                  </li>
                  <li class="dropdown-item">
                    <a href="{{ route('tranche.modifier', ['id_facture' => $facture->id_facture]) }}" class="text-gray">Modifier</a>
                  </li>
                </ul>
              </div>
              @endif


            </div>
@endforeach
           
             </div>
        
</div>


<div class="col-lg-6">
          <div class="card-style">



          @if ($recouvrementsEchus->isNotEmpty())
    @foreach ($recouvrementsEchus as $facture)
        <div class="single-notification" style="background-color: #f0b3b3; padding: 10px; border-radius: 5px;">
            <div class="notification">
                <div class="image danger-bg">
                    <span>FR</span>
                </div>
                <a href="#0" class="content">
                    <h5>{{ $facture->facture->chantier->client->nom_client ?? '-'}} : <span class="text-medium">{{ $facture->facture->chantier->sousTypeMission->types ?? '-' }}</span></h5> <!-- Remplace par le nom du client -->
                    <br>
                    <h6>Factures à recouvrer : {{ $facture->nom_tranche ?? 'Tranche' }} </h6> <!-- Remplace par le nom de la tranche -->
                    <p class="text-sm text-gray">
                        Date prévision recouvrement : {{ $facture->date_prevision_recouvrement_formatted }}
                    </p>
                    <span class="text-sm text-medium text-danger">
                        {{ $facture->joursRestants }} 
                    </span>
                </a>
            </div>

            @if (Auth::user()->role === 'Admin')
            <div class="action">
                <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="lni lni-more-alt"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                    <li class="dropdown-item">
                        <a href="{{ route('tranche.modifier', ['id_facture' => $facture->id_facture]) }}" class="text-gray">Modifier</a>
                    </li>
                </ul>
            </div>
            @endif


        </div>
    @endforeach
@endif

  
            <!-- end single notification -->
@foreach($facturesARecouvrer as $facture)
            <div class="single-notification">
             
              <div class="notification">
                <div class="image secondary-bg">
                  <span>FR</span>
                </div>
                <a href="#0" class="content">
                <h5>{{ $facture->facture->chantier->client->nom_client ?? '-' }} : <span class="text-medium">{{ $facture->facture->chantier->sousTypeMission->types ?? '-' }}</span></h5>
                <br>
                  <h6>Factures à recouvrer : {{ $facture->nom_tranche }}   </h6>
                  <p class="text-sm text-gray">
                Date prevision recouvrement :  {{ $facture->date_prevision_recouvrement_formatted }}
                  </p>
                  @if ($facture->joursRestants == 0)
                  <span class="text-sm text-medium text-danger">Aujourd'hui</span>
                 @else
                  <span class="text-sm text-medium text-danger">{{ $facture->joursRestants }} jours restants</span>
                  @endif
                </a>
              </div>

              @if (Auth::user()->role === 'Admin')
              <div class="action">
              
                <button class="more-btn dropdown-toggle" id="moreAction" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="lni lni-more-alt"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction">
                  <li class="dropdown-item">
                    <a href="{{ route('tranche.details', ['id_tranche_facture' => $facture->id_tranche_facture]) }}" class="text-gray">Facturer</a>
                  </li>
                  <li class="dropdown-item">
                    <a href="{{ route('tranche.modifier', ['id_facture' => $facture->id_facture]) }}" class="text-gray">Modifier</a>
                  </li>
                </ul>
              </div>
              @endif


            </div>
            @endforeach
            <!-- end single notification -->
             </div>
         


</div>

</div>




        </div>
        <!-- end container -->
      </section>
      <!-- ========== section end ========== -->




@endsection





