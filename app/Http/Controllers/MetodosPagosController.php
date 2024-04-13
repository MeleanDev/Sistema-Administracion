<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MetodosPagosController extends Controller
{
    public function index(){
        return view('panelAdmin.metodospagos');
    }
}
