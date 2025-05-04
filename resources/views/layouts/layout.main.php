<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplicación')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <h1>@yield('header', 'Gestión de Usuarios')</h1>
    </header>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>