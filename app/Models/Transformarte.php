<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transformarte extends Model
{
    protected $fillable = [
        'insignia',
        'titulo',
        'parrafo_1',
        'parrafo_2',
        'imagen',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(TransformarteItem::class)->orderBy('orden');
    }
}
