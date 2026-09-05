<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SobreMi extends Model
{
    protected $table = 'sobre_mis';

    protected $fillable = [
        'titulo',
        'parrafo_1',
        'parrafo_2',
        'imagen',
        'imagen_felino',
        'cta_texto',
    ];
}
