<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = [
        'email',
        'whatsapp',
        'calendly_url',
        'instagram_url',
    ];
}
