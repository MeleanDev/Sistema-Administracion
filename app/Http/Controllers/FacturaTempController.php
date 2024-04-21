<?php

namespace App\Http\Controllers;

use App\Models\FacturaTemp;
use App\Models\Producto;
use App\Models\ProductoFactura;
use Illuminate\Http\Request;

class FacturaTempController extends Controller
{
    public function index(){

        // datos de la factra
        $dataF = FacturaTemp::all();

        // extraer todos los registros que tengan el mismo id de la factura
        $idfactura = FacturaTemp::select('factura')->first();
        $productoF = ProductoFactura::where('factura', $idfactura)->get();
        $precioTotal = ProductoFactura::where('factura', $idfactura)->sum('precio');

        $productos = Producto::all();

        return view('panelAdmin.factura', compact('dataF', 'productoF', 'productos','precioTotal'));
    }
}
