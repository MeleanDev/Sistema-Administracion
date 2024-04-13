<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministradoresController extends Controller
{
    public function index(){
        return view('panelAdmin.administradores');
    }
}
