<?php

namespace App\Http\Controllers;

use App\Http\Requests\EvaluacionRequest;
use App\Models\CortoPlazoAcciones;
use App\Models\Evaluaciones;
use App\Models\Pilares;
use App\Models\Trabajadores;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function index(CortoPlazoAcciones $corto_plazo_accion)
    {
        // $fecha_actual = Carbon::now();
        $fecha_actual = Carbon::createFromDate("2022-04-01");

        $fecha_inicio = Carbon::createFromDate($corto_plazo_accion->fecha_inicio);
        $fecha_fin = Carbon::createFromDate($corto_plazo_accion->fecha_fin);

        if($corto_plazo_accion->planificacion()->exists()){//si se logra ingresar a evaluaciones y no se cuenta con una planificacion se devolvera valores vacios para no generar error
            // if($fecha_actual >= $fecha_inicio && $fecha_actual <= $fecha_fin){
                switch ($fecha_actual->month) {
                    case 4: case 5: case 6:
                        if($corto_plazo_accion->planificacion->primer_trimestre != 0){
                            $resultado_esperado = $corto_plazo_accion->planificacion->primer_trimestre;
                            $trimestre = "primer_trimestre";
                        }
                        else{ $resultado_esperado =""; $trimestre = ""; }
                        break;
                        
                    case 7: case 8: case 9:
                        if($corto_plazo_accion->planificacion->segundo_trimestre != 0){
                            $resultado_esperado = $corto_plazo_accion->planificacion->segundo_trimestre;
                            $trimestre = "segundo_trimestre";
                        }
                        else{ $resultado_esperado =""; $trimestre = ""; }
                        break;

                    case 10: case 11:
                        if($corto_plazo_accion->planificacion->tercer_trimestre != 0){
                            $resultado_esperado = $corto_plazo_accion->planificacion->tercer_trimestre;
                            $trimestre = "tercer_trimestre";
                        }
                        else{ $resultado_esperado =""; $trimestre = ""; }
                        break;
                    
                    case 12: 
                        if($corto_plazo_accion->planificacion->cuarto_trimestre != 0){
                            $resultado_esperado = $corto_plazo_accion->planificacion->cuarto_trimestre;
                            $trimestre = "cuarto_trimestre";
                        }
                        else{ $resultado_esperado =""; $trimestre = ""; }
                        break;

                    case 1:
                        if($fecha_fin->year < $fecha_actual->year)
                        {
                            if($corto_plazo_accion->planificacion->cuarto_trimestre != 0)
                            {
                                $resultado_esperado = $corto_plazo_accion->planificacion->cuarto_trimestre;
                                $trimestre = "cuarto_trimestre";
                            }
                            else{ $resultado_esperado =""; $trimestre = ""; }
                        }
                        else{ $resultado_esperado =""; $trimestre = ""; }
                        break;

                    default:
                        $resultado_esperado = "";
                        $trimestre = "";
                        break;
                }
            // }
            // else{ $resultado_esperado = ""; $trimestre = ""; }
        }
        else{ $resultado_esperado = ""; $trimestre = ""; }

        $presupuesto_restante = $corto_plazo_accion->presupuesto_programado - $corto_plazo_accion->evaluaciones->sum('presupuesto_ejecutado');

        return view('evaluaciones.index', compact('corto_plazo_accion', 'trimestre', 'resultado_esperado', 'presupuesto_restante'));
    }

    public function store(EvaluacionRequest $request, CortoPlazoAcciones $corto_plazo_accion)
    {
        // $fecha_actual = Carbon::now();
        $fecha_actual = Carbon::createFromDate("2022-04-01");
        switch ($fecha_actual->month) 
        {
            case 4: case 5: case 6:
                $resultado_esperado = $corto_plazo_accion->planificacion->primer_trimestre;
                $trimestre = "primer_trimestre";
                break;
                
            case 7: case 8: case 9:
                $resultado_esperado = $corto_plazo_accion->planificacion->segundo_trimestre;
                $trimestre = "segundo_trimestre";
                break;

            case 10: case 11:
                $resultado_esperado = $corto_plazo_accion->planificacion->tercer_trimestre;
                $trimestre = "tercer_trimestre";
                break;
            
            case 12:
                $resultado_esperado = $corto_plazo_accion->planificacion->cuarto_trimestre;
                $trimestre = "cuarto_trimestre";
                break;

            case 1:
                $resultado_esperado = $corto_plazo_accion->planificacion->cuarto_trimestre;
                $trimestre = "cuarto_trimestre";
                break;

            default:
                #code
                break;
        }
        $fecha_inicio = Carbon::parse($corto_plazo_accion->fecha_inicio);
        $fecha_now = Carbon::now();
        $fecha_fin = Carbon::parse($corto_plazo_accion->fecha_fin);
        $relacion_avance = round(($fecha_now->diffInDays($fecha_inicio) / ( $fecha_now->diffInDays($fecha_inicio) * $fecha_fin->diffInDays($fecha_now) ))*100, 2);
        if (!empty($trimestre)) {
            Evaluaciones::create([
                'resultado_esperado' => $resultado_esperado,
                'resultado_logrado' => $request->resultado_logrado,
                // si la variable trimestre es diferente de vacio entra y registra con el resultado esperado del trimestre actual
                'eficacia' => ($request->resultado_logrado / $corto_plazo_accion->planificacion->$trimestre )*100,
                'presupuesto' => $corto_plazo_accion->presupuesto_programado - $corto_plazo_accion->evaluaciones->sum('presupuesto_ejecutado'),
                'presupuesto_ejecutado' => $request->presupuesto_ejecutado,
                'ejecucion' => ($request->presupuesto_ejecutado / $corto_plazo_accion->presupuesto_programado) * 100,
                'relacion_avance' => $relacion_avance,
                'trimestre' => $trimestre,
                'corto_plazo_accion_id' => $corto_plazo_accion->id
            ]);
        }

    }

    public function get_evaluacion(Evaluaciones $evaluacion)
    {
        return $evaluacion;
    }

    public function update(EvaluacionRequest $request, Evaluaciones $evaluacion)
    {
        // $old_presupuesto_evaluacion = $evaluacion->presupuesto_ejecutado;
        // // presupuesto de la accion a corto plazo
        // $presupuesto_programado = $evaluacion->corto_plazo_accion->presupuesto_programado;
        // // suma de todos los presupuestos ejecutados de las evaluaciones menos el presupuesto de la accion que vamos a editar
        // $presupuesto_ejecutado = $evaluacion->corto_plazo_accion->evaluaciones->sum('presupuesto_ejecutado') - $old_presupuesto_evaluacion;
        // // presupuesto restante al momento de editar añadiendo el monto del registro que se esta editando para obtener el restante actual
        // $presupuesto_restante = $presupuesto_programado - $evaluacion->corto_plazo_accion->evaluaciones->sum('presupuesto_ejecutado') + $old_presupuesto_evaluacion;
        // if(($presupuesto_ejecutado + $request->presupuesto_ejecutado) > $presupuesto_programado){
        //     throw ValidationException::withMessages(['presupuesto_ejecutado' => "Su presupuesto restante es de $presupuesto_restante Bs."]);
        // }

        $fecha_inicio = Carbon::parse($evaluacion->corto_plazo_accion->fecha_inicio);
        $fecha_now = Carbon::now();
        $fecha_fin = Carbon::parse($evaluacion->corto_plazo_accion->fecha_fin);
        $relacion_avance = round(($fecha_now->diffInDays($fecha_inicio) / ( $fecha_now->diffInDays($fecha_inicio) * $fecha_fin->diffInDays($fecha_now) ))*100, 2);
        $evaluacion->update([
            'resultado_logrado' => $request->resultado_logrado,
            // volvemos a registrar la eficacia con el resultado esperado guardado en la columna de la evaluacion que vamos a editar
            'eficacia' => ($request->resultado_logrado / $evaluacion->resultado_esperado) * 100,
            'presupuesto' => $evaluacion->presupuesto,
            'presupuesto_ejecutado' => $request->presupuesto_ejecutado,
            'ejecucion' => ($request->presupuesto_ejecutado / $evaluacion->corto_plazo_accion->presupuesto_programado) * 100,
            'relacion_avance' => $relacion_avance,
        ]);
    }

    public function ver_evaluaciones(Trabajadores $trabajador)
    {
        $date = Carbon::now();
        $pilares = Pilares::select('gestion_pilar')->groupBy('gestion_pilar')->orderBy('gestion_pilar', 'ASC')->get();

        if ($pilares->count()) {
            // si existe un pilar para la gestion siguiente se buscara los pilares con la gestion siguiente, si no se mostrara los pilares de la ultima gestion creada
            if ($pilares->last()->gestion_pilar == $date->year) {
                $gestion = $date->year;
            }else{
                // mostramos los datos de un año antes del ultimo pilar encontrado
                // $gestion = Carbon::createFromDate($pilares->last()->gestion_pilar)->subYear()->year;    //funcion correcta
                $gestion = Carbon::createFromDate($pilares->last()->gestion_pilar)->year;    //funcion adelantando año
            }
        }

        if (isset($gestion)) {
            $corto_plazo_acciones = CortoPlazoAcciones::join('trabajadores', 'trabajadores.id', '=', 'corto_plazo_acciones.trabajador_id')
            ->join('unidades', 'unidades.id', '=', 'trabajadores.unidad_id')
            ->join('pei_objetivos_especificos', 'pei_objetivos_especificos.id', '=', 'corto_plazo_acciones.pei_objetivo_especifico_id')
            ->join('mediano_plazo_acciones', 'mediano_plazo_acciones.id', '=', 'pei_objetivos_especificos.mediano_plazo_accion_id')
            ->join('resultados', 'resultados.id', 'mediano_plazo_acciones.resultado_id')
            ->join('metas', 'metas.id', '=', 'resultados.meta_id')
            ->join('pilares', 'pilares.id', '=', 'metas.pilar_id')
            ->select('corto_plazo_acciones.*')
            ->where('pilares.gestion_pilar', $gestion)
            ->where('unidades.id', $trabajador->unidad->id)
            ->get();
        } else {
            $corto_plazo_acciones = [];
        }
        return view('evaluaciones.evaluaciones_trabajador', compact('trabajador', 'corto_plazo_acciones'));
    }

    public function acciones_corto_plazo_evaluacion()
    {
        abort_if(auth('usuario')->user()->trabajador->poa_evaluacion != 1, 403);

        $date = Carbon::now();
        $pilares = Pilares::select('gestion_pilar')->groupBy('gestion_pilar')->orderBy('gestion_pilar', 'ASC')->get();

        if ($pilares->count()) {
            // si existe un pilar para la gestion siguiente se buscara los pilares con la gestion siguiente, si no se mostrara los pilares de la ultima gestion creada
            if ($pilares->last()->gestion_pilar == $date->year) {
                $gestion = $date->year;
            }else{
                // mostramos los datos de un año antes del ultimo pilar encontrado
                // $gestion = Carbon::createFromDate($pilares->last()->gestion_pilar)->subYear()->year;     //funcion correcta
                $gestion = Carbon::createFromDate($pilares->last()->gestion_pilar)->year;        //funcion alterada adelantando año
            }
        }

        if (isset($gestion)){
            $corto_plazo_acciones = CortoPlazoAcciones::join('trabajadores', 'trabajadores.id', '=', 'corto_plazo_acciones.trabajador_id')
            ->join('unidades', 'unidades.id', '=', 'trabajadores.unidad_id')
            ->join('pei_objetivos_especificos', 'pei_objetivos_especificos.id', '=', 'corto_plazo_acciones.pei_objetivo_especifico_id')
            ->join('mediano_plazo_acciones', 'mediano_plazo_acciones.id', '=', 'pei_objetivos_especificos.mediano_plazo_accion_id')
            ->join('resultados', 'resultados.id', 'mediano_plazo_acciones.resultado_id')
            ->join('metas', 'metas.id', '=', 'resultados.meta_id')
            ->join('pilares', 'pilares.id', '=', 'metas.pilar_id')
            ->select('corto_plazo_acciones.*')
            ->where('pilares.gestion_pilar', $gestion)  //**************
            ->where('unidades.id', auth('usuario')->user()->trabajador->unidad->id)
            ->where('corto_plazo_acciones.status', 'aprobado')->get();
        } else {
            $corto_plazo_acciones = [];
        }
        return view('evaluaciones.accion_corto_plazo_evaluacion', compact('corto_plazo_acciones'));
    }
}