<?php

namespace App\Http\Controllers;

use App\Imports\BudgetFactureImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

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
