
<!-- resources/views/check_encaissement.blade.php -->
@extends('layouts.app')

@section('content')
<!-- ========== title-wrapper start ========== -->
<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2>Vérification des Encaissements</h2>
            </div>
        </div>
    </div>
</div>
<!-- ========== title-wrapper end ========== -->

<div class="container">
<table>
    <thead>
        <tr>
            <th>ID facture</th>
            <th>Total tranche</th>
            <th>Tranche valider</th>
         
        </tr>
    </thead>
    <tbody>
        @foreach($verifier as $row)
            <tr>
                <td>{{ $row->id_facture }}</td>
                <td>{{ $row->total_tranches }}</td>
                <td>{{ $row->tranches_valides }}</td>
             
            </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
