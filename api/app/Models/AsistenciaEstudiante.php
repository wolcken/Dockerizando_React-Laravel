<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AsistenciaEstudiante extends Pivot
{
    use HasFactory;
    protected $fillable = [
        'estudiante_id',
        'asistencia_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
