@extends('layouts.main')

@section('title', 'Perfil de Usuario')

@section('content')
    <h2>Perfil de {{ Auth::user()->name }}</h2>
    <p><strong>Correo Electrónico:</strong> {{ Auth::user()->email }}</p>
    <p><strong>Fecha de Registro:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>

    <a href="{{ route('ventas') }}" class="btn">Ver Ventas</a>
    <a href="{{ route('gestionProductos') }}" class="btn">Ver gestionProductos</a>
    <a href="{{ route('inventario') }}" class="btn">Ver Inventario</a>

    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
    </form>
@endsection