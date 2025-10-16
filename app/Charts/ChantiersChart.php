<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class ChantiersChart extends Chart
{
    public function __construct()
    {
        parent::__construct();
        $this->displayLegend(true)
             ->displayLabels(true);
    }

    public function data()
    {
        // Fetch data from the database
        $chantiers = DB::table('chantier')
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count'))
            ->groupBy('year', 'month')
            ->get();

        $months = [];
        $counts = [];

        foreach ($chantiers as $chantier) {
            $months[] = sprintf('%d-%02d', $chantier->year, $chantier->month);
            $counts[] = $chantier->count;
        }

        // Setup the chart data
        $this->labels($months)
             ->dataset('Chantiers en cours', 'line', $counts)
             ->color('rgba(75, 192, 192, 0.2)')
             ->backgroundcolor('rgba(75, 192, 192, 0.2)');
    }
}
