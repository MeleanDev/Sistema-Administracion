<?php

namespace App;

use App\Models\MetodosPago;

class MetodoPagosClass
{
    public function DatosMetodos(){
        $data = MetodosPago::all();
        return $data;
    }

    public function CrearMetodosPago($datos){
        MetodosPago::create([
            "tipo"=> $datos->tipo,
            "banco"=> $datos->banco,      
        ]);
    }

    public function EditarMetodosPago($datos, MetodosPago $id){
        $id->update([
            "tipo"=> $datos->tipo,
            "banco"=> $datos->banco,   
        ]);
    }

    public function EliminarMetodosPago($id){
        $admin = MetodosPago::find($id); // Obtén el modelo del registro que deseas elimina
        $admin->delete(); // Elimina el registro de la base de dato
    }
}
