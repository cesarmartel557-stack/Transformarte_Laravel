<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'sesion',
        'mensaje',
        'leido',
        'ip',
    ];

    protected $casts = [
        'leido' => 'boolean',
    ];
}
