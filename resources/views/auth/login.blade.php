<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Iniciar sesión | ADMINIX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">

    <!-- Bootstrap Icons (solo si usas íconos con clase "bi") -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Estilos opcionales (puedes agregar más si los usas en tu plantilla) -->
</head>
<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1><b>ADMINIX</b></h1>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Inicia sesión en tu cuenta</p>

                <!-- Formulario de Login -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control" id="loginEmail" value="{{ old('email') }}" required autofocus>
                            <label for="loginEmail">Correo electrónico</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-envelope"></span>
                        </div>
                    </div>

                    <!-- Contraseña -->
                    <div class="input-group mb-1">
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="loginPassword" required>
                            <label for="loginPassword">Contraseña</label>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>

                    <!-- Recordarme + Botón -->
                    <div class="row my-2">
                        <div class="col-8 d-inline-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember"> Recordarme </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Ingresar</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Enlaces opcionales -->
                <p class="mb-1"><a href="#">¿Olvidaste tu contraseña?</a></p>
                <p class="mb-0"><a href="{{ route('register') }}">¿No tienes cuenta? Regístrate</a></p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>
</body>
</html>
