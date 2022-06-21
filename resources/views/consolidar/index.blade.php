@extends('layouts.plantillabase')

@section('title', 'Consolidar')

@section('contenido')
    <div class="card">
        <h5 class="card-header">Consolidar POA</h5>
        <div class="card-body">
            <form action="{{ route('pdf.consolidar') }}" autocomplete="off">
                @csrf   @method('GET')
                <div class="form-group">
                    <div class="row">
                        <div class="col-9">
                            <label for="exampleInputPassword1">Password</label>
                            <select class="form-control" name="gerencia">
                                <option value="">__Seleccione__</option>
                                @foreach ($gerencias as $g)
                                    <option value="{{ $g->uuid }}">{{ $g->nombre_gerencia }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="exampleInputPassword1">Password</label>
                            <select class="form-control" name="gestion">
                                <option value="">__Seleccione__</option>
                                @foreach ($pilar_gestion as $p)
                                    <option value="{{ $p->gestion_pilar }}">{{ $p->gestion_pilar }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="boton blue">Enviar</button>
            </form>
        </div>
    </div>
@endsection

@section('js')

@endsection
