<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccione extends Model
{
    use HasFactory;

    protected $fillable = [
        'ciudad',
        'zona',
        'calle',
        'nro',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function colegio(){
        return $this->belongsToMany(Colegio::class,'colegio_direccione')->using(ColegioDireccione::class);
    }
    public function persona(){
        return $this->belongsToMany(Persona::class,'direccione_persona')->using(DireccionPersona::class);
    }
}
