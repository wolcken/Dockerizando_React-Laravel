<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutore extends Model
{
    use HasFactory;
    protected $fillable = [
        'persona_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function estudiante(){
        return $this->belongsToMany(Estudiante::class,'estudiante_tutore')->using(EstudianteTutore::class);
    }
    public function persona(){
        return $this->hasOne(Persona::class,'id','persona_id');
    }
}
