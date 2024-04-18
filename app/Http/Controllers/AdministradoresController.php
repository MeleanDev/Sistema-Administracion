<?php

namespace App\Http\Controllers;

use App\AdministradoresClass;
use App\Models\User;
use App\RegistroActividadesClass;
use Illuminate\Http\Request;

class AdministradoresController extends Controller
{
    private $administradores;
    private $registro;
    const OBJETO = "Administrador"; // Define la variable constante OBJETO

    public function __construct(AdministradoresClass $administradores, RegistroActividadesClass $registro)
    {
        $this->administradores = $administradores;
        $this->registro = $registro;
    }

    public function index(){
        $datos = $this->administradores->DatosAdministradores();
        return view('panelAdmin.administradores', compact('datos'));
    }

    public function crear(Request $data)
    {
        try {
            $this->administradores->CrearAdmin($data);
            $this->registro->ActividadRegistro($data->name, "Creo un", self::OBJETO);
            return redirect()->route('Administradores')->with('correctamente','Usuario Admin Agregado');
        } catch (\Throwable $th) {
            return redirect()->route('Administradores')->with('incorrectamente','Usuario Admin No Agregado');
        }
    }

    public function editar(Request $datos, User $id)
    {
        try {
            $this->administradores->EditarAdmin($datos,$id);
            $this->registro->ActividadRegistro($id->name, "Edito un", self::OBJETO);
            return redirect()->route('Administradores')->with('editado','Usuario Admin editado');
    
        } catch (\Throwable $th) {
            return redirect()->route('Administradores')->with('noeditado','Usuario Admin no editado');
        }
    }

    public function eliminar($id){
        try {
            $admin = User::find($id);
            $this->registro->ActividadRegistro($admin->name, "Elimino un", self::OBJETO);
            $this->administradores->Eliminar($id);
            return redirect()->route('Administradores')->with('eliminado','Usuario Admin eliminado');
        } catch (\Throwable $th) {
            return redirect()->route('Administradores')->with('noeliminado','Usuario Admin noeliminado');
        }
    }

}
