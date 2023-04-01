<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = [
        'inscripcion',
        'persona_id',
        'cursoparalelo_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function persona(){
        return $this->hasOne(Persona::class,'id','persona_id');
    }
    public function cursoparalelo(){
        return $this->hasOne(Cursoparalelo::class,'id','cursoparalelo_id');
    }
    public function tutore(){
        return $this->belongsToMany(Tutore::class,'estudiante_tutore')->using(EstudianteTutore::class);
    }
    public function asistencia(){
        return $this->belongsToMany(Asistencia::class,'asistencia_estudiante')->using(AsistenciaEstudiante::class);
    }
    public function curso(){
        return $this->hasOneThrough(Curso::class,Cursoparalelo::class,'id','id','cursoparalelo_id','curso_id');
    }
    public function paralelo(){
        return $this->hasOneThrough(Paralelo::class,Cursoparalelo::class,'id','id','cursoparalelo_id','paralelo_id');
    }
    public function nivele(){
        return $this->hasOneThrough(Nivele::class,Cursoparalelo::class,'id','id','cursoparalelo_id','nivele_id');
    }
    public function colegio(){
        return $this->hasOneThrough(Colegio::class,Cursoparalelo::class,'id','id','cursoparalelo_id','colegio_id');
    }
}
