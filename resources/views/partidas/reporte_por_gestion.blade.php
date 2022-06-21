@extends('layouts.plantillabase')

@section('title', 'Reporte Por Gestión Partida')

@section('contenido')
    <div class="card">
        <h5 class="card-header">Generar Reporte Por Grupo Partida</h5>
        <div class="card-body">
            <h5 class="card-title">Por Favor Selecciona Una Gestión</h5>
            <form action="{{ route('pdf_partidas_grupo') }}">
                @csrf   @method('GET')
                <div class="form-group col-3 p-0">
                    <select class="form-control" name="gestion">
                      @foreach ($gestiones as $gestion)
                          <option value="{{ $gestion->gestion_pilar }}">{{ $gestion->gestion_pilar }}</option>
                      @endforeach
                    </select>
                    <button type="submit" class="boton blue mt-2">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
