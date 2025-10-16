<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalBudget extends Model
{
    use HasFactory;

    protected $table = 'total_budget';

    protected $primaryKey = 'id_total_budget'; 
    public $incrementing = true; 


    protected $fillable = [
        'id_chantier',
        'total_jour_homme',
        'total_global',
        'taux_moyen',
    ];


}
