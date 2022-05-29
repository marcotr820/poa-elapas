@extends('layouts.plantillabase')

@section('contenido')
<style>
    table{
        font-size: 11px;
    }
    table tr td{
        border: 0.5px solid #b3b3b3;
        padding: 4px;
    }
</style>
    <div class="card">
        <div class="card-header">
            <strong>Accion corto plazo:</strong> {{$actividad->operacion->corto_plazo_accion->accion_corto_plazo}}
            <br>
            <strong>Operacion:</strong> {{$actividad->operacion->nombre_operacion}}
            <br>
            <strong>Actividad:</strong> {{$actividad->nombre_actividad}}
            <br>
            <a href="javascript:history.back()" class="boton red mt-2"><i class="fas fa-arrow-left"></i> Volver Atras</a>
        </div>
        <div class="card-body">
            <h5 class="card-title">Lista de tareas especificas</h5>
            <table width="100%">
                <thead style="background-color: skyblue; text-align: center;">
                    <tr>
                        <td width="5%">ID</td>
                        <td>TAREA ESPECIFICA</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($actividad->tareas_especificas as $tar)
                        <tr>
                            <td>{{$tar->id}}</td>
                            <td>{{$tar->nombre_tarea}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">No se encontraron registros.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
@endsection
