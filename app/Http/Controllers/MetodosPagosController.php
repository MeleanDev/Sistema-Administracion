<?php

namespace App\Http\Controllers;

use App\Models\MetodosPago;
use Illuminate\Http\Request;

class MetodosPagosController extends Controller
{

    public function index(){
        $datos = MetodosPago::all();
        return view('panelAdmin.metodospagos', compact('datos'));
    }

    public function crear(Request $request)
    {
        try {
            MetodosPago::create([
                "tipo"=> $request->tipo,
                "banco"=> $request->banco,      
            ]);

            return redirect()->route('MetodosPagos')->with('correctamente','Metodo de pago Agregado');
        } catch (\Throwable $th) {
            return redirect()->route('MetodosPagos')->with('incorrectamente','Metodo de pago No Agregado');
        }
    }

    public function editar(Request $dat, MetodosPago $id)
    {
        try {
            $id->update([
                "tipo"=> $dat->tipo,
                "banco"=> $dat->banco,   
            ]);

            return redirect()->route('MetodosPagos')->with('editado','Metodo de pago editado');
    
        } catch (\Throwable $th) {
            return redirect()->route('MetodosPagos')->with('noeditado','Metodo de pago no editado');
        }
    }

    public function eliminar($id){
        try {
            $metodo = MetodosPago::find($id); // Obtén el modelo del registro que deseas eliminar

            $metodo->delete(); // Elimina el registro de la base de datos

            return redirect()->route('MetodosPagos')->with('eliminado','Metodo de pago eliminado');
        } catch (\Throwable $th) {
            return redirect()->route('MetodosPagos')->with('noeliminado','Metodo de pago noeliminado');
        }
    }

}