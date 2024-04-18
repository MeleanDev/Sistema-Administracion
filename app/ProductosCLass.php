<?php

namespace App;

use App\Models\Producto;

class ProductosCLass
{
    public function DatosProducto(){

        $data = Producto::all();
        return $data;
    }

    public function CrearProducto($data){
        Producto::create([
            'nombre'=> $data['nombre'],
            'descripcion'=> $data['descripcion'],
            'proveedor'=> $data['proveedor'],
            'cantidad'=> $data['cantidad'],
            'precio'=> $data['precio'],
        ]);
    }

    public function EditarProducto($data){
        $id = $data['id'];
      
        $proveed = Producto::where('nombre', $id)->first();
        $proveed->nombre = $data['nombre'];
        $proveed->descripcion = $data['descripcion'];
        $proveed->proveedor = $data['cantidad'];
        $proveed->cantidad = $data['cantidad'];
        $proveed->precio = $data['precio'];
        $proveed->save();
        
    }

    public function EliminarProducto($data){
        $id = $data['id'];
        $producto = Producto::where('nombre', $id)->first();
        $producto->delete();
    }
}
