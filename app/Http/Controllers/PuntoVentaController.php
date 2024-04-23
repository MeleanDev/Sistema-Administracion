<?php

namespace App\Http\Controllers;

use App\ClientesClass;
use App\Models\FacturaTemp;
use App\PuntoVentaClass;
use Illuminate\Http\Request;

class PuntoVentaController extends Controller
{
    private $puntoventa;
    private $clientes;

    public function __construct(PuntoVentaClass $puntoventa, ClientesClass $clientes)
    {
        $this->puntoventa = $puntoventa;
        $this->clientes = $clientes;
    }

    public function index(){
        $existeRegistro = FacturaTemp::existeRegistro('id', 1);
        $clientes = $this->clientes->DatosClientes();
        return view('panelAdmin.puntoVenta', compact('clientes', 'existeRegistro'));
      }

    public function CrearFactura(Request $data){
        try {
            // devolver los producto de factura no terminada
            $this->puntoventa->reinicialProductoF();

            // renicial tablas de facturatemp y productofactura
            $this->puntoventa->reinicialTablas();
            
            // se agarran los datos de $data para empezar con la factura con los datos del cliente
            $this->puntoventa->ClienteFactura($data);

            return redirect()->route('Factura.crear');
        } catch (\Throwable $th) {
            return redirect()->route('PuntoVentas')->with('incorrectamente', 'Cliente no encontrado en la base de dato');
        }
    }
}
