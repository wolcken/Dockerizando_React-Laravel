<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiauser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'materia_id',
        'nivele_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function materia(){
        return $this->hasOne(Materia::class,'id','materia_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function nivele(){
        return $this->hasOne(Nivele::class,'id','nivele_id');
    }
    public function persona(){
        return $this->hasOneThrough(Persona::class,User::class,'id','id','persona_id','user_id');
    }
    public function colegio(){
        return $this->hasOneThrough(Colegio::class,User::class,'id','id','colegio_id','user_id');
    }
    public function role(){
        return $this->hasOneThrough(Role::class,User::class,'id','id','role_id','user_id');
    }
    public function horario(){
        return $this->belongsTo(Horario::class);
    }
    public function asistencia(){
        return $this->belongsTo(Asistencia::class);
    }

}
