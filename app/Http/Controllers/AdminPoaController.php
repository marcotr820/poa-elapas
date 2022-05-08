<?php

namespace App\Http\Controllers;

use App\Models\CortoPlazoAcciones;
use App\Models\PeiObjetivosEspecificos;
use App\Models\Pilares;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminPoaController extends Controller
{
    // obtenemos los datos del pei para poder mostrarlos en los campos div en la tabla "objetivo especifico", "gerencia"
    public function data_pei(PeiObjetivosEspecificos $pei){
        $query = PeiObjetivosEspecificos::join('gerencias', 'gerencias.id', '=', 'pei_objetivos_especificos.gerencia_id')
            ->select('gerencias.nombre_gerencia', 'pei_objetivos_especificos.objetivo_institucional')
            ->where('pei_objetivos_especificos.id', $pei->id)
            ->first();
        return $query;
    }
    
    public function listar_acciones(Request $request, PeiObjetivosEspecificos $pei){
        if($request->ajax()){
            $acciones = CortoPlazoAcciones::where('pei_objetivo_especifico_id', $pei->id);
            return datatables()
                ->eloquent($acciones)
                ->toJson();
        }
    }

    public function status_accion_corto_plazo(CortoPlazoAcciones $corto_plazo_accion){
        return CortoPlazoAcciones::select('accion_corto_plazo', 'presupuesto_programado', 'status')->where('id', $corto_plazo_accion->id)->first();
    }

    public function index()
    {
        $date = Carbon::now()->addYear();
        $pilares = Pilares::select('gestion_pilar')
            ->groupBy('gestion_pilar')
            ->orderBy('gestion_pilar', 'ASC')
            ->get();

        if ($pilares->count()) {
            // si existe un pilar para la gestion siguiente se buscara los pilares con la gestion siguiente, si no se mostrara los pilares de la ultima gestion creada
            if ($pilares->last()->gestion_pilar == $date->year) {
                $gestion = $date->year;
            }else{
                $gestion = $pilares->last()->gestion_pilar;
            }
        }
        
        $objetivos_especificos = PeiObjetivosEspecificos::join('gerencias', 'gerencias.id', '=', 'pei_objetivos_especificos.gerencia_id')
            ->join('mediano_plazo_acciones', 'mediano_plazo_acciones.id', '=', 'pei_objetivos_especificos.mediano_plazo_accion_id')
            ->join('resultados', 'resultados.id', '=', 'mediano_plazo_acciones.resultado_id')
            ->join('metas', 'metas.id', '=', 'resultados.meta_id')
            ->join('pilares', 'pilares.id', '=', 'metas.pilar_id')
            ->select('pei_objetivos_especificos.*', 'gerencias.nombre_gerencia')
            ->where('pilares.gestion_pilar', $gestion)
            ->withCount('corto_plazo_acciones')->get();
        return view('admin_poa.index', compact('objetivos_especificos'));
    }

    public function update_status_corto_plazo_accion(Request $request, CortoPlazoAcciones $corto_plazo_accion)
    {
        // return $request->all();
        $corto_plazo_accion->update([
            'status' => $request->status,
        ]);
    }
}
