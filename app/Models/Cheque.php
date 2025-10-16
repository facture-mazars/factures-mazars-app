<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    protected $table = 'cheque';
    protected $primaryKey = 'id_cheque';
    public $timestamps = false;

    protected $fillable = [
        'nom',
    ];
}
