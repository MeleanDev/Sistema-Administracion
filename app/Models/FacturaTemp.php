<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaTemp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'factura',
        'admin',
        'nombre',
        'apellido',
        'cedula'
        ];

        public static function existeRegistro($columna, $valor)
        {
        return FacturaTemp::where($columna, $valor)->exists();
        }
}
