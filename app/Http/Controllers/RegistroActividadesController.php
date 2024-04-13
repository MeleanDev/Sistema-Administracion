<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroActividadesController extends Controller
{
    public function index(){
        return view('panelAdmin.registroActividades');
    }
}
