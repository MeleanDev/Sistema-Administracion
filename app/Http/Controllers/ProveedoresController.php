<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    public function index(){
        return view('panelAdmin.proveedores');
    }
}
