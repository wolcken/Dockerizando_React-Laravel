<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha',
        'validacione_id',
        'materiauser_id',
        'mensaje_id',
        'mensaje',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function estudiante(){
        return $this->belongsToMany(Estudiante::class,'asistencia_estudiante')->using(AsistenciaEstudiante::class);
    }
    public function validacione(){
        return $this->hasOne(Validacione::class,'id','validacione_id');
    }
    public function materiauser(){
        return $this->hasOne(Materiauser::class,'id','materiauser_id');
    }
    public function mensaje(){
        return $this->hasOne(Mensaje::class,'id','mensaje_id');
    }
}
