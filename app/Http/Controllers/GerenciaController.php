<?php

namespace App\Http\Controllers;

use App\Http\Requests\GerenciaRequest;
use App\Models\Gerencias;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class GerenciaController extends Controller
{
    public function index(Request $request){
        // return (string) Str::uuid().round(microtime(true) * 1000);
        // abort_if(!auth('usuario')->user()->can('super-admi'), 403, 'error');
        if($request->ajax())
        {
            $query = Gerencias::select('id', 'nombre_gerencia', 'uuid');
            return datatables($query)->make(true);
            // return datatables()
            //     ->eloquent(Gerencias::query()->select('id', 'nombre_gerencia', 'uuid'))
            //     ->toJson();
        }
        //$gerencias = Gerencias::all();
        return view('gerencias.index');
    }

    public function store(GerenciaRequest $request)
    {
        Gerencias::create([
            'nombre_gerencia' => Str::upper($request->nombre_gerencia),
        ]);
    }

    public function update(GerenciaRequest $request, Gerencias $gerencia)
    {
        $gerencia->update([
            'nombre_gerencia' => Str::upper($request->nombre_gerencia),
        ]);
    }

    public function destroy(Gerencias $gerencia)
    {
        $gerencia->delete();
    }
}
