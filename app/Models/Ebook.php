<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $fillable = [
        'imagen',
        'titulo',
        'texto',
        'pdf',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_image',
    ];
}
