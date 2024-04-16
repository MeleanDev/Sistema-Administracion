<?php

namespace App\Http\Controllers;

use App\Models\RegistroActividad;
use Illuminate\Http\Request;

class RegistroActividadesController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
             $datos = RegistroActividad::all();
             return datatables()->of($datos)->toJson();
         }     
         return view('panelAdmin.RegistroActividades');
     }

    public function eliminar(Request $request){
        $data = $request->all();
        $seguro = $data['seguro'];

        if ($seguro == 1) {
            RegistroActividad::truncate();
            $respuesta = response()->json(['success' => true]);
        }
        return $respuesta;
      }
}
