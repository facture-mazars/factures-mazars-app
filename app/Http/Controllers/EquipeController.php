<?php
namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Equipe;
use App\Models\Chantier;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    public function create($id_chantier)
    {
        $grades = Grade::with(['personnel' => function ($query) {
            $query->where('actif', true);
        }])->get();

        $chantier = Chantier::findOrFail($id_chantier); // Récupérez le chantier pour confirmation ou affichage

        return view('equipe.insertEquipe', compact('grades', 'chantier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_chantier' => 'required|exists:chantier,id_chantier',
            'personnel' => 'required|array',
            'personnel.*' => 'array',
            'personnel.*.*' => 'exists:liste_personnel,id_liste_personnel',
        ]);

           // Vérifier si le nombre de personnes sélectionnées pour id_grade = 1 dépasse 2
    if (isset($request->personnel[1]) && count($request->personnel[1]) > 2) {
        return redirect()->back()->with('error', 'Le nombre de personnes sélectionnées pour le partner 1 ne peut pas dépasser 2.');
    }

        foreach ($request->personnel as $id_grade => $ids_personnel) {
            
            foreach ($ids_personnel as $id_liste_personnel) {
                Equipe::create([
                    'id_chantier' => $request->id_chantier,
                    'id_grade' => $id_grade,
                    'id_liste_personnel' => $id_liste_personnel,
                ]);
            }
        }

        // Mettre à jour l'étape du chantier
        $chantier = \App\Models\Chantier::find($request->id_chantier);
        if ($chantier) {
            $chantier->updateEtape('budget');
        }

        return redirect()->route('budget.create', ['id_chantier' => $request->id_chantier])->with('success', 'Équipe créée avec succès.');
    }


    public function edit($id_chantier)
    {
        // Récupérer le chantier en fonction de l'ID
        $chantier = Chantier::with('client')->findOrFail($id_chantier);
    
        $grades = Grade::with(['personnel' => function ($query) {
            $query->where('actif', true);
        }])->get();
    
        // Récupérer l'équipe actuelle pour le chantier en question
        $equipe = Equipe::where('id_chantier', $id_chantier)->get()->groupBy('id_grade');
    
        return view('equipe.edit', compact('chantier', 'grades', 'equipe'));
    }


    public function update(Request $request, $id_chantier)
{
    $request->validate([
        'id_chantier' => 'required|exists:chantier,id_chantier',
        'personnel' => 'required|array',
        'personnel.*' => 'array',
        'personnel.*.*' => 'exists:liste_personnel,id_liste_personnel',
    ]);

        // Vérifier si le nombre de personnes sélectionnées pour id_grade = 1 dépasse 2
        if (isset($request->personnel[1]) && count($request->personnel[1]) > 2) {
            // Ajouter un message d'erreur dans la session et rediriger
            return redirect()->back()->with('error', 'Le nombre de personnes sélectionnées pour le partner 1 ne peut pas dépasser 2.');
        }

    // Supprimer les anciennes entrées de l'équipe pour ce chantier
    Equipe::where('id_chantier', $id_chantier)->delete();

           

    // Ajouter les nouvelles entrées de l'équipe
    foreach ($request->personnel as $id_grade => $ids_personnel) {
        foreach ($ids_personnel as $id_liste_personnel) {
            Equipe::create([
                'id_chantier' => $request->id_chantier,
                'id_grade' => $id_grade,
                'id_liste_personnel' => $id_liste_personnel,
            ]);
        }
    }

    return redirect()->route('budget.create', ['id_chantier' => $id_chantier])->with('success', 'Équipe mise à jour avec succès.');
}

    
}
