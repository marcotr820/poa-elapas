@extends('layouts.plantillabase')

@section('contenido')
<style>
    table{
        font-size: 10px;
    }
    table thead{
        text-align: center;
    }
    table tr td{
        border: 0.5px solid #b3b3b3;
        padding: 3px;
    }
    table .boton{
        padding: 2px 7px;
        font-size: 10px;
    }
</style>
    <div class="card">
        <div class="card-header">
            <div>
                <strong>Accion Corto Plazo:</strong> {{$accion_corto_plazo->accion_corto_plazo}}
                <br>
                <a href="{{ route('poa.ver_poas') }}" class="boton red mt-2"><i class="fas fa-arrow-left"></i> Volver Atras</a>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">Lista Actividades</h5>
            <table width="100%">
                <thead style="background-color: skyblue">
                    <tr>
                        <td>OPERACION</td>
                        <td>ACTIVIDAD</td>
                        <td>RESULTADO ESPERADO</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accion_corto_plazo->operaciones as $op)
                        <tr>
                            <td
                            <?php $row_op = 0;
                            if($op->actividades->count() >= 1){ $row_op += $op->actividades->count(); }
                            echo $row_op > 1? 'rowspan="'.$row_op.'"' : '';
                            ?>
                            >{{$op->nombre_operacion}}</td>
                            @forelse ($op->actividades as $act)
                                @if ($loop->first)
                                    <?php $var_op = $op; ?>
                                    <td>{{$act->nombre_actividad}}</td>
                                    <td>{{$act->resultado_esperado}}</td>
                                    <td width="7%" style="text-align: center;">
                                        <div class="x-dropdown">
                                            <button class="x-dropdown-button boton default">Ver mas</button>
                                            <ul class="x-dropdown-menu menu-right">
                                                <li>
                                                    <a href="{{ route('tareas_especificas_actividad.index', $act->uuid) }}">Tareas especificas</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('items_actividad.index', $act->uuid) }}">Items servicios</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                @endif
                            @empty
                                <td></td>
                                <td></td>
                                <td></td>
                            @endforelse
                        </tr>

                        @if (isset($var_op))
                            @foreach ($var_op->actividades as $act)
                                @if (!$loop->first)
                                    <tr>
                                        <td>{{$act->nombre_actividad}}</td>
                                        <td>{{$act->resultado_esperado}}</td>
                                        <td width="7%" style="text-align: center;">
                                            <div class="x-dropdown">
                                                <button class="x-dropdown-button boton default">Ver mas</button>
                                                <ul class="x-dropdown-menu menu-right">
                                                    <li>
                                                        <a href="{{ route('tareas_especificas_actividad.index', $act->uuid) }}">Tareas especificas</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('items_actividad.index', $act->uuid) }}">Items servicios</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <?php unset($var_op) ?>
                        @endif
                    @empty
                        <tr>
                            <td colspan="4">No se encontraron resultados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
@endsection
