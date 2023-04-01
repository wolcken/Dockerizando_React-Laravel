<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'carnet',
        'nacimiento',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }
    public function tutore(){
        return $this->belongsTo(Tutore::class);
    }
    public function celulare(){
        return $this->belongsToMany(Celulare::class,'celulare_persona')->using(CelularePersona::class);
    }
    public function direccione(){
        return $this->belongsToMany(Direccione::class,'direccione_persona')->using(DireccionePersona::class);
    }
    public function materiauser(){
        return $this->belongsToThrough(Materiauser::class,User::class);
    }
}
