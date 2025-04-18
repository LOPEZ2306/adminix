@extends('layouts.main')

@section('title', 'Inicio')

@section('content')
<div class="login-container">
	<div class="login-content">
		<p class="text-center">
			<i class="fas fa-user-circle fa-5x"></i>
		</p>
		<p class="text-center">
			Inicia sesión con tu cuenta
		</p>
		<form action="#">
			<div class="form-group">
				<label for="UserName" class="bmd-label-floating"><i class="fas fa-user-secret"></i> &nbsp; Usuario</label>
				<input type="text" class="form-control" id="UserName" name="usuario" pattern="[a-zA-Z0-9]{1,35}" maxlength="35">
			</div>
			<div class="form-group">
				<label for="UserPassword" class="bmd-label-floating"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
				<input type="password" class="form-control" id="UserPassword" name="clave" maxlength="200">
			</div>
			<a href="#" class="btn-login text-center">LOG IN</a>
		</form>
	</div>
</div>
@endsection

