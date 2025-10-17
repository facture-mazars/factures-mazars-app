<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grade';

    protected $primaryKey = 'id_grade';

    public function personnel()
    {
        return $this->hasMany(ListePersonnel::class, 'id_grade', 'id_grade');
    }

    public function equipes()
    {
        return $this->hasMany(Equipe::class, 'id_grade');
    }
}
