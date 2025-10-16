@extends('layouts.app')
       
@section('content')



          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Créer la facture à encaisser</h2>
                </div>
              </div>
            
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->

     <div class="row">
          <div class="col-lg-12">
              <div class="card-style settings-card-2 mb-30">
                

                @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <form action="{{ route('mission.store'}}" method="POST">
                @csrf
                  <div class="row">
                    
                  <div class="col-xxl-4">
                      <div class="input-style-1">
                        <label for="id_tranche_facture">tranche facture</label>
                        <input type="text" name="id_tranche_facture_display" value="{{ $tranche_facture->lib_facture }}" class="form-control" disabled>
                        <input type="hidden" name="id_tranche_facture" value="{{ $tranche_facture->id_tranche_facture }}">
                      </div>
                  </div>

     
                  
                  <!--dateprobable_encaissement  -->
                  <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="dateprobable_encaissement">Date probable encaissement:</label>
                      <input type="date" id="dateprobable_encaissement" name="dateprobable_encaissement" value="{{ old('dateprobable_encaissement') }}" required>
                      </div>
                    </div>

            <!-- datereel_encaissement -->
                    <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="datereel_encaissement">Date reel encaissement:</label>
                      <input type="date" id="datereel_encaissement" name="datereel_encaissement" value="{{ old('datereel_encaissement') }}" required>
                      </div>
                    </div>

                  
                    
                     <!-- id_mode_encaissement -->
                    <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="id_mode_encaissement">Mode encaissement :</label>
                        <div class="select-position">
                          <select class="light-bg" id="id_mode_encaissement" name="id_mode_encaissement" required>
                            @foreach($modeEncaissements as $c)
                                <option value="{{ $c->id_mode_encaissement }}">{{ $c->types }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>


                     <!-- banque -->
                     <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="banque">Banque :</label>
                      <input type="text" id="banque" name="banque" value="{{ old('banque') }}" required>
                      </div>
                    </div>

  <!-- date_encaissement_prevu_calcule -->
  <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="date_encaissement_prevu_calcule">Date prevu calcule encaissement:</label>
                      <input type="date" id="date_encaissement_prevu_calcule" name="date_encaissement_prevu_calcule" value="{{ old('date_encaissement_prevu_calcule') }}" required>
                      </div>
                    </div>

    
                     <!-- ref_encaissement -->
                     <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="ref_encaissement">reference encaissement :</label>
                      <input type="text" id="ref_encaissement" name="ref_encaissement" value="{{ old('ref_encaissement') }}" required>
                      </div>
                    </div>
                  
                  <div class="col-12">
                      <button class="main-btn primary-btn btn-hover" type="submit">
                        Valider
                      </button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- end card -->
            </div>
            <!-- end col -->
        </div>
         <!-- end row -->




   
  




@endsection

