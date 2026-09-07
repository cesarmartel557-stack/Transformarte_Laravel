<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuraciones';

    protected $fillable = [
        'mostrar_ebooks',
    ];

    protected $casts = [
        'mostrar_ebooks' => 'boolean',
    ];
}
