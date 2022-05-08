<?php

namespace App\Http\Controllers;

use App\Models\CortoPlazoAcciones;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function CountStatusAccionesCorto()
    {
        return CortoPlazoAcciones::where('status', 'presentado')->count();
    }

    public function pruebas()
    {
        return view('pruebas');
    }
}
