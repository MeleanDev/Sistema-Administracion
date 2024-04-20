<?php

namespace App\Http\Controllers;

use App\Models\MesCantidad;
use App\Models\MetodosPago;
use Carbon\Carbon;
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

        $nombreMesActual = Carbon::now()->format('F');
        $actual = match ($nombreMesActual) {
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

        $datosMes = MesCantidad::where('mes', $actual)->first();

        // Solo codifica a JSON si es necesario para un caso de uso específico
        $data['data'] = json_encode($data);
        $dataCuentas['dataCuentas'] = json_encode($dataCuentas);
        return view('panelAdmin.ventas', $data, $dataCuentas)->with('datosMes', $datosMes);

    }
}
