<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ChantierController;
use App\Http\Controllers\ChoixBanqueController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EncaissementController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\GetDateController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\SousMissionController;
use App\Http\Controllers\TrancheFactureController;
use App\Http\Controllers\SocieteChequePersonnelTauxController;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 







Route::get('/', function () {
    return view('auth/login');
 
});

Route::controller(AuthController::class)->group(
    function () {
        Route::get('register', 'register')->name('register');
        Route::post('register', 'registerSave')->name('register.save');

        Route::get('login', 'login')->name('login');
        Route::post('login', 'loginAction')->name('login.action');

        Route::get('logout', 'logout')->middleware('auth')->name('logout');
    }
);

Route::middleware('auth')->group(function () {


    Route::get('dashboard', [DashboardController::class, 'chartSuivi'])->name('dashboard');




    Route::get('client/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('client', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client', [ClientController::class, 'show'])->name('listesClients'); 
    Route::get('/clients/generate-code', [ClientController::class, 'generateCode']);
    Route::get('/clients/search', [ClientController::class, 'rechercheNomClient'])->name('clients.search');
    Route::get('/clients/details/{id_client}', [ClientController::class, 'index'])->name('detailsClients');
    Route::get('client/modifier/{id_client}', [ClientController::class, 'edit'])->name('client.modifier');
    Route::put('/client/update/{id_client}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/client/{id_client}', [ClientController::class, 'destroy'])->name('client.destroy');
    Route::get('/client/secteur', [ClientController::class, 'afficherClientsParSecteur'])->name('client.secteur');
    Route::get('/client/zone', [ClientController::class, 'afficherClientsParZoneGeographique'])->name('client.zone');





    Route::get('chantier/create', [ChantierController::class, 'create'])->name('chantier.create');
    Route::post('chantier/store', [ChantierController::class, 'store'])->name('chantier.store');
    Route::get('get-sous-types/{id_type_mission}', [ChantierController::class, 'getSousTypes']);
    Route::get('/chantier', [ChantierController::class, 'show'])->name('chantier.show');
    Route::get('chantier/modifier/{id_chantier}', [ChantierController::class, 'edit'])->name('chantier.modifier');
    Route::put('/chantier/update/{id_chantier}', [ChantierController::class, 'update'])->name('chantier.update');
    Route::get('/chantiers/chart', [ChantierController::class, 'chartSuivi'])->name('test');
    Route::get('/chantiers/lignemetier', [ChantierController::class, 'afficherClientsParLigneMetier'])->name('chantier.ligneMetier');
    Route::get('/chantiers/details/{id_chantier}', [ChantierController::class, 'index'])->name('detailsChantiers');

    Route::get('chantier/modifier2/{id_chantier}', [ChantierController::class, 'edit2'])->name('chantier.modifier2');
    Route::put('/chantier/update2/{id_chantier}', [ChantierController::class, 'update2'])->name('chantier.update2');
    Route::delete('/chantier/{id_chantier}', [ChantierController::class, 'destroy'])->name('chantier.destroy');


    Route::get('/getdate/create/{id_chantier}', [GetDateController::class, 'index'])->name('getdate.create');
    Route::post('getdate/store', [GetDateController::class, 'store'])->name('getdate.store');
    Route::get('getdate/modifier/{id_chantier}', [GetDateController::class, 'edit'])->name('getdate.modifier');
    Route::put('/getdate/update/{id_chantier}', [GetDateController::class, 'update'])->name('getdate.update');

    Route::get('equipe/create/{id_chantier}', [EquipeController::class, 'create'])->name('equipe.create');
    Route::post('equipe/store', [EquipeController::class, 'store'])->name('equipe.store');
    Route::get('equipe/modifier/{id_chantier}', [EquipeController::class, 'edit'])->name('equipe.modifier');
    Route::put('/equipe/update/{id_chantier}', [EquipeController::class, 'update'])->name('equipe.update');
    

    Route::get('budget/create/{id_chantier}', [BudgetController::class, 'create'])->name('budget.create');
    Route::post('budget/store', [BudgetController::class, 'store'])->name('budget.store');
    Route::post('/budget/storetotal', [BudgetController::class, 'storeTotalBudget'])->name('budget.storetotal');
    Route::get('budget/modifier/{id_chantier}', [BudgetController::class, 'edit'])->name('budget.modifier');
    Route::put('/budget/update/{id_chantier}', [BudgetController::class, 'update'])->name('budget.update');
    Route::get('/budget/jour-homme', [BudgetController::class, 'calculeJourHommeParPeriode'])->name('budget.jourHommeParPeriode');


    Route::get('facture/create/{id_chantier}', [FactureController::class, 'create'])->name('facture.create');
    Route::post('facture/store', [FactureController::class, 'store'])->name('facture.store');
    Route::get('facture/modifier/{id_facture}', [FactureController::class, 'edit'])->name('facture.modifier');
    Route::put('/facture/update/{id_facture}', [FactureController::class, 'update'])->name('facture.update');


    Route::get('tranche/create/{id_facture}', [TrancheFactureController::class, 'create'])->name('tranche.create');
    Route::post('tranche/store', [TrancheFactureController::class, 'store'])->name('tranche.store');
    // Route pour afficher toutes les tranches
    Route::get('/tranche/show', [TrancheFactureController::class, 'showSansFiltre'])->name('tranchelistes');
    // Route pour afficher la liste des tranches avec une méthode POST
    Route::post('/tranche/liste', [TrancheFactureController::class, 'show'])->name('tranche.show');

    Route::get('/tranche/liste_emise', [TrancheFactureController::class, 'liste_facture_emise'])->name('tranche.emises');

    Route::get('tranche/voir/{id_tranche_facture}', [TrancheFactureController::class, 'voirFacture'])->name('tranche.voir');
    Route::get('tranche/details/{id_tranche_facture}', [TrancheFactureController::class, 'index'])->name('tranche.details');
    Route::get('tranche/detailsansEncaiss/{id_tranche_facture}', [TrancheFactureController::class, 'indexSansEncaissement'])->name('tranche.detailsansEncaiss');
    Route::get('tranche/modifier/{id_facture}', [TrancheFactureController::class, 'edit'])->name('tranche.modifier');
    Route::put('/tranche/update/', [TrancheFactureController::class, 'update'])->name('tranche.update');

    Route::get('tranche/detailsAAnnuler/{id_tranche_facture}', [TrancheFactureController::class, 'factureAnnuler'])->name('tranche.detailsAnnuler');
Route::post('/facturer-tranche-annuler/{id_tranche_facture}', [TrancheFactureController::class, 'facturerTrancheAnnuler'])->name('facturer.trancheAnnuler');
 

Route::get('tranche/detailsansEncaissAnnuler/{id_tranche_facture}', [TrancheFactureController::class, 'indexSansEncaissementAnnuler'])->name('tranche.detailsansEncaissAnnuler');
       // Route pour afficher toutes les tranches
Route::get('/tranche/prevision/show', [TrancheFactureController::class, 'showPrevisionSansFiltre'])->name('previsions');
// Route pour afficher la liste des tranches avec une méthode POST
Route::post('/tranche/prevision/liste', [TrancheFactureController::class, 'showPrevision'])->name('previsions.show');

Route::post('/facturer-tranche/{id_tranche_facture}', [TrancheFactureController::class, 'facturerTranche'])->name('facturer.tranche');



    // Route pour vérifier les notifications dans le navbar
    Route::get('/notifications/check', [TrancheFactureController::class, 'checkNotifications']);
    // Route pour afficher la page des notifications avec possibilité de modifier la période
    Route::get('/notifications', [TrancheFactureController::class, 'showNotifications'])->name('notifications');

    Route::post('valider-facture/{id_tranche_facture}', [TrancheFactureController::class, 'validerFacture'])->name('valider.facture');




       // Route pour afficher toutes les tranches
       Route::get('/cloture/show', [RapportController::class, 'getEncaissements100'])->name('listesCloture');
       // Route pour afficher la liste des tranches avec une méthode POST
       Route::post('/cloture/liste', [RapportController::class, 'getEncaissements100AvecRecherche'])->name('listesCloture.show');
       

    Route::get('/verif', [RapportController::class, 'getVerification'])->name('verification');
    Route::get('rapport/details/{id_facture}', [RapportController::class, 'show'])->name('rapport.final');
    Route::get('rapport/barometre', [RapportController::class, 'barometre'])->name('barometre');
    Route::get('/barometre-filtre', [RapportController::class, 'barometreFiltre'])->name('barometre.filtre');


    Route::get('encaissement/insert', [EncaissementController::class, 'index'])->name('encaissement.index');
    Route::get('/encaissement/create/{id_tranche_facture}', [EncaissementController::class, 'create'])->name('encaissement.create');
    Route::post('encaissement/store/{id_tranche_facture}', [EncaissementController::class, 'store'])->name('encaissement.store');

    Route::get('get-cheque-banque/{id_mode_encaissement}', [EncaissementController::class, 'getChequeBanque']);

        // Route pour afficher toutes les tranches
Route::get('/encaissement/show', [EncaissementController::class, 'showSansFiltre'])->name('listesEncaissement');
// Route pour afficher la liste des tranches avec une méthode POST
Route::post('/encaissement/liste', [EncaissementController::class, 'show'])->name('encaissement.show');


    Route::get('/mission/create/', [MissionController::class, 'index'])->name('mission.create');
    Route::post('mission/store/', [MissionController::class, 'store'])->name('mission.store');


    Route::get('/sous/create', [SousMissionController::class, 'index'])->name('sous.create');
    Route::post('sous/store', [SousMissionController::class, 'store'])->name('sous.store');



    Route::get('/importclient', [ClientController::class, 'createImport'])->name('client.import');
    Route::post('import/clients', [ClientController::class, 'importExcel'])->name('importClients');

    Route::get('/importchantier', [ChantierController::class, 'showInsertForm'])->name('chantier.import');
    Route::post('import/chantiers', [ChantierController::class, 'importExcelChantier'])->name('importChantiers');

    Route::get('/importbudgetfacture', [ImportController::class, 'showInserExcel'])->name('budget.import');
    Route::post('/import', [ImportController::class, 'import'])->name('importbudgetfacture');


Route::get('/enregistrement', [SocieteChequePersonnelTauxController::class, 'create'])->name('enregistrement.create');

Route::post('/cheque', [SocieteChequePersonnelTauxController::class, 'storeCheque'])->name('cheque.store');
Route::post('/personnel', [SocieteChequePersonnelTauxController::class, 'storePersonnel'])->name('personnel.store');
Route::post('/taux', [SocieteChequePersonnelTauxController::class, 'storeTaux'])->name('taux.store');
Route::get('/cheque', [SocieteChequePersonnelTauxController::class, 'index'])->name('cheque.index');
// Routes pour Chèque - Ajout des routes pour modifier
Route::get('cheque/{id}/edit', [SocieteChequePersonnelTauxController::class, 'editCheque'])->name('cheque.edit');
Route::put('cheque/{id}', [SocieteChequePersonnelTauxController::class, 'updateCheque'])->name('cheque.update');
// Route pour la liste du personnel
Route::get('personnel', [SocieteChequePersonnelTauxController::class, 'indexPersonnel'])->name('personnel.index');

// Routes pour Chèque - Ajout des routes pour modifier
Route::get('pers/{id}/edit', [SocieteChequePersonnelTauxController::class, 'editPers'])->name('pers.edit');
Route::put('pers/{id}', [SocieteChequePersonnelTauxController::class, 'updatePersonnel'])->name('pers.update');
Route::get('/taux', [SocieteChequePersonnelTauxController::class, 'indexTaux'])->name('taux.index');
Route::get('/taux/{id}/edit', [SocieteChequePersonnelTauxController::class, 'editTaux'])->name('taux.edit');
Route::put('/taux/{id}', [SocieteChequePersonnelTauxController::class, 'updateTaux'])->name('taux.update');
Route::put('/personnel/{id}/supp', [SocieteChequePersonnelTauxController::class, 'deactivate'])->name('pers.deactivate');





Route::get('/societe/{id}/edit', [SocieteChequePersonnelTauxController::class, 'editSociete'])->name('societe.edit');
Route::put('/societe/{id}', [SocieteChequePersonnelTauxController::class, 'updateSociete'])->name('societe.update');


Route::get('/consultant/home', [ConsultantController::class, 'home'])->name('home'); 
Route::get('/consultant/listeClient', [ConsultantController::class, 'show'])->name('allClient'); 

    // Route pour afficher toutes les tranches
    Route::get('/trancheConsultant/show', [ConsultantController::class, 'showFactureSansFiltre'])->name('tranchelistes.consultant');
    // Route pour afficher la liste des tranches avec une méthode POST
    Route::post('/trancheConsultant/liste', [ConsultantController::class, 'showFacture'])->name('trancheshow.consultant');


    Route::get('/choix/create/{id_facture}', [ChoixBanqueController::class, 'index'])->name('choix.create');
    Route::post('/choix-banque/{id_facture}', [ChoixBanqueController::class, 'store'])->name('choix.store');

});







