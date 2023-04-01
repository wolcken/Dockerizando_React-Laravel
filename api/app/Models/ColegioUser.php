<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ColegioUser extends Pivot
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'colegio_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
