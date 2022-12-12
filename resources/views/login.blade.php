<!DOCTYPE html>
<html>
<head>
	<title>Login Poa</title>
	<!--bootstrap-->
	<link rel="stylesheet" href="{{asset('css/app.css')}}">

	<!--asset nos posiciona en la carpeta public-->
	<link rel="stylesheet" type="text/css" href="{{asset('libs/css/login/style.css')}}">
	
	<!--fontawezome-->
    <link rel="stylesheet" href="{{asset('libs/fontawesome/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('libs/fontawesome/fontawesome.min.css')}}">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="contenedor">
		@if (session()->has('error_login'))
				<div class="alert alert-danger alert-dismissible fade show border border-danger m-0" role="alert">
					{!!session('error_login')!!}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
		@endif

		<div class="caja">
			<div class="caja-header">
				<img src="{{asset('libs/css/login/img/login_elapas.png')}}" alt="">
			</div>
			<div class="caja-body">
				<form action="{{route('autenticacion')}}" method="POST">
					@csrf	@method('POST')
					<div class="form-group mb-2">
						<label>Documento / CI</label>
						<input type="number" name="usuario" value="{{ old('usuario') }}" placeholder="Documento">
						<span class="text-danger">@error('usuario') {{ $message }} @enderror</span>
					</div>
					<div class="form-group mb-2">
						<label>Contraseña</label>
						<input type="password" name="password" placeholder="Contraseña">
						<span class="text-danger">@error('password') {{ $message }} @enderror</span>
					</div>
					<button type="submit" class="btn btn-primary btn-block mt-3">Ingresar</button>
				</form>
			</div>
		</div>
	</div>

	<!--script bootstrap-->
	<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
