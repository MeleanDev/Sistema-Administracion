<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministradoresController extends Controller
{
    public function index(){
        $datos = User::all();
        return view('panelAdmin.administradores', compact('datos'));
    }

    public function crear(Request $request)
    {
        try {
            user::create([
                "name"=> $request->name,
                "email"=> $request->email,  
                "password"=> Hash::make($request->password)     
            ]);

            return redirect()->route('Administradores')->with('correctamente','Usuario Admin Agregado');
        } catch (\Throwable $th) {
            return redirect()->route('Administradores')->with('incorrectamente','Usuario Admin No Agregado');
        }
    }

    public function editar(Request $dat, user $id)
    {
        try {
            $id->update([
                "name"=> $dat->name,
                "email"=> $dat->email,  
                "password"=> Hash::make($dat->password)     
            ]);

            return redirect()->route('Administradores')->with('editado','Usuario Admin editado');
    
        } catch (\Throwable $th) {
            return redirect()->route('Administradores')->with('noeditado','Usuario Admin no editado');
        }
    }

    public function eliminar($id){
        try {
            $usuario = user::find($id); // Obtén el modelo del registro que deseas eliminar

            $usuario->delete(); // Elimina el registro de la base de datos

            return redirect()->route('Administradores')->with('eliminado','Usuario Admin eliminado');
        } catch (\Throwable $th) {
            return redirect()->route('Administradores')->with('noeliminado','Usuario Admin noeliminado');
        }
    }

}
