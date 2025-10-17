<?php

namespace App\Http\Controllers;

use NumberToWords\NumberToWords;

class ConversionController extends Controller
{
    public function conversionNombreEnMots($number)
    {
        $numberToWords = new NumberToWords;
        $numberTransformer = $numberToWords->getNumberTransformer('fr'); // Utiliser 'fr' pour le français

        $words = $numberTransformer->toWords($number);

        return $words;
    }
}
