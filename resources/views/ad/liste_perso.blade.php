@extends('layouts.app')

@section('content')

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2>Liste du Personnel</h2>
            </div>
        </div>
    </div>
</div>




<div class="row">
    <div class="col-lg-12">
        <div class="card-style mb-30">
            <div class="table-wrapper table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Grade</th>
                            <th>Matricule</th>
                        
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personnels as $personnel)
                            <tr>
                                <td>{{ $personnel->nom }}</td>
                                <td>{{ $personnel->prenom }}</td>
                                <td>{{ $personnel->grade->types }}</td>
                                <td>{{ $personnel->matricule }}</td>
                           
                                <td>
                                <a href="{{ route('pers.edit', $personnel->id_liste_personnel) }}" class="btn btn-primary">   <i class="lni lni-pencil"></i></a>
                                </td>
                                <td>
                                <form action="{{ route('pers.deactivate', $personnel->id_liste_personnel) }}" method="POST"  onsubmit="return confirm('Voulez-vous vraiment supprimer ce personnel ?');">
                                        @csrf
                                        @method('PUT')
                                        <div class="action">
                                        <button type="submit" class="text-danger" style="margin-left : 22px;">
                                        <i class="lni lni-trash-can"></i>
                                        </button>
                                        </div>
                                    </form>

                              </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection

