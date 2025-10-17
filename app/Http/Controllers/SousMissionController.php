<?php

namespace App\Http\Controllers;

use App\Models\Encaissement;
use App\Models\SousTypeMission;
use App\Models\TypeMission;
use Illuminate\Http\Request;

class SousMissionController extends Controller
{
    /**
     * Afficher la liste des encaissements.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $typess = TypeMission::all();

        return view('mission.sous', compact('typess'));
    }

    /**
     * Afficher le formulaire de création d'un nouvel encaissement.
     *
     * @return \Illuminate\View\View
     */

    /**
     * Stocker un nouvel encaissement dans la base de données.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_type_mission' => 'required|exists:type_mission,id_type_mission',
            'code_sous_mission' => 'nullable|string|max:50',
            'types' => 'nullable|string|max:250',

        ]);

        SousTypeMission::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Encaissement ajouté avec succès.');
    }

    /**
     * Afficher les détails d'un encaissement spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
}
