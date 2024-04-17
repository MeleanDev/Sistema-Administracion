<?php

namespace App\Http\Controllers;

use App\Models\RegistroActividad;
use App\RegistroActividadesClass;
use Illuminate\Http\Request;

class RegistroActividadesController extends Controller
{
    private $registro;

    public function __construct(RegistroActividadesClass $registro)
    {
        $this->registro = $registro;
    }

    public function index(Request $request){
        if ($request->ajax()) {
             $datos = RegistroActividad::all();
             return datatables()->of($datos)->toJson();
         }     
         return view('panelAdmin.RegistroActividades');
     }

    public function eliminar(Request $data){

        $seguro = $data['seguro'];
        if ($seguro == 1) {
            RegistroActividad::truncate();
            $this->registro->ActividadRegistro("Todos","Eliminar","Registro");

            $respuesta = response()->json(['success' => true]);
        }
        return $respuesta;
      }
}
