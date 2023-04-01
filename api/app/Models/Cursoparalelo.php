<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursoparalelo extends Model
{
    use HasFactory;
    protected $fillable = [
        'curso_id',
        'paralelo_id',
        'nivele_id',
        'colegio_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function paralelo(){
        return $this->hasOne(Paralelo::class,'id','paralelo_id');
    }
    public function curso(){
        return $this->hasOne(Curso::class,'id','curso_id');
    }
    public function nivele(){
        return $this->hasOne(Nivele::class,'id','nivele_id');
    }
    public function colegio(){
        return $this->hasOne(Colegio::class,'id','colegio_id');
    }
    public function horario(){
        return $this->belongsTo(Horario::class);
    }
    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }
}

