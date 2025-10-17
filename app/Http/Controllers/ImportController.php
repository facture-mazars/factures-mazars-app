<?php

namespace App\Http\Controllers;

use App\Imports\BudgetFactureImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function showInserExcel()
    {
        return view('import.budgetfactureImport');
    }

    public function import(Request $request)
    {
        $file = $request->file('excel_file');
        Excel::import(new BudgetFactureImport, $file);

        return response()->json(['message' => 'Importation réussie.']);
    }
}
