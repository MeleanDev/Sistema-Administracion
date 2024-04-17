<?php

namespace App;

use App\Models\RegistroActividad;

class RegistroActividadesClass
{
    public function ActividadRegistro($valor, $accion, $objeto){
        
        $admin = auth()->user()->name;
        $fecha = auth()->user()->name = now();

        RegistroActividad::create([
            "usuario"=> $admin,
            "accion"=>$accion." ".$objeto." : ".$valor,
            "last_login"=> $fecha,
        ]);
    }
}
