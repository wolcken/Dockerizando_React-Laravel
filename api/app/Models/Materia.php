<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function materiauser(){
        return $this->belongsTo(Materiauser::class);
    }
    public function horario(){
        return $this->belongsToThrough(Horario::class,Materiauser::class);
    }
}
