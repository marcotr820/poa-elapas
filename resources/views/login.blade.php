<!DOCTYPE html>
<html>
<head>
	<title>login Poa</title>
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
	<div class="container">
		<div class="card">
			<div class="card-header">
				<img src="{{asset('libs/css/login/img/login_elapas.png')}}" alt="">
			</div>
			
			@if (session()->has('error_login'))
				<div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
					<strong>{!!session('error_login')!!}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif

			<div class="card-body">
				<form action="{{route('autenticacion')}}" method="POST">
					@csrf
					<div class="form-group">
					<label for=""><strong>Documento / CI</strong></label>
						<div class="input-group mb-2">
							<!--preguntamos si hay algun error en el capo con name usuario si hay imprime is-invalid-->
							<input type="number" name="usuario" class="form-control {{$errors->has('usuario') ? 'is-invalid' : ''}}" value="{{old('usuario')}}" placeholder="Usuario..." autocomplete="off">
						</div>
						<span class="text-danger">@error('usuario') {{ $message }} @enderror</span>
					</div>
					
					<div class="form-group">
						<label for=""><strong>Password</strong></label>
						<div class="input-group mb-2">
							<input type="password" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" placeholder="Password...">
							{{-- <input type="password" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" placeholder="Password..."> --}}
						</div>
						<span class="text-danger">@error('password') {{ $message }} @enderror</span>
					</div>

					<button type="submit" class="btn btn-primary btn-block mt-4">Iniciar Sesión</button>
				</form>
			</div>
		</div>
	</div>

	<!--script bootstrap-->
	<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
