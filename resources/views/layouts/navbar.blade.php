   <!-- ========== header start ========== -->
   <header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-15">
                  <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-chevron-left me-2"></i>
                  </button>
                </div>
                 <div class="header-search d-none d-md-flex">
              
                </div>  
              </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
              <div class="header-right">


      
            
                          <!-- notification start When?Youveza22 -->
     
                          <div class="notification-box ml-15 d-none d-md-flex">
                       
                         
                         

<script>
    $(document).ready(function() {
        $.get('/notifications/check', function(data) {
          
            if (data.hasNotification) {
                $('#notificationBadge').text(data.count).show(); // Affiche le nombre de notifications
                $('#notificationIcon').addClass('has-notification'); // Ajoute une classe pour des styles supplémentaires si besoin
           
            }

              // Si des factures échues existent
              if (data.hasPassedInvoices) {
                $('#notificationBadge').addClass('badge-danger'); // Change le badge en rouge pour indiquer des factures échues
                $('#notificationIcon').addClass('has-passed-invoices'); // Classe spéciale pour les factures échues
            }
        });
    });
</script>

<a href="{{ route('notifications') }}" class="nav-link position-relative">
        <i id="notificationIcon" class="iconeu lni lni-alarm"></i> <!-- Utilise l'icône de notification -->
          </a>

  
                </div>
                <!-- notification end -->
         
             
                <!-- profile start -->
                <div class="profile-box ml-15 d-flex align-items-center">
                  <button class="dropdown-toggle bg-transparent border-0 d-flex align-items-center" type="button" id="profile"
                    data-bs-toggle="dropdown" aria-expanded="false" style="gap: 10px;">
                    <div class="profile-info">
                      <div class="info">
                        <div class="image">
                          <img src="{{ url('assets/images/profile/gf.jpg')}}" alt="" />
                        </div>
                        <div>
                        @auth

                          <p> {{ Auth::user()->nom }} </p>
                          @endauth
                          <p class="text-success"> {{Auth::user()->role }}</p>
                        </div>
                      </div>
                    </div>
                    <i class="lni lni-chevron-down" style="font-size: 18px;"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                    <li>
                      <a href="{{ route('enregistrement.create') }}" class="dropdown-item">
                        <i class="lni lni-cog"></i> Paramètres
                      </a>
                    </li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li>
                      <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="lni lni-exit"></i> Déconnexion
                      </a>
                    </li>
                  </ul>
                </div>
                <!-- profile end -->
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- ========== header end ========== -->

   
