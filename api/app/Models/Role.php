<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'role',
        'sueldo',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function materiauser(){
        return $this->belongsToThrough(Materiauser::class,User::class);
    }
}
