<?php

namespace App\Http\Controllers;

use App\ProductosCLass;
use App\PuntoVentaClass;
use Illuminate\Http\Request;

class FacturaTempController extends Controller
{
    private $puntoventa;
    private $producto;

    public function __construct(PuntoVentaClass $puntoventa, ProductosCLass $producto)
    {
        $this->puntoventa = $puntoventa;
        $this->producto = $producto;

    }

    public function index(){

        // datos de la factra
        $dataF = $this->puntoventa->FacturaTempTodos();
        $productoF = $this->puntoventa->ProductoTempTodos();
        $precioTotal = $this->puntoventa->ProductoTempSuma();

        $productos = $this->producto->DatosProducto();

        return view('panelAdmin.factura', compact('dataF', 'productoF', 'productos','precioTotal'));
    }

    public function guardarPro(Request $id){
        try {
            $producto = $this->producto->BuscarProductoid($id->producto);

            $disponible = $producto->cantidad;
            $precio = $producto->precio;
            $comprar = $id->cantidad;

            if ($disponible >= $comprar and $comprar > 0) {
                $preciot = $precio * $comprar;
                $descontar = $disponible - $comprar;

                $this->puntoventa->ProductoDescontar($producto, $descontar);

                $this->puntoventa->ProductoTempCrear($producto->nombre, $comprar, $preciot, $precio);

                return redirect()->route('Factura.crear')->with('correctamente', 'Producto Agregado a la factura');
            }
            return redirect()->route('Factura.crear')->with('incorrectamente', 'Cantidad no disponible del porducto');
        } catch (\Throwable $th) {
            return redirect()->route('Factura.crear')->with('incorrectamente', 'Producto No Agregado a la factura');
        }

    }

    public function eliminar($id){

        try {
            $productoTemp = $this->puntoventa->BuscarProductoid($id); // Obtén el modelo del registro que deseas eliminar
            $producto = $this->producto->BuscarProductoNombre($productoTemp->producto);

            $this->producto->ActualizarCantidadProducto($productoTemp->cantidad,$producto->cantidad,$producto);

            $this->puntoventa->productoTempEliminar($productoTemp);
            
            return redirect()->route('Factura.crear')->with('correctamente', 'Producto Eliminado de la factura');
        } catch (\Throwable $th) {
            return redirect()->route('Factura.crear')->with('incorrectamente', 'Producto No eliminado de la factura');
        }
    }
}