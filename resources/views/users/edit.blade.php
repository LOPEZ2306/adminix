@extends('layouts.main')

@section('title', 'Editar Usuario')
@section('header', 'Editar Usuario')

@section('content')
    <style>
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nombre:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Contraseña (opcional):</label>
        <input type="password" name="password">
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label for="password_confirmation">Confirmar Contraseña:</label>
        <input type="password" name="password_confirmation">
        @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror

        <br><br>
        <button type="submit">Actualizar</button>
        <a href="{{ route('users.index') }}">Volver</a>
    </form>
@endsection
