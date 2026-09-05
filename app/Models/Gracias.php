<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gracias extends Model
{
    protected $table = 'gracias';

    protected $fillable = [
        'insignia',
        'titulo',
        'texto',
        'texto_urgencia',
        'boton_whatsapp_texto',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_image',
    ];
}
