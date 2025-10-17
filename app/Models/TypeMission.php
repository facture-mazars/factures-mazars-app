<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeMission extends Model
{
    protected $table = 'type_mission';

    protected $primaryKey = 'id_type_mission';

    protected $fillable = [
        'code_mission',
        'types',

    ];

    public $timestamps = true;

    public function sousTypes()
    {
        return $this->hasMany(SousTypeMission::class, 'id_type_mission');
    }

    public function chantiers()
    {
        return $this->hasMany(Client::class, 'id_type_mission');
    }
}
