<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EstudianteTutore extends Pivot
{
    use HasFactory;
    protected $fillable = [
        'tutore_id',
        'estudiante_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
