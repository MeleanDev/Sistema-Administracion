<?php

namespace App\Http\Controllers;

use App\ProductosCLass;
use App\RegistroActividadesClass;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    private $Productos;
    private $registro;
    const OBJETO = "Producto"; // Define la variable constante OBJETO

    public function __construct(ProductosCLass $Productos, RegistroActividadesClass $registro)
    {
        $this->Productos = $Productos;
        $this->registro = $registro;
    }
    public function index(Request $request){
        if ($request->ajax()) {
             $data = $this->Productos->DatosProducto();
             return datatables()->of($data)->toJson();
         }     
         return view('panelAdmin.productos');
     }

     public function crear(Request $data){
        try {
          $this->Productos->CrearProducto($data);
          $this->registro->ActividadRegistro($data['nombre'], "Creo un", self::OBJETO);
          $respuesta = response()->json(['success' => true]);
        } catch (\Throwable $th) {
          $respuesta = response()->json(['error' => true]); 
        }
        return $respuesta;
     }

     public function editar(Request $data){
      try {
        $this->Productos->EditarProducto($data);
        $this->registro->ActividadRegistro($data['nombre'], "Edito el", self::OBJETO);
        $respuesta = response()->json(['success' => true]);
      } catch (\Throwable $th) {
        $respuesta = response()->json(['error' => true]); 
      }
        return $respuesta;
      }

      public function eliminar(Request $data){
        try {
          $this->Productos->EliminarProducto($data);
          $this->registro->ActividadRegistro($data['id'], "Elimino un", self::OBJETO);
          $respuesta = response()->json(['success' => true]); 
        } catch (\Throwable $th) {
          $respuesta = response()->json(['error' => true]); 
        }
        return $respuesta;
      }
}
