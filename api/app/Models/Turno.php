<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function colegio(){
        return $this->belongsTo(Colegio::class);
    }
    public function user(){
        return $this->belongsToThrough(User::class,Colegio::class);
    }
}
