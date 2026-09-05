<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormatoSesion extends Model
{
    protected $table = 'formato_sesiones';

    protected $fillable = [
        'insignia',
        'titulo',
        'parrafo_1',
        'parrafo_2',
        'detalle',
        'boton_texto',
        'boton_url',
        'orden',
    ];
}
