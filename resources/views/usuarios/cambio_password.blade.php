@extends('layouts.plantillabase')
@section('contenido')
    <div class="card border-dark" style="width: 35rem;">
        <div class="card-header border-dark">Cambio de Contraseña</div>
        <div class="card-body text-dark">
          <h5 class="card-title">Usuario: {{$usuario->usuario}}</h5>
          <h5 class="card-title">Trabajador: {{$usuario->trabajador->nombre}}</h5>
          <form id="form" method="post" action="{{route('update.password', $usuario)}}" class="mt-4">
            @csrf
            @method ('PUT')
            <div class="form-group">
                <label for="exampleInputEmail1">Nueva Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" data-error="input" autocomplete="off">
                {{-- <span class="text-danger" id="password-span" style="display: none">El campo no admite caracteres especiales</span> --}}
                <span class="text-danger" id="password-error" data-error="span"></span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Confirmar contraseña</label>
                <input type="password" class="form-control" id="password_confirm" data-error="input" name="password_confirm" autocomplete="off">
                <span class="text-danger" id="password_confirm-error" data-error="span"></span>
            </div>
            <button type="submit" class="boton blue btn-block">Guardar</button>
          </form>
        </div>
    </div>
@endsection

@section('js')
  <script>
    var usuario_uuid = "{!!$usuario->uuid!!}";
  </script>
  <script src="{{asset('libs/js/cambio_password.js')}}"></script>
@endsection