@extends('layouts.plantillabase')

@section('title', 'Reporte Ítems / Servicios')

@section('contenido')
<style>
    table{
        font-size: 11px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-weight: 600;
        text-align: center;
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
            <h5 class="card-title">Lista de Items ó Servicios</h5>
            <table width="100%">
                <thead style="background-color: skyblue">
                    <tr>
                        <td>ID</td>
                        <td>ITEM SERVICIO</td>
                        <td>FECHA REQUERIDA</td>
                        <td>PARTIDA</td>
                        <td>PRESUPUESTO</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($actividad->items as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->bien_servicio}}</td>
                            <td>{{$item->fecha_requerida}}</td>
                            <td>{{$item->partida->nombre_partida}}</td>
                            <td>{{number_format($item->presupuesto, 2, '.', ',')}} Bs.</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No se encontraron resultados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
@endsection
