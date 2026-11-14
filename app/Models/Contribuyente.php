<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Contribuyente extends Model
{
    protected static function booted(): void
    {
    static::saving(function (Contribuyente $contribuyente): void {
        $contribuyente->nombre_completo = trim(
            ($contribuyente->nombre ?? '') . ' ' .
            ($contribuyente->apellidos ?? '')
        );
    });
    }
    public function user(): HasOne
    {
    return $this->hasOne(User::class, 'contribuyente_id');
    }

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
