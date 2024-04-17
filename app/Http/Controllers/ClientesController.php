<?php

namespace App\Http\Controllers;

use App\ClientesClass;
use App\RegistroActividadesClass;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    private $Clientes;
    private $registro;
    const OBJETO = "Cliente"; // Define la variable constante OBJETO

    public function __construct(ClientesClass $Clientes, RegistroActividadesClass $registro)
    {
        $this->Clientes = $Clientes;
        $this->registro = $registro;
    }

    public function index(Request $request){
        if ($request->ajax()) {
             $datos = $this->Clientes->DatosClientes();
             return datatables()->of($datos)->toJson();
         }     
         return view('panelAdmin.Clientes');
     }

     public function crear(Request $data){
      try {
          $this->Clientes->CrearCliente($data);
          $this->registro->ActividadRegistro($data['cedula'], "Creo un", self::OBJETO);
        $respuesta = response()->json(['success' => true]);
      } catch (\Throwable $th) {
        $respuesta = response()->json(['error' => true]);
      }
        return $respuesta;
     }

     public function editar(Request $data){
      
        try {
          $this->Clientes->EditarCliente($data);
          $this->registro->ActividadRegistro($data['cedula'], "Edito un", self::OBJETO);
          $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
          $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
      }

      public function eliminar(Request $data){
        try {
          $this->Clientes->EliminarCliente($data);
          $this->registro->ActividadRegistro($data['id'], "Elimino un", self::OBJETO);
          $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
          $respuesta = response()->json(['error' => true]);
        }
        return $respuesta;
      }
}

