<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';

    protected $fillable = [
        'imagen',
        'insignia',
        'titulo',
        'texto',
        'boton_url',
    ];
}
