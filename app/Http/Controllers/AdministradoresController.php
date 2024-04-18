<?php

namespace App\Http\Controllers;

use App\AdministradoresClass;
use App\Models\User;
use Illuminate\Http\Request;

class AdministradoresController extends Controller
{
    private $administradores;

    public function __construct(AdministradoresClass $administradores)
    {
        $this->administradores = $administradores;
    }

    public function index(){
        $datos = $this->administradores->DatosAdministradores();
        return view('panelAdmin.administradores', compact('datos'));
    }

    public function crear(Request $data)
    {
        try {
            $this->administradores->CrearAdmin($data);
            return redirect()->route('Administradores')->with('correctamente','Usuario Admin Agregado');
        } catch (\Throwable $th) {
            return redirect()->route('Administradores')->with('incorrectamente','Usuario Admin No Agregado');
        }
    }

    public function editar(Request $datos, User $id)
    {
        try {
            $this->administradores->EditarAdmin($datos,$id);
            return redirect()->route('Administradores')->with('editado','Usuario Admin editado');
    
        } catch (\Throwable $th) {
            return redirect()->route('Administradores')->with('noeditado','Usuario Admin no editado');
        }
    }

    public function eliminar($id){
        try {
            $this->administradores->Eliminar($id);
            return redirect()->route('Administradores')->with('eliminado','Usuario Admin eliminado');
        } catch (\Throwable $th) {
            return redirect()->route('Administradores')->with('noeliminado','Usuario Admin noeliminado');
        }
    }

}
