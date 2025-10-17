@extends('layouts.app')

@section('content')

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2>Liste du Personnel</h2>
            </div>
        </div>
        <div class="col-md-6">
            <div class="breadcrumb-wrapper">
                <a href="{{ route('enregistrement.create') }}" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-plus"></i> Ajouter un personnel
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="alert alert-info" style="background: #dbeafe; color: #1e40af; border-color: #3b82f6; padding: 15px; border-radius: 8px; margin-bottom: 25px;">
            <i class="lni lni-information"></i>
            <strong>Information :</strong> Cette liste de personnel constitue l'équipe disponible lors de l'insertion d'une équipe pour un chantier.
            Assurez-vous que tous les membres sont correctement enregistrés avec leur grade.
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

