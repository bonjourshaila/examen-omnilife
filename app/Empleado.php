<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleado';
    protected $fillable = [
        'codigo',
        'nombre',
        'salarioDolares',
        'salarioPesos',
        'direccion',
        'estado',
        'ciudad',
        'telefono',
        'correo'
    ];
}
