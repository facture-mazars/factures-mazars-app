@extends('layouts.app')
       
@section('content')



          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Creer ou modifier</h2>
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
                <form action="{{ route('sous.store') }}" method="POST">
                @csrf
                  <div class="row">
                    
          
                  
                    
                     <!-- id_type_mission -->
                    <div class="col-xxl-4">
                      <div class="select-style-1">
                      <label for="id_type_mission">TypeMission :</label>
                        <div class="select-position">
                          <select class="light-bg" id="id_type_mission" name="id_type_mission" required>
                            @foreach($typess as $c)
                                <option value="{{ $c->id_type_mission }}">{{ $c->types }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>


                     <!-- code_sous_mission -->
                     <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="code_sous_mission">code_sous_mission :</label>
                      <input type="text" id="code_sous_mission" name="code_sous_mission" value="{{ old('code_sous_mission') }}" required>
                      </div>
                    </div>

                        <!-- types -->
                        <div class="col-xxl-4">
                      <div class="input-style-1">
                      <label for="types">types :</label>
                      <input type="text" id="types" name="types" value="{{ old('types') }}" required>
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

