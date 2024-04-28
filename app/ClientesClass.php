<?php

namespace App;

use App\Models\Cliente;

class ClientesClass
{
    public function DatosClientes(){

        $data = Cliente::all();
        return $data;
    }

    public function DatosClientesCount(){

        $data = Cliente::count();
        return $data;
    }

    public function BuscarClienteId($data){
        
        $data = Cliente::where('id', $data)->first();
        return $data;
    }

    public function BuscarClienteCedula($data){
        $dat = Cliente::where('cedula', $data)->first();
        return $dat;
    }

    public function CrearCliente($data){

        Cliente::create([
            'nombre'=> $data['nombre'],
            'apellido'=> $data['apellido'],
            'cedula'=> $data['cedula'],
            'telefono'=> $data['telefono'],
        ]);

    }

    public function EditarCliente($data){
        
        $id = $data['id'];

        $Client = Cliente::where('cedula', $id)->first();

        $Client->nombre = $data['nombre'];
        $Client->apellido = $data['apellido'];
        $Client->cedula = $data['cedula'];
        $Client->telefono = $data['telefono'];
        $Client->save();

    }

    public function EliminarCliente($data){
        $id = $data['id'];

        $producto = Cliente::where('cedula', $id)->first();
        $producto->delete();
    }
}
