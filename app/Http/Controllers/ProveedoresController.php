<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
             $datos = Proveedor::all();
             return datatables()->of($datos)->toJson();
         }     
         return view('panelAdmin.Proveedores');
     }

     public function crear(Request $request){

        $data = $request->all();

        $identificacion = $data['identificacion'];
        $nombre = $data['nombre'];
        $telefono = $data['telefono'];
        $correo = $data['correo'];
        $direccion = $data['direccion'];
        $descripcion = $data['descripcion'];

        Proveedor::create([
            'identificacion'=> $identificacion,
            'nombre'=> $nombre,
            'telefono'=> $telefono,
            'correo'=> $correo,
            'direccion'=> $direccion,
            'descripcion'=> $descripcion,
        ]);

        $respuesta = response()->json(['success' => true]);
        return $respuesta;
     }

     public function editar(Request $request){

        $data = $request->all();

        $id = $data['id'];
      
        $identificacion = $data['identificacion'];
        $nombre = $data['nombre'];
        $telefono = $data['telefono'];
        $correo = $data['correo'];
        $direccion = $data['direccion'];
        $descripcion = $data['descripcion'];
      
        $Proveedo = Proveedor::where('identificacion', $id)->first();
        $Proveedo->identificacion = $identificacion;
        $Proveedo->nombre = $nombre;
        $Proveedo->telefono = $telefono;
        $Proveedo->correo = $correo;
        $Proveedo->direccion = $direccion;
        $Proveedo->descripcion = $descripcion;
        $Proveedo->save();
      
        $respuesta = response()->json(['success' => true]);
        return $respuesta;
      }

      public function eliminar(Request $request){
        $data = $request->all();
        
        $id = $data['id'];

        $producto = Proveedor::where('identificacion', $id)->first();
        $producto->delete();

        $respuesta = response()->json(['success' => true]);
        return $respuesta;
      }
}

