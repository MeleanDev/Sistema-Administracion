<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\FacturaTemp;
use Illuminate\Http\Request;

class PuntoVentaController extends Controller
{
    public function index(){
        $clientes = Cliente::all();
        return view('panelAdmin.puntoVenta', compact('clientes'));
    }

    public function CrearFactura(Request $data){

        FacturaTemp::truncate();
        $cliente = Cliente::where('id', $data->cliente)->first();
        FacturaTemp::create([
            "factura" => $data->factura,
            "admin" => auth()->user()->name,
            "nombre" => $cliente->nombre,
            "apellido" => $cliente->apellido,
            "cedula" => $cliente->cedula,
        ]);
        return redirect()->route('Factura.crear');
    }
}
