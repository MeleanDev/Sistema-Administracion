<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
             $datos = Cliente::all();
             return datatables()->of($datos)->toJson();
         }     
         return view('panelAdmin.Clientes');
     }

     public function crear(Request $request){

        $data = $request->all();

        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $cedula = $data['cedula'];
        $telefono = $data['telefono'];

        Cliente::create([
            'nombre'=> $nombre,
            'apellido'=> $apellido,
            'cedula'=> $cedula,
            'telefono'=> $telefono,
        ]);

        $respuesta = response()->json(['success' => true]);
        return $respuesta;
     }

     public function editar(Request $request){

        $data = $request->all();
      
        $id = $data['id'];
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $cedula = $data['cedula'];
        $telefono = $data['telefono'];
      
        $Client = Cliente::where('cedula', $id)->first();
        $Client->nombre = $nombre;
        $Client->apellido = $apellido;
        $Client->cedula = $cedula;
        $Client->telefono = $telefono;
        $Client->save();
      
        $respuesta = response()->json(['success' => true]);
        return $respuesta;
      }

      public function eliminar(Request $request){
        $data = $request->all();
        
        $id = $data['id'];

        $producto = Cliente::where('cedula', $id)->first();
        $producto->delete();

        $respuesta = response()->json(['success' => true]);
        return $respuesta;
      }
}

