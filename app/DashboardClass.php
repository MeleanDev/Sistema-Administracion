<?php

namespace App;

use App\Models\MesCantidad;

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
            'October' => 'Obtubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        };   
        return $datos;
    }

    public function obtenerMes($mes){
        $datos = MesCantidad::where('mes', $mes)->first();
        return $datos;
    }
}
