<?php

namespace App;

use App\Models\Factura;
use App\Models\MesCantidad;
use App\Models\Producto;
use App\Models\ProductoFactura;

class DashboardClass
{
    public function Mes($mes){
        $datos = match ($mes) {
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        };   
        return $datos;
    }

    public function obtenerMes($mes){
        $datos = MesCantidad::where('mes', $mes)->first();
        return $datos;
    }

    public function tabla5mejoresFactu($columna){
        $products = Factura::orderByDesc($columna)->limit(5)->get();
        return $products;
    }

    public function tabla5mejoresProduc($columna){
        $products = Producto::orderByDesc($columna)->limit(5)->get();
        return $products;
    }
}
