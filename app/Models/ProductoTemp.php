<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoTemp extends Model
{
    use HasFactory;

    protected $fillable = [
        'producto',
        'precioUni',
        'cantidad',
        'precio'];
}
