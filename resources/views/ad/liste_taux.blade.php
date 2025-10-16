@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="title-wrapper pt-30">
            <h2>Liste des Taux</h2>
        </div>
<br>
     
<div class="row">
    <div class="col-lg-6">
        <div class="card-style mb-30">
            <div class="table-wrapper table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                           
                    <th>Type</th>
                    <th>Pourcentage</th>
                    <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($taux as $t)
                    <tr>
                      
                        <td>{{ $t->types }}</td>
                        <td>{{ $t->pourcentage }}%</td>
                        <td>
                        <a href="{{ route('taux.edit', $t->id_taux) }}" class="btn btn-primary">   <i class="lni lni-pencil"></i></a>
                            <!-- Bouton pour modifier le taux -->
                    

                           
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

        
    </div>
@endsection
