<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function cursoparalelo(){
        return $this->belongsTo(Cursoparalelo::class);
    }
    public function estudiante(){
        return $this->belongsToThrough(Estudiante::class, Cursoparalelo::class);
    }
    public function horario(){
        return $this->belongsToThrough(Horario::class, Cursoparalelo::class);
    }
}
