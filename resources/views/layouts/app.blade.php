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

  </body>
</html>
