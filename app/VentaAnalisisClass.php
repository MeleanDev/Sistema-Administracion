<?php

namespace App;

use App\Models\MesCantidad;

class VentaAnalisisClass
{
    public function obtenerMes($actual){
        $datos = MesCantidad::where('mes', $actual)->first();
        return $datos;
    }

    public function SumarCompraMes(MesCantidad $dato, $cantidad, $compra){
        $dato->update([
            'cantidad' => $compra,
            'Compras' => $cantidad
        ]);
        $dato->save();
    }

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
}
