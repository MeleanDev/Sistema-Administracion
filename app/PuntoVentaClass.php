<?php

namespace App;


use App\Models\FacturaTemp;
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

    public function FacturaTempTodos(){
        $datos = FacturaTemp::all();
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

    public function ProductoTempCrear($nombre, $comprar, $preciot, $precioUni){
        ProductoTemp::create([
            "producto" => $nombre,
            "precioUni" => $precioUni,
            "cantidad" => $comprar,
            "precio" => $preciot,
        ]);
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
