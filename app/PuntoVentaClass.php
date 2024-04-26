<?php

namespace App;

use App\Models\Factura;
use App\Models\FacturaTemp;
use App\Models\ProductoFactura;
use App\Models\ProductoTemp;

class PuntoVentaClass
{
    private $productos;
    private $clientes;

    public function __construct(ProductosCLass $productos, ClientesClass $clientes)
    {
        $this->productos = $productos;
        $this->clientes = $clientes;
    }

    public function DatosFacturas(){
        $datos = Factura::all();
        return $datos;
    }

    public function FacturaTempTodos(){
        $datos = FacturaTemp::all();
        return $datos;
    }

    public function RegistroFacturaTemp(){
        $datos = FacturaTemp::first();
        return $datos;
    }

    public function ProductoDescontar($producto, $descontar){
        $this->productos->DescontarCantidad($producto, $descontar );
    }

    public function ProductoTempTodos(){
        $datos = ProductoTemp::all();
        return $datos;
    }

    public function ProductoTempSuma(){
        $datos = ProductoTemp::sum('precio');
        return $datos;
    }

    public function ProductoTempSum(){
        $datos = ProductoTemp::sum('cantidad');
        return $datos;
    }
    
    public function ProductosFactura($factura){
        $datos = ProductoFactura::where('factura', $factura)->get();
        return $datos;
    }

    public function DevolverProductos($datos){
        foreach ($datos as $item) {
            $produc = $item->producto;
            $cantida = $item->cantidad;

            $devolver = $this->productos->BuscarProductoNombre($produc);
            
            $cantidaP = $devolver->cantidad + $cantida;
            
            $devolver->update([
                "cantidad" => $cantidaP,
            ]);
        }
    }

    public function BorrarProductos($productosFactura){
        foreach ($productosFactura as $productoFactura) {
            $productoFactura->delete();
        }
    }

    public function Factura($id){
        $factura = Factura::where('factura', $id)->first();
        return $factura;
    }

    public function FacturaMes($id){
        $factura = Factura::where('factura', $id)->first();
        return $factura;
    }

    public function CrearFacturaCompra($datos, $cantidaProdu, $totalCompra){

        Factura::create([
            'factura' => $datos->factura,
            'admin' => $datos->admin,
            'nombre' => $datos->nombre,
            'cedula' => $datos->cedula,
            'cantidadProducto' => $cantidaProdu,
            'totalCompra' => $totalCompra
        ]);
    }

    public function ProductoTempCrear($nombre, $comprar, $preciot, $precioUni){
        ProductoTemp::create([
            "producto" => $nombre,
            "precioUni" => $precioUni,
            "cantidad" => $comprar,
            "precio" => $preciot,
        ]);
    }

    public function guardarProductos($dato, $factura){
        foreach ($dato as $item) {
            ProductoFactura::create([
                "factura" => $factura,
                "producto" => $item->producto,
                "precioUni" => $item->precioUni,
                "cantidad" => $item->cantidad,
                "precio" => $item->precio
            ]);

            
        }
    }
    
    public function reinicialProductoF(){

        $datos = ProductoTemp::all();
        foreach ($datos as $item) {
            $produc = $item->producto;
            $cantida = $item->cantidad;

            $devolver = $this->productos->BuscarProductoNombre($produc);
            $cantidaP = $devolver->cantidad + $cantida;

            $devolver->update([
                "cantidad" => $cantidaP,
            ]);
        }
    }

    public function reinicialTablas(){

        FacturaTemp::truncate();
        ProductoTemp::truncate();
    }

    public function ClienteFactura($data){

        $cliente = $this->clientes->BuscarClienteId($data->cliente);
        
        FacturaTemp::create([
            "factura" => $data->factura,
            "admin" => auth()->user()->name,
            "nombre" => $cliente->nombre,
            "apellido" => $cliente->apellido,
            "cedula" => $cliente->cedula,
        ]);
    }

    public function BuscarProductoid($id){
       $datos = ProductoTemp::find($id);
        return $datos;
    }

    public function productoTempEliminar(ProductoTemp $id){
        $id->delete();
     }

}
