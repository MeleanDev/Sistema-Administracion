<?php

namespace App\Http\Controllers;

use App\ProveedoresClass;
use App\RegistroActividadesClass;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    private $proveedores;
    private $registro;
    const OBJETO = "Proveedor"; // Define la variable constante OBJETO

    public function __construct(ProveedoresClass $proveedores, RegistroActividadesClass $registro)
    {
        $this->proveedores = $proveedores;
        $this->registro = $registro;
    }

    public function index(Request $request){
        if ($request->ajax()) {
             $datos = $this->proveedores->DatosProveedores();
             return datatables()->of($datos)->toJson();
         }     
         return view('panelAdmin.Proveedores');
     }

     public function crear(Request $data){
        try {
          $this->proveedores->CrearProveedor($data);
          $this->registro->ActividadRegistro($data['identificacion'], "Creo un", self::OBJETO);

          $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
          $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
     }

     public function editar(Request $data){
        try {
          $this->proveedores->EditarProveedor($data);
          $this->registro->ActividadRegistro($data['identificacion'], "Edito el", self::OBJETO);

          $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
          $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
      }

      public function eliminar(Request $data){
        try {
          $this->proveedores->EliminarProveedor($data);
          $this->registro->ActividadRegistro($data['id'], "Elimino un", self::OBJETO);

          $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
          $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
      }
}

