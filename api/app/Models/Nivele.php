<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivele extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function horario(){
        return $this->belongsTo(Horario::class);
    }
    public function materiauser(){
        return $this->belongsTo(Materiauser::class);
    }
    public function estudiante(){
        return $this->belongsToThrough(Estudiante::class, Cursoparalelo::class);
    }
    public function cursoparalelo(){
        return $this->belongsTo(Cursoparalelo::class);
    }
}
