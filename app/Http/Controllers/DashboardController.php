<?php

namespace App\Http\Controllers;

use App\AdministradoresClass;
use App\ClientesClass;
use App\DashboardClass;
use App\ProductosCLass;
use App\PuntoVentaClass;
use Carbon\Carbon;

class DashboardController extends Controller
{
        private $puntoventa;
        private $clientesCount;
        private $ProductoCount;
        private $AdministradoresCount;
        private $DashboardClass;

        public function __construct(PuntoVentaClass $puntoventa, 
                                    ClientesClass $clientesCount, 
                                    ProductosCLass $ProductoCount, 
                                    AdministradoresClass $AdministradoresCount,
                                    DashboardClass $DashboardClass){

            $this->puntoventa = $puntoventa;
            $this->clientesCount = $clientesCount;
            $this->ProductoCount = $ProductoCount;
            $this->AdministradoresCount = $AdministradoresCount;
            $this->DashboardClass = $DashboardClass;
        }

    public function index(){

        // devolver los producto de factura no terminada
        $this->puntoventa->reinicialProductoF();

        // renicial tablas de facturatemp y productofactura
        $this->puntoventa->reinicialTablas();

        $admins = $this->AdministradoresCount->DatosAdministradoresCount();
        $clientes = $this->clientesCount->DatosClientesCount();
        $productos = $this->ProductoCount->DatosProductoCount();

        $mes = Carbon::now()->format('F');
        $actual = $this->DashboardClass->Mes($mes);   
        $datosMes = $this->DashboardClass->obtenerMes($actual);
        
        return view('dashboard', compact('admins','clientes','productos', 'datosMes'));
    }
}
