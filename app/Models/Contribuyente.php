<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribuyente extends Model
{
    protected $table = 'contribuyentes';
    public $timestamps = false;
    protected $fillable = [
        'tipo_documento',
        'documento',
        'nombre',
        'apellidos',
        'direccion',
        'telefono',
        'celular',
        'email',
        'usuario',
    ];
    
}
