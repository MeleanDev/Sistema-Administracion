<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index(){
    $empresa = Empresa::first();

    return view('panelAdmin.empresa', [
        'empresa' => $empresa, // Pass the entire 'Empresa' model instance to the view
    ]);
}

    public function editar(Request $datos){
        Empresa::truncate();
        Empresa::Create($datos->all());
        return redirect()->route('Empresa')->with('correctamente', 'Datos de la empresa rellenados');
    }
}
