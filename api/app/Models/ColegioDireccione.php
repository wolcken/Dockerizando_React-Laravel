<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ColegioDireccione extends Pivot
{
    use HasFactory;
    protected $fillable = [
        'colegio_id',
        'direccione_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
