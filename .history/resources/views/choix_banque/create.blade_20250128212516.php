@extends('layouts.app')
       
@section('content')



          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-12">
                <div class="title">
                  <h2>Choisir les banques pour votre facture
                    </h2>   
                </div>
              </div>
            
            </div>
            <!-- end row -->
          </div>
          <!-- ========== title-wrapper end ========== -->


          <div class="form-elements-wrapper">
            <div class="row">
              <div class="col-lg-6">
                <!-- input style start -->
                <div class="card-style mb-30">
                  <h6 class="mb-25">Input Fields</h6>
                  <div class="input-style-1">
                    <label>Full Name</label>
                    <input type="text" placeholder="Full Name" />
                  </div>
                  <!-- end input -->
                  <div class="input-style-2">
                    <input type="text" placeholder="Full Name" />
                    <span class="icon"> <i class="lni lni-user"></i> </span>
                  </div>
                  <!-- end input -->
                  <div class="input-style-3">
                    <input type="text" placeholder="Full Name" />
                    <span class="icon"><i class="lni lni-user"></i></span>
                  </div>
                  <!-- end input -->
                </div>
                <!-- end card -->
                <!-- ======= input style end ======= -->

                <!-- ======= select style start ======= -->
                <div class="card-style mb-30">
                  <h6 class="mb-25">Selects</h6>
                  <div class="select-style-1">
                    <label>Category</label>
                    <div class="select-position">
                      <select>
                        <option value="">Select category</option>
                        <option value="">Category one</option>
                        <option value="">Category two</option>
                        <option value="">Category three</option>
                      </select>
                    </div>
                  </div>
                  <!-- end select -->
                  <div class="select-style-2">
                    <div class="select-position">
                      <select>
                        <option value="">Select category</option>
                        <option value="">Category one</option>
                        <option value="">Category two</option>
                        <option value="">Category three</option>
                      </select>
                    </div>
                  </div>
                  <!-- end select -->
                </div>
                <!-- end card -->
                <!-- ======= select style end ======= -->

                <!-- ======= select style start ======= -->
                <div class="card-style mb-30">
                  <h6 class="mb-25">Time and Date</h6>
                  <div class="input-style-1">
                    <label>Date</label>
                    <input type="date" />
                  </div>
                  <!-- end input -->
                  <div class="input-style-2">
                    <input type="date" />
                    <span class="icon"><i class="lni lni-chevron-down"></i></span>
                  </div>
                  <!-- end input -->
                  <div class="input-style-2">
                    <input type="time" />
                  </div>
                  <!-- end input -->
                </div>
                <!-- end card -->
                <!-- ======= input style end ======= -->

                <!-- ======= input switch style start ======= -->
                <div class="card-style mb-30">
                  <h6 class="mb-25">Toggle switch input</h6>
                  <div class="form-check form-switch toggle-switch mb-30">
                    <input class="form-check-input" type="checkbox" id="toggleSwitch1" />
                    <label class="form-check-label" for="toggleSwitch1">Default switch checkbox input</label>
                  </div>
                  <div class="form-check form-switch toggle-switch">
                    <input class="form-check-input" type="checkbox" id="toggleSwitch2" checked />
                    <label class="form-check-label" for="toggleSwitch2">Default switch checkbox input</label>
                  </div>
                </div>
                <!-- ======= input switch style end ======= -->
              </div>
              <!-- end col -->
              <div class="col-lg-6">
                <!-- ======= textarea style start ======= -->
                <div class="card-style mb-30">
                  <h6 class="mb-25">Textarea</h6>
                  <div class="input-style-1">
                    <label>Message</label>
                    <textarea placeholder="Message" rows="5"></textarea>
                  </div>
                  <!-- end textarea -->
                  <div class="input-style-3">
                    <textarea placeholder="Message" rows="5"></textarea>
                    <span class="icon"><i class="lni lni-text-format"></i></span>
                  </div>
                  <!-- end textarea -->
                </div>
                <!-- ======= textarea style end ======= -->

                <!-- ======= checkbox style start ======= -->
                <div class="card-style mb-30">
                  <h6 class="mb-25">Checkbox</h6>
                  <div class="form-check checkbox-style mb-20">
                    <input class="form-check-input" type="checkbox" value="" id="checkbox-1" />
                    <label class="form-check-label" for="checkbox-1">
                      Default Checkbox</label>
                  </div>
                  <!-- end checkbox -->
                  <div class="form-check checkbox-style mb-20">
                    <input class="form-check-input" type="checkbox" value="" id="checkbox-2" disabled />
                    <label class="form-check-label" for="checkbox-2">
                      Disabled Checkbox</label>
                  </div>
                  <!-- end checkbox -->
                  <div class="form-check checkbox-style checkbox-success mb-20">
                    <input class="form-check-input" type="checkbox" value="" id="checkbox-3" />
                    <label class="form-check-label" for="checkbox-3">
                      Success Checkbox</label>
                  </div>
                  <!-- end checkbox -->
                  <div class="form-check checkbox-style checkbox-warning mb-20">
                    <input class="form-check-input" type="checkbox" value="" id="checkbox-4" />
                    <label class="form-check-label" for="checkbox-4">
                      Warning Checkbox</label>
                  </div>
                  <!-- end checkbox -->
                  <div class="form-check checkbox-style checkbox-danger mb-20">
                    <input class="form-check-input" type="checkbox" value="" id="checkbox-5" />
                    <label class="form-check-label" for="checkbox-5">
                      Danger Checkbox</label>
                  </div>
                  <!-- end checkbox -->
                </div>
                <!-- ======= checkbox style end ======= -->

                <!-- ======= radio style start ======= -->
                <div class="card-style mb-30">
                  <h6 class="mb-25">Radio</h6>
                  <div class="form-check radio-style mb-20">
                    <input class="form-check-input" type="radio" value="" id="radio-1" />
                    <label class="form-check-label" for="radio-1">
                      Default Radio</label>
                  </div>
                  <!-- end radio -->
                  <div class="form-check radio-style mb-20">
                    <input class="form-check-input" type="radio" value="" id="radio-2" disabled />
                    <label class="form-check-label" for="radio-2">
                      Disabled Radio</label>
                  </div>
                  <!-- end radio -->
                  <div class="form-check radio-style radio-success mb-20">
                    <input class="form-check-input" type="radio" value="" id="radio-3" />
                    <label class="form-check-label" for="radio-3">
                      Success Radio</label>
                  </div>
                  <!-- end radio -->
                  <div class="form-check radio-style radio-warning mb-20">
                    <input class="form-check-input" type="radio" value="" id="radio-4" />
                    <label class="form-check-label" for="radio-4">
                      Warning Radio</label>
                  </div>
                  <!-- end radio -->
                  <div class="form-check radio-style radio-danger mb-20">
                    <input class="form-check-input" type="radio" value="" id="radio-5" />
                    <label class="form-check-label" for="radio-5">
                      Danger Radio</label>
                  </div>
                  <!-- end radio -->
                </div>
                <!-- ======= radio style end ======= -->
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
          </div>

     <div class="row">
          <div class="col-lg-12">
             
        <!-- ======= checkbox style start ======= -->
        <div class="row">
  <div class="col-lg-12">
    <div class="card-style mb-30">
   


    <form action="{{ route('banques.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom_banque">Nom de la Banque</label>
            <input type="text" name="nom_banque" id="nom_banque" class="form-control">
        </div>

        <div class="form-group">
            <label for="compte">Compte</label>
            <input type="text" name="compte" id="compte" class="form-control">
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" id="type" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
    </form>

 
    </div>
    <!-- end card -->
  </div>

</div>
                <!-- ======= checkbox style end ======= -->

              <!-- end card -->
            </div>
            <!-- end col -->
        </div>
         <!-- end row -->





@endsection



