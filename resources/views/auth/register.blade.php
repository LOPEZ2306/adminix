<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registrarse | ADMINIX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>ADMINIX</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Crea una cuenta nueva</p>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Nombre completo" value="{{ old('name') }}" required autofocus>
            
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="bi bi-person"></span>
            </div>
          </div>
        </div>

        <!-- Email -->
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Correo electrónico" value="{{ old('email') }}" required>
          
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="bi bi-envelope"></span>
            </div>
          </div>
        </div>

        <!-- Contraseña -->
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
          
            <br>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            <br/>

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="bi bi-lock"></span>
            </div>
          </div>
        </div>

        <!-- Confirmación de contraseña -->
        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Repite la contraseña" required>
          
            @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small>
            @enderror

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="bi bi-lock-fill"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
          <a href="{{ route('login') }}">¿Ya tienes cuenta?</a>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
</body>
</html>
