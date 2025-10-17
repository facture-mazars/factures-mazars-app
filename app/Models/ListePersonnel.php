<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListePersonnel extends Model
{
    use HasFactory;

    protected $table = 'liste_personnel';

    protected $primaryKey = 'id_liste_personnel';

    protected $fillable = [
        'nom',          // Ajout du champ nom
        'prenom',       // Ajout du champ prenom
        'id_grade',     // Ajout du champ id_grade
        'matricule',    // Ajout du champ matricule
        'actif',        // Ajout du champ actif
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'id_grade', 'id_grade');
    }

    public function equipes()
    {
        return $this->hasMany(Equipe::class, 'id_liste_personnel');
    }
}
