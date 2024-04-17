<?php

namespace App;

use App\Models\Proveedor;

class ProveedoresClass
{
    public function DatosProveedores(){

        $data = Proveedor::all();
        return $data;
    }

    public function CrearProveedor($data){

        Proveedor::create([
            'identificacion'=> $data['identificacion'],
            'nombre'=> $data['nombre'],
            'telefono'=> $data['telefono'],
            'correo'=> $data['correo'],
            'direccion'=> $data['direccion'],
            'descripcion'=> $data['descripcion'],
        ]);
    }

    public function EditarProveedor($data){
        
        $id = $data['id'];
      
        $Proveedo = Proveedor::where('identificacion', $id)->first();

        $Proveedo->identificacion = $data['identificacion'];
        $Proveedo->nombre = $data['nombre'];
        $Proveedo->telefono = $data['telefono'];
        $Proveedo->correo = $data['correo'];
        $Proveedo->direccion = $data['direccion'];
        $Proveedo->descripcion = $data['descripcion'];
        $Proveedo->save();
    }

    public function EliminarProveedor($data){

        $id = $data['id'];

        $producto = Proveedor::where('identificacion', $id)->first();
        $producto->delete();
    }
}
