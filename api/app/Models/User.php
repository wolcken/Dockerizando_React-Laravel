<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\HttpFoundation\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role_id',
        'persona_id',
        'colegio_id',
        'actividad',
    ];
    protected $table="users";
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'id',
    //     'password',
    //     'remember_token',
    //     'created_at',
    //     'updated_at',
    // ];
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles(){
        // si el nombre colocado de la tabla no es role_user pasar la tabla
        return $this->hasOne(Role::class,'id','role_id');
    }
    public function persona(){
        return $this->hasOne(Persona::class,'id','persona_id');
    }

    public function colegio(){
        return $this->hasOne(Colegio::class,'id','colegio_id');
    }
    public function materiauser(){
        return $this->belongsTo(Materiauser::class);
    }
    public function horario(){
        return $this->belongsToThrough(Horario::class,Materiauser::class);
    }
    
}
