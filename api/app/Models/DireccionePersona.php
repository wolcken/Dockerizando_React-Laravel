<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DireccionePersona extends Pivot
{
    use HasFactory;
    protected $fillable = [
        'direccione_id',
        'persona_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
