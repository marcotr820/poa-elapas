@extends('layouts.plantillabase')

@section('title', 'Lista Acciones Evaluación')

@section('contenido')
    <style>
        table{
            font-size: 13px;
        }
    </style>
    <div class="card">
        <h5 class="card-header">Evaluar Acciones Corto Plazo</h5>
        <div class="card-body">
            <table class="table table-striped" id="table">
                <thead class="" style="background-color: skyblue">
                    <tr>
                        <th scope="col">ACCION CORTO PLAZO</th>
                        <th scope="col">FECHA INICIO</th>
                        <th scope="col">FECHA FIN</th>
                        <th scope="col">EVALUAR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($corto_plazo_acciones as $cpa)
                        <tr>
                            <td>{{ $cpa->accion_corto_plazo }}</td>
                            <td>{{ $cpa->fecha_inicio }}</td>
                            <td>{{ $cpa->fecha_fin }}</td>
                            {{-- @if ( (\Carbon\Carbon::now()->year) == (\Carbon\Carbon::createFromDate($cpa->fecha_inicio)->year)) --}}
                            @if ( 2023 == (\Carbon\Carbon::createFromDate($cpa->fecha_inicio)->year))
                                <td>
                                    <a href="{{ route('evaluacion.index', $cpa->uuid) }}" class="boton default">Evaluar</a>
                                </td>
                            @else
                                <td></td>
                            @endif
                            {{-- @if ( (\Carbon\Carbon::now() > \Carbon\Carbon::createFromDate($cpa->fecha_inicio)) &&
                                (\Carbon\Carbon::now() < \Carbon\Carbon::createFromDate($cpa->fecha_fin)) )
                                <td> <a href="{{ route('evaluacion.index', $cpa->uuid) }}" class="boton default">Evaluar</a> </td>
                            @else
                                <td></td>
                            @endif --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                "language": {
                    "url": "{{ asset('libs/datatables/es-ES.json') }}"
                }
            });
        });
    </script>
@endsection
