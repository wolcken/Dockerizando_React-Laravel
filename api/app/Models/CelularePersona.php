<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CelularePersona extends Pivot
{
    use HasFactory;
    protected $fillable = [
        'celulare_id',
        'persona_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
