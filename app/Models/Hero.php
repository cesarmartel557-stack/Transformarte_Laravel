<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [
        'titulo',
        'subtitulo',
        'boton_texto',
        'boton_url',
        'imagen',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_image',
    ];
}
