<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colegio extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'turno_id',
        'categoria_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function materiauser(){
        return $this->belongsToThrough(Materiauser::class,User::class);
    }
    public function turno(){
        return $this->hasOne(Turno::class,'id','turno_id');
    }
    public function categoria(){
        return $this->hasOne(Categoria::class,'id','categoria_id');
    }
    public function estudiante(){
        return $this->belongsToThrough(Estudiante::class, Cursoparalelo::class);
    }
    public function celulare(){
        return $this->belongsToMany(Celulare::class,'celulare_colegio')->using(CelulareColegio::class);
    }
    public function direccione(){
        return $this->belongsToMany(Direccione::class,'colegio_direccione')->using(ColegioDireccione::class);
    }
    public function horario(){
        return $this->belongsToThrough(Horario::class, Cursoparalelo::class);
    }
}
