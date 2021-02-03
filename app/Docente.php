<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    public $table = 'docente';
    public $timestamps = false;
 protected $fillable = [
        'cedula',

        'nombres',
        'correoUTA',
        'correo',
        'ceular',
        'telefono'
    ];
}
