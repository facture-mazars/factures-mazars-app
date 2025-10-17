<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
  
    <title>Facture</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css')}}" />
    <link rel="stylesheet" id="theme-stylesheet" href="{{ asset('assets/css/main.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom-theme.css')}}" />




 

    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/select2.min.js')}}"></script>


   
 
  </head>
  <body>
        <!-- Sidebar -->
        


                  
            @if (Auth::user()->role === 'Admin')
                    @include('layouts.sidebar')
                @elseif (Auth::user()->role === 'Consultant')
                    @include('layouts.sidebarConsultant')
                @endif
        <!-- Sidebar end-->

   

    <!-- ======== main-wrapper start =========== -->
        <main class="main-wrapper">
        
            <!-- navbar -->
          

                @if (Auth::user()->role === 'Admin')
                    @include('layouts.navbar')
                @elseif (Auth::user()->role === 'Consultant')
                    @include('layouts.navbarConsultant')
                @endif


            <!-- navbar end-->

    <!-- ========== section start ========== -->
            <section class="section">

                <div class="container-fluid">

                    @yield('content')

                </div>
               <!-- end container -->
            </section>
      <!-- ========== section end ========== -->

            <!-- foot -->
       

              
                @if (Auth::user()->role === 'Admin')
                    @include('layouts.foot')
                @elseif (Auth::user()->role === 'Consultant')
                    @include('layouts.footConsultant')
                @endif


            <!-- foot end-->

        </main>
    <!-- ======== main-wrapper end =========== -->


    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/Chart.min.js')}}"></script>
    <script src="{{ asset('assets/js/dynamic-pie-chart.js')}}"></script>
    <script src="{{ asset('assets/js/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/fullcalendar.js')}}"></script>
    <script src="{{ asset('assets/js/jvectormap.min.js')}}"></script>
    <script src="{{ asset('assets/js/world-merc.js')}}"></script>
    <script src="{{ asset('assets/js/polyfill.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
    <script src="{{ asset('assets/js/no.js')}}"></script>
    <script src="{{ asset('assets/js/message.js')}}"></script>






    <style>
    .alert-success {
        padding: 15px;

        border: 1px solid transparent;
        border-radius: 4px;
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        margin-top: 20px;
    }
</style>

<!-- Script pour avertir avant de quitter le processus de création -->
<script>
    // Détecter si on est sur une page du processus de création
    const urlPath = window.location.pathname;
    const isCreationProcess = urlPath.includes('/chantier/create') ||
                             urlPath.includes('/getdate/') ||
                             urlPath.includes('/equipe/create') ||
                             urlPath.includes('/budget/create') ||
                             urlPath.includes('/facture/create') ||
                             urlPath.includes('/tranche/create') ||
                             urlPath.includes('/choix/create');

    // Si on est dans le processus, avertir avant de quitter
    if (isCreationProcess) {
        let formSubmitted = false;
        let isPrecedentClick = false;

        // Marquer quand un formulaire est soumis
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                formSubmitted = true;
            });
        });

        // Marquer quand on clique sur le bouton Précédent
        document.addEventListener('click', function(e) {
            // Vérifier si le clic est sur un lien/bouton "Précédent"
            const target = e.target.closest('a, button');
            if (target) {
                const text = target.textContent.toLowerCase();
                if (text.includes('précédent') || text.includes('precedent')) {
                    isPrecedentClick = true;
                }
            }
        });

        // Avertir avant de quitter la page
        window.addEventListener('beforeunload', function (e) {
            // Ne pas afficher l'avertissement si :
            // - le formulaire a été soumis (navigation normale)
            // - l'utilisateur a cliqué sur Précédent
            if (!formSubmitted && !isPrecedentClick) {
                e.preventDefault();
                e.returnValue = ''; // Chrome nécessite returnValue
                return 'Vous avez un processus de création en cours. Si vous quittez maintenant, vous devrez recommencer depuis le début. Êtes-vous sûr de vouloir quitter ?';
            }
        });
    }
</script>

  </body>
</html>
