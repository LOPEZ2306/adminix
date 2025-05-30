@extends('layouts.main')

@section('title', 'Crear Usuario')
@section('header', 'Crear Nuevo Usuario')

@section('content')
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <label for="role">Rol:</label>
        <select name="role" required>
            <option value="">-- Seleccione un rol --</option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
        @error('role') <div class="error">{{ $message }}</div> @enderror

        <br><br>
        <button type="submit">Guardar</button>
        <a href="{{ route('users.index') }}">Volver</a>
    </form>
@endsection
