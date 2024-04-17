<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $admins = User::count();
        $clientes = Cliente::count();
        $productos = Producto::count();
        
        return view('dashboard', compact('admins','clientes','productos'));
    }
}
