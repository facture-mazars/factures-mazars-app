 <!-- ======== sidebar-nav start =========== -->
 <aside class="sidebar-nav-wrapper">
      <div class="navbar-logo">
        <a href="{{ route('dashboard') }}">
          <img src= "{{ url('assets/images/logo/mazars.png')}}" alt="logo" />
        </a>
      </div>
      <nav class="sidebar-nav">
        <ul>
          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="{{ request()->is('client*') ? '' : 'collapsed' }}"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_1"
              aria-controls="ddmenu_1"
              aria-expanded="{{ request()->is('client*') ? 'true' : 'false' }}"
              aria-label="Toggle navigation"
            >
              <span class="icon">


                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">

                <path d="M13 11A3 3 0 1 0 10 8A3 3 0 0 0 13 11M13 7A1 1 0 1 1 12 8A1 1 0 0 1 13 7M17.11 10.86A5 5 0 0 0 17.11 5.14A2.91 2.91 0 0 1 18 5A3 3 0 0 1 18 11A2.91 2.91 0 0 1 17.11 10.86M13 13C7 13 7 17 7 17V19H19V17S19 13 13 13M9 17C9 16.71 9.32 15 13 15C16.5 15 16.94 16.56 17 17M24 17V19H21V17A5.6 5.6 0 0 0 19.2 13.06C24 13.55 24 17 24 17M8 12H5V15H3V12H0V10H3V7H5V10H8Z" />

              </svg>
              </span>
              <span class="text">Client</span>
            </a>
            <ul id="ddmenu_1" class="collapse dropdown-nav {{ request()->is('client*') ? 'show' : '' }}">
              <li>
                <a href="{{ route('client.create') }}" class="{{ request()->routeIs('client.create') ? 'active' : '' }}"> Nouveau client </a>
              </li>

              <li>
                <a href="{{ route('listesClients') }}" class="{{ request()->routeIs('listesClients') ? 'active' : '' }}"> Liste client </a>
              </li>



            </ul>
          </li>
          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="{{ request()->is('chantier*') || request()->is('getdate*') || request()->is('equipe*') || request()->is('budget*') ? '' : 'collapsed' }}"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_2"
              aria-controls="ddmenu_2"
              aria-expanded="{{ request()->is('chantier*') || request()->is('getdate*') || request()->is('equipe*') || request()->is('budget*') ? 'true' : 'false' }}"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M11.8097 1.66667C11.8315 1.66667 11.8533 1.6671 11.875 1.66796V4.16667C11.875 5.43232 12.901 6.45834 14.1667 6.45834H16.6654C16.6663 6.48007 16.6667 6.50186 16.6667 6.5237V16.6667C16.6667 17.5872 15.9205 18.3333 15 18.3333H5.00001C4.07954 18.3333 3.33334 17.5872 3.33334 16.6667V3.33334C3.33334 2.41286 4.07954 1.66667 5.00001 1.66667H11.8097ZM6.66668 7.70834C6.3215 7.70834 6.04168 7.98816 6.04168 8.33334C6.04168 8.67851 6.3215 8.95834 6.66668 8.95834H10C10.3452 8.95834 10.625 8.67851 10.625 8.33334C10.625 7.98816 10.3452 7.70834 10 7.70834H6.66668ZM6.04168 11.6667C6.04168 12.0118 6.3215 12.2917 6.66668 12.2917H13.3333C13.6785 12.2917 13.9583 12.0118 13.9583 11.6667C13.9583 11.3215 13.6785 11.0417 13.3333 11.0417H6.66668C6.3215 11.0417 6.04168 11.3215 6.04168 11.6667ZM6.66668 14.375C6.3215 14.375 6.04168 14.6548 6.04168 15C6.04168 15.3452 6.3215 15.625 6.66668 15.625H13.3333C13.6785 15.625 13.9583 15.3452 13.9583 15C13.9583 14.6548 13.6785 14.375 13.3333 14.375H6.66668Z" />
                  <path
                    d="M13.125 2.29167L16.0417 5.20834H14.1667C13.5913 5.20834 13.125 4.74197 13.125 4.16667V2.29167Z" />
                </svg>
              </span>
              <span class="text">Chantier</span>
            </a>
            <ul id="ddmenu_2" class="collapse dropdown-nav {{ request()->is('chantier*') || request()->is('getdate*') || request()->is('equipe*') || request()->is('budget*') ? 'show' : '' }}">
              <li>
                <a href="{{ route('chantier.create')}}" class="{{ request()->routeIs('chantier.create') ? 'active' : '' }}"> Nouveau </a>
              </li>
              <li>
                <a href="{{ route('chantier.show')}}" class="{{ request()->routeIs('chantier.show') ? 'active' : '' }}"> Liste </a>
              </li>
            </ul>
          </li>

          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="{{ request()->is('facture*') || request()->is('tranche*') || request()->is('encaissement*') || request()->is('prevision*') ? '' : 'collapsed' }}"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_4"
              aria-controls="ddmenu_4"
              aria-expanded="{{ request()->is('facture*') || request()->is('tranche*') || request()->is('encaissement*') || request()->is('prevision*') ? 'true' : 'false' }}"
              aria-label="Toggle navigation"
            >
              <span class="icon">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M3.33334 3.35442C3.33334 2.4223 4.07954 1.66666 5.00001 1.66666H15C15.9205 1.66666 16.6667 2.4223 16.6667 3.35442V16.8565C16.6667 17.5519 15.8827 17.9489 15.3333 17.5317L13.8333 16.3924C13.537 16.1673 13.1297 16.1673 12.8333 16.3924L10.5 18.1646C10.2037 18.3896 9.79634 18.3896 9.50001 18.1646L7.16668 16.3924C6.87038 16.1673 6.46298 16.1673 6.16668 16.3924L4.66668 17.5317C4.11731 17.9489 3.33334 17.5519 3.33334 16.8565V3.35442ZM4.79168 5.04218C4.79168 5.39173 5.0715 5.6751 5.41668 5.6751H10C10.3452 5.6751 10.625 5.39173 10.625 5.04218C10.625 4.69264 10.3452 4.40927 10 4.40927H5.41668C5.0715 4.40927 4.79168 4.69264 4.79168 5.04218ZM5.41668 7.7848C5.0715 7.7848 4.79168 8.06817 4.79168 8.41774C4.79168 8.76724 5.0715 9.05066 5.41668 9.05066H10C10.3452 9.05066 10.625 8.76724 10.625 8.41774C10.625 8.06817 10.3452 7.7848 10 7.7848H5.41668ZM4.79168 11.7932C4.79168 12.1428 5.0715 12.4262 5.41668 12.4262H10C10.3452 12.4262 10.625 12.1428 10.625 11.7932C10.625 11.4437 10.3452 11.1603 10 11.1603H5.41668C5.0715 11.1603 4.79168 11.4437 4.79168 11.7932ZM13.3333 4.40927C12.9882 4.40927 12.7083 4.69264 12.7083 5.04218C12.7083 5.39173 12.9882 5.6751 13.3333 5.6751H14.5833C14.9285 5.6751 15.2083 5.39173 15.2083 5.04218C15.2083 4.69264 14.9285 4.40927 14.5833 4.40927H13.3333ZM12.7083 8.41774C12.7083 8.76724 12.9882 9.05066 13.3333 9.05066H14.5833C14.9285 9.05066 15.2083 8.76724 15.2083 8.41774C15.2083 8.06817 14.9285 7.7848 14.5833 7.7848H13.3333C12.9882 7.7848 12.7083 8.06817 12.7083 8.41774ZM13.3333 11.1603C12.9882 11.1603 12.7083 11.4437 12.7083 11.7932C12.7083 12.1428 12.9882 12.4262 13.3333 12.4262H14.5833C14.9285 12.4262 15.2083 12.1428 15.2083 11.7932C15.2083 11.4437 14.9285 11.1603 14.5833 11.1603H13.3333Z" />
                </svg>
              </span>
              <span class="text">Facture </span>
            </a>
            <ul id="ddmenu_4" class="collapse dropdown-nav {{ request()->is('facture*') || request()->is('tranche*') || request()->is('encaissement*') || request()->is('prevision*') ? 'show' : '' }}">
              <li>
                <a href="{{ route('tranchelistes') }}" class="{{ request()->routeIs('tranchelistes') ? 'active' : '' }}"> Facture à emettre </a>
              </li>
              <li>
                <a href="{{ route('tranche.emises') }}" class="{{ request()->routeIs('tranche.emises') ? 'active' : '' }}"> Facture emise </a>
              </li>
              <li>
                <a href="{{ route('listesEncaissement') }}" class="{{ request()->routeIs('listesEncaissement') ? 'active' : '' }}"> Facture recouvrer </a>
              </li>
              <li>

                <a href="{{ route('previsions') }}" class="{{ request()->routeIs('previsions') ? 'active' : '' }}"> Prevision de recouvrement </a>
              </li>



            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('liste.banque') }}">
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M1.66666 4.16667C1.66666 3.24619 2.41285 2.5 3.33332 2.5H16.6667C17.5872 2.5 18.3333 3.24619 18.3333 4.16667V9.16667C18.3333 10.0872 17.5872 10.8333 16.6667 10.8333H3.33332C2.41285 10.8333 1.66666 10.0872 1.66666 9.16667V4.16667Z" />
                  <path
                    d="M1.875 13.75C1.875 13.4048 2.15483 13.125 2.5 13.125H17.5C17.8452 13.125 18.125 13.4048 18.125 13.75C18.125 14.0952 17.8452 14.375 17.5 14.375H2.5C2.15483 14.375 1.875 14.0952 1.875 13.75Z" />
                  <path
                    d="M2.5 16.875C2.15483 16.875 1.875 17.1548 1.875 17.5C1.875 17.8452 2.15483 18.125 2.5 18.125H17.5C17.8452 18.125 18.125 17.8452 18.125 17.5C18.125 17.1548 17.8452 16.875 17.5 16.875H2.5Z" />
                </svg>
              </span>
              <span class="text">Banque</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('cheque.index') }}">
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M20 4H4C2.89 4 2.01 4.89 2.01 6L2 18C2 19.11 2.89 20 4 20H20C21.11 20 22 19.11 22 18V6C22 4.89 21.11 4 20 4M20 18H4V12H20V18M20 8H4V6H20V8M15 15H18V17H15V15M11 15H14V17H11V15Z" />
                </svg>
              </span>
              <span class="text">Chèque</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('personnel.index') }}">
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16 17V19H2V17S2 13 9 13 16 17 16 17M12.5 7.5A3.5 3.5 0 1 0 9 11A3.5 3.5 0 0 0 12.5 7.5M15.94 13A5.32 5.32 0 0 1 18 17V19H22V17S22 13.37 15.94 13M15 4A3.39 3.39 0 0 0 13.07 4.59A5 5 0 0 1 13.07 10.41A3.39 3.39 0 0 0 15 11A3.5 3.5 0 0 0 15 4Z" />
                </svg>
              </span>
              <span class="text">Personnel</span>
            </a>
          </li>

          <span class="divider"><hr /></span>



<li class="nav-item">
  <a href="{{ route('budget.jourHommeParPeriode')  }}">
    <span class="icon">


      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M12,5A3.5,3.5 0 0,0 8.5,8.5A3.5,3.5 0 0,0 12,12A3.5,3.5 0 0,0 15.5,8.5A3.5,3.5 0 0,0 12,5M12,7A1.5,1.5 0 0,1 13.5,8.5A1.5,1.5 0 0,1 12,10A1.5,1.5 0 0,1 10.5,8.5A1.5,1.5 0 0,1 12,7M5.5,8A2.5,2.5 0 0,0 3,10.5C3,11.44 3.53,12.25 4.29,12.68C4.65,12.88 5.06,13 5.5,13C5.94,13 6.35,12.88 6.71,12.68C7.08,12.47 7.39,12.17 7.62,11.81C6.89,10.86 6.5,9.7 6.5,8.5C6.5,8.41 6.5,8.31 6.5,8.22C6.2,8.08 5.86,8 5.5,8M18.5,8C18.14,8 17.8,8.08 17.5,8.22C17.5,8.31 17.5,8.41 17.5,8.5C17.5,9.7 17.11,10.86 16.38,11.81C16.5,12 16.63,12.15 16.78,12.3C16.94,12.45 17.1,12.58 17.29,12.68C17.65,12.88 18.06,13 18.5,13C18.94,13 19.35,12.88 19.71,12.68C20.47,12.25 21,11.44 21,10.5A2.5,2.5 0 0,0 18.5,8M12,14C9.66,14 5,15.17 5,17.5V19H19V17.5C19,15.17 14.34,14 12,14M4.71,14.55C2.78,14.78 0,15.76 0,17.5V19H3V17.07C3,16.06 3.69,15.22 4.71,14.55M19.29,14.55C20.31,15.22 21,16.06 21,17.07V19H24V17.5C24,15.76 21.22,14.78 19.29,14.55M12,16C13.53,16 15.24,16.5 16.23,17H7.77C8.76,16.5 10.47,16 12,16Z" /></svg>
    </span>
    <span class="text">JOUR/ HOMME</span>
  </a>
</li>




<!--
          <li class="nav-item">


            <a href="#">
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M3.33334 3.35442C3.33334 2.4223 4.07954 1.66666 5.00001 1.66666H15C15.9205 1.66666 16.6667 2.4223 16.6667 3.35442V16.8565C16.6667 17.5519 15.8827 17.9489 15.3333 17.5317L13.8333 16.3924C13.537 16.1673 13.1297 16.1673 12.8333 16.3924L10.5 18.1646C10.2037 18.3896 9.79634 18.3896 9.50001 18.1646L7.16668 16.3924C6.87038 16.1673 6.46298 16.1673 6.16668 16.3924L4.66668 17.5317C4.11731 17.9489 3.33334 17.5519 3.33334 16.8565V3.35442ZM4.79168 5.04218C4.79168 5.39173 5.0715 5.6751 5.41668 5.6751H10C10.3452 5.6751 10.625 5.39173 10.625 5.04218C10.625 4.69264 10.3452 4.40927 10 4.40927H5.41668C5.0715 4.40927 4.79168 4.69264 4.79168 5.04218ZM5.41668 7.7848C5.0715 7.7848 4.79168 8.06817 4.79168 8.41774C4.79168 8.76724 5.0715 9.05066 5.41668 9.05066H10C10.3452 9.05066 10.625 8.76724 10.625 8.41774C10.625 8.06817 10.3452 7.7848 10 7.7848H5.41668ZM4.79168 11.7932C4.79168 12.1428 5.0715 12.4262 5.41668 12.4262H10C10.3452 12.4262 10.625 12.1428 10.625 11.7932C10.625 11.4437 10.3452 11.1603 10 11.1603H5.41668C5.0715 11.1603 4.79168 11.4437 4.79168 11.7932ZM13.3333 4.40927C12.9882 4.40927 12.7083 4.69264 12.7083 5.04218C12.7083 5.39173 12.9882 5.6751 13.3333 5.6751H14.5833C14.9285 5.6751 15.2083 5.39173 15.2083 5.04218C15.2083 4.69264 14.9285 4.40927 14.5833 4.40927H13.3333ZM12.7083 8.41774C12.7083 8.76724 12.9882 9.05066 13.3333 9.05066H14.5833C14.9285 9.05066 15.2083 8.76724 15.2083 8.41774C15.2083 8.06817 14.9285 7.7848 14.5833 7.7848H13.3333C12.9882 7.7848 12.7083 8.06817 12.7083 8.41774ZM13.3333 11.1603C12.9882 11.1603 12.7083 11.4437 12.7083 11.7932C12.7083 12.1428 12.9882 12.4262 13.3333 12.4262H14.5833C14.9285 12.4262 15.2083 12.1428 15.2083 11.7932C15.2083 11.4437 14.9285 11.1603 14.5833 11.1603H13.3333Z" />
                </svg>
              </span>
              <span class="text">Cas</span>
            </a>
          </li> -->

          <span class="divider"><hr /></span>


          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="{{ request()->is('chantiers/lignemetier') || request()->is('client/zone') || request()->is('client/secteur') ? '' : 'collapsed' }}"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_55"
              aria-controls="ddmenu_55"
              aria-expanded="{{ request()->is('chantiers/lignemetier') || request()->is('client/zone') || request()->is('client/secteur') ? 'true' : 'false' }}"
              aria-label="Toggle navigation"
            >
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M9.37 4L10.78 6.5L9.37 9H6.63L5.23 6.5L6.63 4H9.37M10.25 2H5.75C5.56 2 5.39 2.11 5.31 2.26L3.09 6.22L3 6.5L3.09 6.78L5.31 10.74C5.39 10.89 5.56 11 5.75 11H10.25C10.44 11 10.61 10.89 10.69 10.74L12.91 6.78L13 6.5L12.91 6.22L10.69 2.26C10.61 2.11 10.44 2 10.25 2M18.62 9.5L20 12L18.62 14.5H15.88L14.5 12L15.88 9.5H18.62M19.5 7.5H15C14.81 7.5 14.64 7.61 14.56 7.76L12.34 11.72L12.25 12L12.34 12.28L14.56 16.24C14.64 16.39 14.81 16.5 15 16.5H19.5C19.69 16.5 19.86 16.39 19.94 16.24L22.16 12.28L22.25 12L22.16 11.72L19.94 7.76C19.86 7.61 19.69 7.5 19.5 7.5M9.37 15L10.78 17.5L9.37 20H6.63L5.23 17.5L6.63 15H9.37M10.25 13H5.75C5.56 13 5.39 13.11 5.31 13.26L3.09 17.22L3 17.5L3.09 17.78L5.31 21.74C5.39 21.89 5.56 22 5.75 22H10.25C10.44 22 10.61 21.89 10.69 21.74L12.91 17.78L13 17.5L12.91 17.22L10.69 13.26C10.61 13.11 10.44 13 10.25 13Z" />
            </svg> </span>
              <span class="text">Decomposition</span>
            </a>
            <ul id="ddmenu_55" class="collapse dropdown-nav {{ request()->is('chantiers/lignemetier') || request()->is('client/zone') || request()->is('client/secteur') ? 'show' : '' }}">
            <li>

                <a href="{{ route('chantier.ligneMetier') }}" class="{{ request()->routeIs('chantier.ligneMetier') ? 'active' : '' }}"> Ligne metier </a>
              </li>
              <li>
                <a href="{{ route('client.zone') }}" class="{{ request()->routeIs('client.zone') ? 'active' : '' }}"> Zone geographique </a>
              </li>
              <li>
                <a href="  {{ route('client.secteur') }}" class="{{ request()->routeIs('client.secteur') ? 'active' : '' }}"> Secteur d'activité </a>
              </li>
            </ul>
          </li>



          <span class="divider"><hr /></span>


          <li class="nav-item">
            <a href="{{ route('listesCloture') }}">
              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M11 15H17V17H11V15M9 7H7V9H9V7M11 13H17V11H11V13M11 9H17V7H11V9M9 11H7V13H9V11M21 5V19C21 20.1 20.1 21 19 21H5C3.9 21 3 20.1 3 19V5C3 3.9 3.9 3 5 3H19C20.1 3 21 3.9 21 5M19 5H5V19H19V5M9 15H7V17H9V15Z" /></svg>
              </span>
              <span class="text">Mission cloturé</span>
            </a>
          </li>




          <li class="nav-item">
  <a href="{{ route('barometre')  }}">
    <span class="icon">


                <svg width="20" height="20" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20M10,13H7V11H10V13M14,13H11V11H14V13M10,16H7V14H10V16M14,16H11V14H14V16M10,19H7V17H10V19M14,19H11V17H14V19Z" /></svg>
    </span>
    <span class="text">Baromètre</span>
  </a>
</li>
          <span class="divider"><hr /></span>

          <li class="nav-item nav-item-has-children">
            <a
              href="#0"
              class="{{ request()->is('importclient') || request()->is('importchantier') || request()->is('importbudgetfacture') ? '' : 'collapsed' }}"
              data-bs-toggle="collapse"
              data-bs-target="#ddmenu_5"
              aria-controls="ddmenu_5"
              aria-expanded="{{ request()->is('importclient') || request()->is('importchantier') || request()->is('importbudgetfacture') ? 'true' : 'false' }}"
              aria-label="Toggle navigation"
            >


              <span class="icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M4.16666 3.33335C4.16666 2.41288 4.91285 1.66669 5.83332 1.66669H14.1667C15.0872 1.66669 15.8333 2.41288 15.8333 3.33335V16.6667C15.8333 17.5872 15.0872 18.3334 14.1667 18.3334H5.83332C4.91285 18.3334 4.16666 17.5872 4.16666 16.6667V3.33335ZM6.04166 5.00002C6.04166 5.3452 6.32148 5.62502 6.66666 5.62502H13.3333C13.6785 5.62502 13.9583 5.3452 13.9583 5.00002C13.9583 4.65485 13.6785 4.37502 13.3333 4.37502H6.66666C6.32148 4.37502 6.04166 4.65485 6.04166 5.00002ZM6.66666 6.87502C6.32148 6.87502 6.04166 7.15485 6.04166 7.50002C6.04166 7.8452 6.32148 8.12502 6.66666 8.12502H13.3333C13.6785 8.12502 13.9583 7.8452 13.9583 7.50002C13.9583 7.15485 13.6785 6.87502 13.3333 6.87502H6.66666ZM6.04166 10C6.04166 10.3452 6.32148 10.625 6.66666 10.625H9.99999C10.3452 10.625 10.625 10.3452 10.625 10C10.625 9.65485 10.3452 9.37502 9.99999 9.37502H6.66666C6.32148 9.37502 6.04166 9.65485 6.04166 10ZM9.99999 16.6667C10.9205 16.6667 11.6667 15.9205 11.6667 15C11.6667 14.0795 10.9205 13.3334 9.99999 13.3334C9.07949 13.3334 8.33332 14.0795 8.33332 15C8.33332 15.9205 9.07949 16.6667 9.99999 16.6667Z" />
                </svg>
              </span>
              <span class="text"> Import </span>
            </a>
            <ul id="ddmenu_5" class="collapse dropdown-nav {{ request()->is('importclient') || request()->is('importchantier') || request()->is('importbudgetfacture') ? 'show' : '' }}">
              <li>
                <a href="{{ route('client.import') }}" class="{{ request()->routeIs('client.import') ? 'active' : '' }}"> Client </a>
              </li>

            </ul>
          </li>


        </ul>





      </nav>

    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->