@extends('layouts.plantillabase')

@section('title', 'Ver Evaluación Trabajador')

@section('contenido')
<style>
    .table-evaluaciones td{
        padding: 5px;
        border: 0.5px solid #999999;
    }
</style>
    <div class="card">
        <div class="card-header">
            <p class="mb-2"><strong>Gerencia:</strong> {{ $trabajador->unidad->gerencia->nombre_gerencia }}</p>
            <p class="mb-2"><strong>Unidad:</strong> {{ $trabajador->unidad->nombre_unidad }}</p>
            <p class="mb-2"><strong>Trabajador Encargado:</strong> {{ $trabajador->nombre }} </p>
            <a href="{{ route('estados_trabajadores.index') }}" class="boton red"><i class="fas fa-arrow-left"></i> Volver atras</a>
        </div>
        <div class="card-body">
            <h5 class="card-title">Lista Evaluaciones</h5>
            @if ($trabajador->corto_plazo_acciones->count())
                <table class="table table-striped" id="table" width="100%">
                    <thead hidden>
                        <tr><td></td></tr>
                    </thead>
                    <tbody>
                        @foreach ($corto_plazo_acciones as $corto_plazo_accion)
                        <tr>
                            <td class="pb-4">
                                <div class="card border border-dark">
                                    <h6 class="card-header" style="background: linear-gradient(to right, #66b3ff, #cce6ff); ">
                                    <strong>Accion Corto Plazo:</strong> {{ $corto_plazo_accion->accion_corto_plazo }}
                                    </h6>
                                    <div class="card-body py-2">
                                        <p class="card-text mb-2">
                                            <span class="mr-5">
                                                <strong>Fecha Inicio:</strong> {{ $corto_plazo_accion->fecha_inicio }}
                                            </span>
                                            <span>
                                                <strong>Fecha Fin:</strong> {{ $corto_plazo_accion->fecha_fin }}
                                            </span>
                                        </p>
                                        <div class="container overflow-hidden p-0">
                                            @if ($corto_plazo_accion->evaluaciones->count())
                                                <table class="table-evaluaciones" width="100%">
                                                    <thead class="thead" style="background-color: #cce6ff">
                                                        <tr>
                                                            <td rowspan="2" style="text-align: center;" width="13%">Trimestre</td>
                                                            <td colspan="3" class="text-center">RESULTADOS</td>
                                                            <td colspan="3" class="text-center">PRESUPUESTO</td>
                                                            <td>RELACION AVANCE</td>
                                                            <tr>
                                                                <td>Esperados</td>
                                                                <td>Logrados</td>
                                                                <td>Eficacia %</td>
                                                                <td>Presupuesto</td>
                                                                <td>Ejecutado</td>
                                                                <td>Ejecucion %</td>
                                                                <td>Avance %</td>
                                                            </tr>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($corto_plazo_accion->evaluaciones as $evaluacion)
                                                            <tr>
                                                                <td>{{ ucfirst( str_replace("_", " ", $evaluacion->trimestre) ) }}</td>
                                                                <td>{{ $evaluacion->resultado_esperado }} %</td>
                                                                <td>{{ $evaluacion->resultado_logrado }} %</td>
                                                                <td>{{ $evaluacion->eficacia }} %</td>
                                                                <td>{{ number_format($evaluacion->presupuesto, 2, '.', ',') }} Bs.</td>
                                                                <td>{{ number_format($evaluacion->presupuesto_ejecutado, 2, '.', ',') }} Bs.</td>
                                                                <td>{{ $evaluacion->ejecucion }} %</td>
                                                                <td>{{ $evaluacion->relacion_avance }} %</td>
                                                            </tr>
                                                            @if ($loop->last)
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="text-center"><b>Total:</b></td>
                                                                    <td>{{ number_format($corto_plazo_accion->evaluaciones->sum('presupuesto_ejecutado'), 2, '.', ',') }} Bs.</td>
                                                                    <td>{{ $corto_plazo_accion->evaluaciones->sum('ejecucion') }} %</td>
                                                                    <td></td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <div class="bg-light p-2 rounded text-muted">No se encontraron evaluaciones</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="bg-light p-3 rounded text-muted">No se encontraron registros.</div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "lengthMenu": [4, 8, 15, 30],
                "language": {
                    "url" : "{{ asset('libs/datatables/es-ES.json') }}"
                }
            });
        } );
    </script>
@endsection
