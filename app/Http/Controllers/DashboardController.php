<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\MesCantidad;
use App\Models\Producto;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){

        $admins = User::count();
        $clientes = Cliente::count();
        $productos = Producto::count();

        $nombreMesActual = Carbon::now()->format('F');
        $actual = match ($nombreMesActual) {
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Obtubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        };      

        $datosMes = MesCantidad::where('mes', $actual)->first();
        
        return view('dashboard', compact('admins','clientes','productos', 'datosMes'));
    }
}
