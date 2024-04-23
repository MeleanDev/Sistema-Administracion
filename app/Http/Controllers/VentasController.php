<?php

namespace App\Http\Controllers;

use App\DashboardClass;
use App\Models\MesCantidad;
use App\Models\MetodosPago;
use App\PuntoVentaClass;
use Carbon\Carbon;

class VentasController extends Controller
{
    private $puntoventa;
    private $DashboardClass;

    public function __construct(PuntoVentaClass $puntoventa, 
                                DashboardClass $DashboardClass){

        $this->puntoventa = $puntoventa;
        $this->DashboardClass = $DashboardClass;
    }
    public function index(){

        // devolver los producto de factura no terminada
        $this->puntoventa->reinicialProductoF();

        // renicial tablas de facturatemp y productofactura
        $this->puntoventa->reinicialTablas();

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

        $mes = Carbon::now()->format('F');
        $actual = $this->DashboardClass->Mes($mes);   
        $datosMes = $this->DashboardClass->obtenerMes($actual);

        // Solo codifica a JSON si es necesario para un caso de uso específico
        $data['data'] = json_encode($data);
        $dataCuentas['dataCuentas'] = json_encode($dataCuentas);
        return view('panelAdmin.ventas', $data, $dataCuentas)->with('datosMes', $datosMes);

    }
}
