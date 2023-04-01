<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    protected $fillable = [
        'dia_id',
        'nivele_id',
        'cursoparalelo_id',
        'materiauser_id',
        'periodo_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function dia(){
        return $this->hasOne(Dia::class,'id','dia_id');
    }
    public function nivele(){
        return $this->hasOne(Nivele::class,'id','nivele_id');
    }
    public function periodo(){
        return $this->hasOne(Periodo::class,'id','periodo_id');
    }
    public function cursoparalelo(){
        return $this->hasOne(Cursoparalelo::class,'id','cursoparalelo_id');
    }
    public function materiauser(){
        return $this->hasOne(Materiauser::class,'id','materiauser_id');
    }
    public function materia(){
        return $this->hasOneThrough(Materia::class,Materiauser::class,'id','id','materiauser_id','materia_id');
    }
    public function user(){
        return $this->hasOneThrough(User::class,Materiauser::class,'id','id','materiauser_id','user_id');
    }
    public function curso(){
        return $this->hasOneThrough(Curso::class,Cursoparalelo::class,'id','id','cursoparalelo_id','curso_id');
    }
    public function paralelo(){
        return $this->hasOneThrough(Paralelo::class,Cursoparalelo::class,'id','id','cursoparalelo_id','paralelo_id');
    }
    public function colegio(){
        return $this->hasOneThrough(Colegio::class,Cursoparalelo::class,'id','id','cursoparalelo_id','colegio_id');
    }

}
