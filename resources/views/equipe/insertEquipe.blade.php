@extends('layouts.app')

@section('content')

      <!-- Afficher le message de succès -->
      @if(session('success'))
    
            <div id="success-message" class="alert alert-success">

                {{ session('success') }}
            </div>
        @endif


        
<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="title">
                <h2>Equipe pour {{$chantier->client->nom_client }} : {{ $chantier->client->code_client }} - {{ $chantier->sousTypeMission->types ?? '-' }}</h2>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="alert alert-info" style="background: #dbeafe; color: #1e40af; border-color: #3b82f6; padding: 15px; border-radius: 8px; margin-bottom: 25px;">
            <i class="lni lni-information"></i>
            <strong>Information :</strong> Le personnel affiché ci-dessous provient de la liste du personnel que vous avez enregistré.
            Cette liste constitue l'équipe disponible pour ce chantier. Sélectionnez les membres par grade.
        </div>
    </div>
</div>

<form action="{{ route('equipe.store') }}" method="POST">
    @csrf


    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


    <div class="row">



        <input type="hidden" name="id_chantier" value="{{ $chantier->id_chantier }}">

        @foreach($grades as $grade)
        <div class="col-xl-3 col-lg-1 col-sm-6">
            <div class="icon-card mb-30">
                <div class="icon primary">
                    <i class="lni lni-user"></i>
                </div>
                <div class="dropdown">
                    <button type="button" class="dropdown-button">{{ $grade->types }}</button>
                    <div class="dropdown-content">
                        @foreach($grade->personnel as $personnel)
                        <label>
                            <input type="checkbox" name="personnel[{{ $grade->id_grade }}][]" value="{{ $personnel->id_liste_personnel }}">
                         {{ $personnel->prenom }}
                        </label>
                        @endforeach
                    </div>
                    <div class="selected-personnel mt-2"></div> <!-- Section où les éléments sélectionnés seront affichés -->
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-12">
        <br><br><br><br><br><br><br>

        <a href="{{ route('getdate.modifier', ['id_chantier' => $chantier->id_chantier]) }}" class="main-btn primary-btn btn-hover" >Précédent</a>


            <button style="float: inline-end;" class="main-btn primary-btn btn-hover" type="submit">
                Suivant
            </button>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.dropdown-content input[type="checkbox"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var selectedContainer = this.closest('.dropdown').querySelector('.selected-personnel');
            var selected = Array.from(this.closest('.dropdown-content').querySelectorAll('input[type="checkbox"]:checked'))
                .map(function(checked) {
                    return checked.parentNode.textContent.trim();
                });

            selectedContainer.innerHTML = selected.length > 0 ? 'Sélectionné: ' + selected.join(', ') : '';
        });
    });

    document.querySelectorAll('.dropdown-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var dropdown = button.nextElementSibling;
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
    });

    document.addEventListener('click', function(event) {
        if (!event.target.matches('.dropdown-button')) {
            document.querySelectorAll('.dropdown-content').forEach(function(dropdown) {
                dropdown.style.display = 'none';
            });
        }
    });
});
</script>



@endsection


<style>

/* Conteneur pour les listes déroulantes */
.dropdown-container {
    display: flex; /* Utilise flexbox pour aligner les éléments horizontalement */
    gap: 20px; /* Espace entre les listes déroulantes */
    flex-wrap: wrap; /* Permet aux éléments de passer à la ligne suivante si nécessaire */
}

/* Style pour chaque liste déroulante */
.dropdown {
    
    position: relative;
    display: inline-block; /* Affiche les éléments côte à côte */
}

/* Style pour le bouton de la liste déroulante */
.dropdown-button {
    background-color: white;
    color: black; /* Couleur du texte */
    font-family: bold;
 
    border: none;
    padding: 10px;
    text-align: left;
    cursor: pointer;
 
    border-radius: 5px; /* Bords arrondis */
}

/* Style pour le contenu de la liste déroulante */
.dropdown-content {
    display: none;
    position: absolute;
   
    background-color: #f9f9f9;
    min-width: 400px; /* Largeur de la liste déroulante */
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    padding: 10px;
    max-height: 200px; /* Hauteur maximale de la liste déroulante */
    overflow-y: auto; /* Ajoute une barre de défilement si nécessaire */
    border-radius: 5px; /* Bords arrondis */
}

/* Style pour chaque label dans le contenu de la liste déroulante */
.dropdown-content label {
    display: block;
    margin: 5px 0;
    cursor: pointer; /* Curseur pointeur pour indiquer la sélection */
}

/* Affiche le contenu de la liste déroulante au survol */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Style pour les cases à cocher */
.dropdown-content input[type="checkbox"] {
    margin-right: 8px; /* Espace entre la case à cocher et le texte */
}

/* Style pour la scrollbar de la liste déroulante */
.dropdown-content::-webkit-scrollbar {
    width: 8px; /* Largeur de la scrollbar */
}

.dropdown-content::-webkit-scrollbar-thumb {
    background-color: #888; /* Couleur de la scrollbar */
    border-radius: 4px; /* Bords arrondis de la scrollbar */
}

.dropdown-content::-webkit-scrollbar-thumb:hover {
    background-color: #555; /* Couleur de la scrollbar au survol */
}



</style>