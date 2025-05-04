<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'AdminIX')</title>

  <!-- CSS desde CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/dashboard" class="nav-link">Inicio</a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/dashboard" class="brand-link">
      <span class="ml-3 brand-text font-weight-light">ADMINIX</span>
    </a>

    <div class="sidebar">
      <div class="pb-3 mt-3 mb-3 user-panel d-flex">
        <div class="info">
          <a href="#" class="d-block">Hola, {{ Auth::user()->name ?? 'Usuario' }}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('sales.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>Gestión de Ventas</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('supplies.index') }}" class="nav-link">
              <i class="nav-icon fas fa-truck"></i>
              <p>Abastecimiento</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('products.index') }}" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>Inventario</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Usuarios</p>
            </a>
          </li>
        </ul>
      </nav>

    </div>
  </aside>

  <!-- Contenido principal -->
  <div class="content-wrapper">
    <div class="content">
      <div class="pt-4 container-fluid">
        @yield('content')
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center main-footer">
    <strong>&copy; {{ date('Y') }} AdminIX.</strong> Todos los derechos reservados.
  </footer>
</div>

<!-- Scripts desde CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
