<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousTypeMission extends Model
{
    protected $table = 'sous_type_mission';
    protected $primaryKey = 'id_sous_type_mission';


    protected $fillable = [
        'code_sous_mission',
        'types',
        'id_type_mission',
     

     ];


     public $timestamps = true;

    public function typeMission()
    {
        return $this->belongsTo(TypeMission::class, 'id_type_mission');
    }



}
