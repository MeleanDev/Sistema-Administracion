<?php

namespace App\Http\Controllers;

use App\MetodoPagosClass;
use App\Models\MetodosPago;
use Illuminate\Http\Request;

class MetodosPagosController extends Controller
{
    private $Metodopago;

    public function __construct(MetodoPagosClass $Metodopago)
    {
        $this->Metodopago = $Metodopago;
    }

    public function index(){
        $datos = $this->Metodopago->DatosMetodos();
        return view('panelAdmin.metodospagos', compact('datos'));
    }

    public function crear(Request $data)
    {
        try {
            $this->Metodopago->CrearMetodosPago($data);
            return redirect()->route('MetodosPagos')->with('correctamente','Metodo de pago Agregado');
        } catch (\Throwable $th) {
            return redirect()->route('MetodosPagos')->with('incorrectamente','Metodo de pago No Agregado');
        }
    }

    public function editar(Request $dat, MetodosPago $id)
    {
        try {
            $this->Metodopago->EditarMetodosPago($dat,$id);
            return redirect()->route('MetodosPagos')->with('editado','Metodo de pago editado');
    
        } catch (\Throwable $th) {
            return redirect()->route('MetodosPagos')->with('noeditado','Metodo de pago no editado');
        }
    }

    public function eliminar($id){
        try {
            $this->Metodopago->EliminarMetodosPago($id);
            return redirect()->route('MetodosPagos')->with('eliminado','Metodo de pago eliminado');
        } catch (\Throwable $th) {
            return redirect()->route('MetodosPagos')->with('noeliminado','Metodo de pago noeliminado');
        }
    }

}