@extends('layouts.plantillabase')

@section('title', 'Reporte Por Gestión Partida')

@section('contenido')
<div class="card text-center">
    <h5 class="card-header bg-dark text-white">Generar Reporte POA Por Grupo Partida</h5>
    <div class="card-body border border-dark">
        <form action="{{ route('pdf_partidas_grupo') }}" target="_blank">
            @csrf @method('get')
            <div class="form-group row d-flex justify-content-center">
                <div class="col-xs-2">
                    <label>Seleccione la Gestión.</label>
                    <select class="form-control" name="gestion" required>
                        <option value="">__Seleccione__</option>
                        @foreach ($gestiones as $gestion)
                            <option value="{{ $gestion->gestion_pilar }}">{{ $gestion->gestion_pilar }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="boton blue">Enviar</button>
        </form>
    </div>
</div>
@endsection

@section('js')
@endsection