<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celulare extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function colegio(){
        return $this->belongsToMany(Colegio::class,'celulare_colegio')->using(CelulareColegio::class);
    }
    public function persona(){
        return $this->belongsToMany(Persona::class,'celulare_persona')->using(CelularePersona::class);
    }
}
