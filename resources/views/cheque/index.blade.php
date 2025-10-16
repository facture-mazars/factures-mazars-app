@extends('layouts.app')

@section('content')

<!-- ========== title-wrapper start ========== -->
<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-12">
      <div class="title">
        <h2>Configuration Chèque</h2>
      </div>
    </div>
  </div>
  <!-- end row -->
</div>
<!-- ========== title-wrapper end ========== -->

<!-- Afficher le message de succès -->
@if(session('success'))
  <div id="success-message" class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<div class="row">
  <div class="col-lg-12">
    <div class="card-style mb-30">
      <h6 class="mb-25">Nom du chèque</h6>

      <form action="{{ route('cheque.update') }}" method="POST">
        @csrf
        <div class="row align-items-center">
          <div class="col-md-8">
            <div class="input-style-1">
              <label for="nom">Nom du chèque</label>
              <input type="text" id="nom" name="nom" class="form-control" value="{{ $cheque->nom }}" required>
            </div>
          </div>
          <div class="col-md-4">
            <button type="submit" class="main-btn primary-btn btn-hover">
              <i class="lni lni-save"></i> Mettre à jour
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
