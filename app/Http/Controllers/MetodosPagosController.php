<?php

namespace App\Http\Controllers;

use App\MetodoPagosClass;
use App\Models\MetodosPago;
use App\RegistroActividadesClass;
use Illuminate\Http\Request;

class MetodosPagosController extends Controller
{
    private $Metodopago;
    private $registro;
    const OBJETO = "Metodo de pago"; // Define la variable constante OBJETO

    public function __construct(MetodoPagosClass $Metodopago, RegistroActividadesClass $registro)
    {
        $this->Metodopago = $Metodopago;
        $this->registro = $registro;
    }

    public function index(){
        $datos = $this->Metodopago->DatosMetodos();
        return view('panelAdmin.metodospagos', compact('datos'));
    }

    public function crear(Request $data)
    {
        try {
            $this->Metodopago->CrearMetodosPago($data);
            $this->registro->ActividadRegistro($data->tipo." Con ".$data->banco, "Creo un", self::OBJETO);
            return redirect()->route('MetodosPagos')->with('correctamente','Metodo de pago Agregado');
        } catch (\Throwable $th) {
            return redirect()->route('MetodosPagos')->with('incorrectamente','Metodo de pago No Agregado');
        }
    }

    public function editar(Request $data, MetodosPago $id)
    {
        try {
            $this->Metodopago->EditarMetodosPago($data,$id);
            $this->registro->ActividadRegistro($data->tipo." Con ".$data->banco, "Edito un", self::OBJETO);
            return redirect()->route('MetodosPagos')->with('editado','Metodo de pago editado');
    
        } catch (\Throwable $th) {
            return redirect()->route('MetodosPagos')->with('noeditado','Metodo de pago no editado');
        }
    }

    public function eliminar($id){
        try {
            $admin = MetodosPago::find($id);
            $this->registro->ActividadRegistro($admin->tipo." Con ".$admin->banco, "Edito un", self::OBJETO);
            $this->Metodopago->EliminarMetodosPago($id);
            return redirect()->route('MetodosPagos')->with('eliminado','Metodo de pago eliminado');
        } catch (\Throwable $th) {
            return redirect()->route('MetodosPagos')->with('noeliminado','Metodo de pago noeliminado');
        }
    }

}