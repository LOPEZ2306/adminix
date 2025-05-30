@extends('layouts.main')

@section('title', 'Cambiar Contraseña')

@section('content')
    <h2>Cambiar Contraseña</h2>
    <form action="{{ route('password.change') }}" method="POST">
        @csrf
        <div>
            <label for="current_password">Contraseña Actual:</label>
            <input type="password" name="current_password" id="current_password" required>
        </div>
        <br>
        <div>
            <label for="password">Nueva Contraseña:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <br>
        <div>
            <label for="password_confirmation">Confirmar Nueva Contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>
        <br>
        <button type="submit" class="btn">Actualizar Contraseña</button>
    </form>
@endsection