<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'identificacion',
        'nombre',
        'telefono',
        'correo',
        'direccion',
        'descripcion'
    ];
}
