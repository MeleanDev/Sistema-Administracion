<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroActividad extends Model
{
    use HasFactory;

    protected $fillable =[ 
        'usuario',
        'accion',
        'last_login',
    ];
}
