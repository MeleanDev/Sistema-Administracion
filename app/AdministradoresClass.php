<?php

namespace App;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdministradoresClass
{
    public function DatosAdministradores(){

        $data = User::all();
        return $data;
    }

    public function CrearAdmin($datos){
        User::create([
            "name"=> $datos->name,
            "email"=> $datos->email,  
            "password"=> Hash::make($datos->password)     
        ]);
    }

    public function EditarAdmin($datos, User $id){
        $id->update([
            "name"=> $datos->name,
            "email"=> $datos->email,  
            "password"=> Hash::make($datos->password)     
        ]);
    }

    public function Eliminar($id){
        $admin = User::find($id); // Obtén el modelo del registro que deseas elimina
        $admin->delete(); // Elimina el registro de la base de dato
    }
}
