<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransformarteItem extends Model
{
    protected $fillable = [
        'transformarte_id',
        'icono',
        'titulo',
        'texto',
        'orden',
    ];

    public function transformarte(): BelongsTo
    {
        return $this->belongsTo(Transformarte::class);
    }
}
