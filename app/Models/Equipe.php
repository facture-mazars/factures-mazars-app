<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;

    protected $table = 'equipe';

    protected $primaryKey = 'id_equipe';

    protected $fillable = [
        'id_chantier',
        'id_grade',
        'id_liste_personnel',
    ];

    // Dans le modèle `Equipe`
    public function budget()
    {
        return $this->hasMany(Budget::class, 'id_equipe');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'id_grade');
    }

    // Relation avec le modèle ListePersonnel
    public function listePersonnel()
    {
        return $this->belongsTo(ListePersonnel::class, 'id_liste_personnel');
    }
}
