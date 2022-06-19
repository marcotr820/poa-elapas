<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartidaRequest;
use App\Models\Partidas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    public function __construct(){
        // solo los usuarios con los permisos especificados podran ingresar a los metodos
        $this->middleware(['permission:VER-DIRECTRIZ|edit-articles']);
    }

    public function index(Request $request)
    {
        // $array = [];
        // $partidas = Partidas::get();
        // $i = 0;
        // $last_id = $partidas->last()->id; 
        // foreach ($partidas as $p) {
        //     if( $i != substr($p->codigo_partida, 0,1) )
        //     {
        //         if (isset($grupo)) {
        //             array_push($array, $grupo);
        //         }
        //         $grupo = [];
        //         $i++;
        //     }

        //     if( $i == substr($p->codigo_partida, 0,1) ){
        //         array_push($grupo, $p);
        //     }

        //     if( $p->id == $last_id ){
        //         array_push($array, $grupo);
        //     }
        // }
        // // return $array[0][0]->items->sum('presupuesto');
        // return $array;
        
        // return Str::random(23).round(microtime(true) * 1000);
        if($request->ajax())
        {
            $query = Partidas::select('id', 'codigo_partida', 'nombre_partida', 'tipo_partida', 'uuid')->orderBy('id');
            return datatables($query)->make(true);
            // return datatables()
            //     ->eloquent(Partidas::query())
            //     ->toJson();
        }
        return view('partidas.index');
    }

    public function store(PartidaRequest $request)
    {
        Partidas::create([
            'nombre_partida' => Str::upper($request->nombre_partida),
            'codigo_partida' => $request->codigo_partida,
            'tipo_partida' => Str::upper($request->tipo_partida)
        ]);
    }
    public function update(PartidaRequest $request, Partidas $partida)
    {
        $partida->update([
            'nombre_partida' => Str::upper($request->nombre_partida),
            'codigo_partida' => $request->codigo_partida,
            'tipo_partida' => Str::upper($request->tipo_partida)
        ]);
    }

    public function destroy(Partidas $partida)
    {
        $partida->delete();
    }
}
