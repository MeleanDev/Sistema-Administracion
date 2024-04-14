<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
             $datos = Producto::all();
             return datatables()->of($datos)->toJson();
         }     
         return view('panelAdmin.productos');
     }

     public function crear(Request $request){

        $data = $request->all();

        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $proveedor = $data['proveedor'];
        $cantidad = $data['cantidad'];
        $precio = $data['precio'];

        Producto::create([
            'nombre'=> $nombre,
            'descripcion'=> $descripcion,
            'proveedor'=> $proveedor,
            'cantidad'=> $cantidad,
            'precio'=> $precio,
        ]);

        $respuesta = response()->json(['success' => true]);
        return $respuesta;
     }

     public function editar(Request $request){

        $data = $request->all();
      
        $id = $data['id'];
        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $proveedor = $data['proveedor'];
        $cantidad = $data['cantidad'];
        $precio = $data['precio'];
      
        $proveed = Producto::where('nombre', $id)->first();
        $proveed->nombre = $nombre;
        $proveed->descripcion = $descripcion;
        $proveed->proveedor = $proveedor;
        $proveed->cantidad = $cantidad;
        $proveed->precio = $precio;
        $proveed->save();
      
        $respuesta = response()->json(['success' => true]);
        return $respuesta;
      }

      public function eliminar(Request $request){
        $data = $request->all();
        
        $id = $data['id'];

        $producto = Producto::where('nombre', $id)->first();
        $producto->delete();

        $respuesta = response()->json(['success' => true]);
        return $respuesta;
      }
}
