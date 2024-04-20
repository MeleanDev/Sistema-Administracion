<?php

namespace App\Http\Controllers;

use App\Models\MesCantidad;
use App\Models\MetodosPago;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function index(){

        $Bd = MesCantidad::all();
        $data = []; // Inicializa un arreglo vacío
        foreach ($Bd as $item) {
            $data['label'][] = $item->mes;  // Agrega el mes a la clave 'label'
            $data['data'][] = $item->cantidad; // Agrega la cantidad a la clave 'data'
        }

        $BdCuentas = MetodosPago::all();
        $dataCuentas = []; // Inicializa un arreglo vacío
        foreach ($BdCuentas as $item) {
            $dataCuentas['label'][] = $item->tipo." (".$item->banco.")";  // Agrega el mes a la clave 'label'
            $dataCuentas['data'][] = $item->cantidad; // Agrega la cantidad a la clave 'data'
        }

        // Solo codifica a JSON si es necesario para un caso de uso específico
        $data['data'] = json_encode($data);
        $dataCuentas['dataCuentas'] = json_encode($dataCuentas);
        return view('panelAdmin.ventas', $data, $dataCuentas);
    }
}
